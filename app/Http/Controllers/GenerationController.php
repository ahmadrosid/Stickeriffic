<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use App\Models\Sticker;

class GenerationController extends Controller
{
    private function generateSticker($prompt, $user_id)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Token '. env('REPLICATE_API_TOKEN'),
        ])
            ->post('https://api.replicate.com/v1/predictions', [
                'version' => '6443cc831f51eb01333f50b757157411d7cadb6215144cc721e3688b70004ad0',
                'input' => [
                    'steps' => 20,
                    'width' => 1024,
                    'height' => 1024,
                    'prompt' => $prompt,
                    'upscale' => true,
                    'upscale_steps' => 10,
                    'negative_prompt' => '',
                ],
            ]);

        if ($response->successful()) {
            $data = $response->json();
            $replicate_url = $data['urls']['get'];
            Sticker::create([
                'user_id' => $user_id,
                'prompt' => $prompt,
                'replicate_url' => $replicate_url,
                'status' => Sticker::STATUS_PROCESSING,
            ]);

            return redirect()->back();
        } else {
            $errorMessage = $response->body();
            return response()->json([
                'error' => $errorMessage
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function generate(Request $request) {
        $prompt = $request->input('prompt');
        if (!$prompt) {
            $errorMessage = 'Prompt input is required!';
            return response()->json([
                'error' => $errorMessage
            ], Response::HTTP_BAD_REQUEST);
        }
        return $this->generateSticker($prompt, $request->user()->id);
    }

    public function getGeneration(Request $request, $sticker_id) {
        $sticker = Sticker::findOrFail($sticker_id);
        if (!$sticker) {
            $errorMessage = 'Sticker not found!';
            return response()->json([
                'error' => $errorMessage
            ], Response::HTTP_BAD_REQUEST);
        }

        if ($sticker->sticker_url !== null) {
            return response()->json([
                'data' => $sticker,
            ]);
        }

        $response = Http::withHeaders([
            'Authorization' => 'Token '. env('REPLICATE_API_TOKEN'),
        ])
            ->get($sticker->replicate_url);

        if ($response->successful()) {
            $data = $response->json();
            if (isset($data['output'])) {
                $sticker->sticker_url = $data['output'][0];
                $sticker->status = Sticker::STATUS_SUCCESS;
                $sticker->save();
            }
            return response()->json([
                'data' => $sticker,
            ]);
        } else {
            $errorMessage = $response->body();
            return response()->json([
                'error' => $errorMessage
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
