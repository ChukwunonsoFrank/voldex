<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class StorageFileController extends Controller
{
    public function show(string $path)
    {
        $path = urldecode($path);

        if (! Storage::disk('public')->exists($path)) {
            abort(404);
        }

        return Storage::disk('public')->response($path);
    }
}
