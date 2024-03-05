<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sticker extends Model
{
    use HasFactory;

    const STATUS_PROCESSING = "processing";
    const STATUS_SUCCESS = "success";
    const STATUS_FAILED = "failed";

    protected $fillable = ['user_id', 'image', 'sticker_url', 'prompt', 'replicate_url', 'error_message', 'status'];
}
