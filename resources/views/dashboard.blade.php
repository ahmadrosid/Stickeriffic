<x-app-layout>
    <section>
        <div class="py-2">
            <div class="px-9 py-6 max-w-xl">
                <div class="pb-4">
                    <h1 class="text-slate-900 font-extrabold text-3xl sm:text-4xl lg:text-5xl tracking-tight dark:text-white">Generate your sticker</h1>
                </div>
                <form action="{{route('generate')}}" method="GET">
                    @method('GET')
                    @csrf
                    <div class="flex py-4 space-x-1">
                        <label for="generate" class="sr-only"> Generate </label>
                        <input required="true" type="text" id="generate" name="prompt" placeholder="What is your sticker?" class="w-full rounded-md border-gray-200 py-2.5 pe-10 shadow-sm" />
                        <span class="absolute inset-y-0 end-0 grid w-10 place-content-center">
                            <button type="button" class="text-gray-600 hover:text-gray-700">
                                <span class="sr-only">Search</span>
                            </button>
                        </span>
                        <button type="submit" class="bg-slate-900 hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-slate-400 focus:ring-offset-2 focus:ring-offset-slate-50 text-white font-semibold h-12 px-6 rounded-lg w-full flex items-center justify-center sm:w-auto dark:bg-sky-500 dark:highlight-white/20 dark:hover:bg-sky-400">
                            Generate
                        </button>
                    </div>
                </form>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-4 xl:grid-cols-5 md:grid-cols-3 px-9 gap-4">
                @foreach($stickers as $sticker)
                @if(!$sticker->sticker_url)
                <div class="bg-indigo-500/75 grid place-content-center rounded-md min-h-[230px] shadow-md">
                    <button type="button" class="flex text-white">
                        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Processing...
                    </button>
                </div>
                <script>
                    function fetchStickerProgress() {
                        let stickerId = @json($sticker->id);
                        fetch("{{route('generate.get', $sticker) }}")
                            .then(response => {
                                if (!response.ok) {
                                throw new Error('Network response was not ok');
                                }
                                return response.json(); // Parse the JSON in the response
                            })
                            .then(data => {
                                console.log(data)
                                if (data.data.sticker_url === null) {
                                    setTimeout(fetchStickerProgress, 2500);
                                } else {
                                    window.location.reload();
                                }
                            })
                            .catch(error => {
                                console.error('There was a problem with the fetch operation:', error);
                            });
                    }

                    fetchStickerProgress();
                </script>
                @else
                <div class="bg-white rounded-lg p-2  shadow-sm">
                    <img class="rounded-md" src="{{$sticker->sticker_url}}" />
                    <p class="pt-4 pb-2 text-center text-lg">{{$sticker->prompt}}</p>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </section>

</x-app-layout>
