<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function deleteFile($filePath)
    {
        // Check if the file exists before attempting to delete
        if (Storage::disk('public')->exists(str_replace('/storage/', '', $filePath))) {
            Storage::disk('public')->delete(str_replace('/storage/', '', $filePath));
        }
    }
}
