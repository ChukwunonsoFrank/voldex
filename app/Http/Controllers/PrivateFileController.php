<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class PrivateFileController extends Controller
{
    public function show($path)
    {
        if (!auth()->check()) {
            abort(403);
        }

        // Decode the URL-encoded path
        $path = urldecode($path);

        if (!Storage::disk("local")->exists($path)) {
            abort(404);
        }

        return Storage::disk("local")->response($path);
    }
}
