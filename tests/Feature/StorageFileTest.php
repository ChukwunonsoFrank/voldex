<?php

use Illuminate\Support\Facades\Storage;

it('returns a file from the public disk', function () {
    Storage::disk('public')->put('test-image/test.txt', 'hello');

    $response = $this->get(route('storage.file', 'test-image/test.txt'));

    $response->assertSuccessful();

    Storage::disk('public')->delete('test-image/test.txt');
});

it('returns 404 for a missing file', function () {
    $response = $this->get(route('storage.file', 'nonexistent/file.png'));

    $response->assertNotFound();
});
