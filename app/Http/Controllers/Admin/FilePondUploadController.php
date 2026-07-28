<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FilePondUploadController extends Controller
{
    /**
     * FilePond uploads under the name of whichever input it enhanced (e.g.
     * "background_image", "photo", "logo_image"), not a fixed field name —
     * so we pick up the first (and only) uploaded file regardless of its key.
     */
    public function store(Request $request): Response
    {
        $file = $this->firstUploadedFile($request);

        abort_unless($file && $file->isValid(), 422, 'No valid file provided.');
        abort_if($file->getSize() > 100 * 1024 * 1024, 422, 'File too large.');

        $extension = $file->getClientOriginalExtension() ?: $file->extension();
        $filename = (string) Str::uuid().($extension ? '.'.$extension : '');

        $path = $file->storeAs('tmp-uploads', $filename, 'public');

        return response($path, 200)->header('Content-Type', 'text/plain');
    }

    public function revert(Request $request): Response
    {
        $safeId = basename($request->getContent());

        if (! preg_match('/^[a-zA-Z0-9\-]+\.[a-zA-Z0-9]+$/', $safeId)) {
            return response('', 200);
        }

        $path = 'tmp-uploads/'.$safeId;

        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }

        return response('', 200);
    }

    private function firstUploadedFile(Request $request): ?UploadedFile
    {
        $files = $request->allFiles();
        $file = reset($files);

        return $file instanceof UploadedFile ? $file : null;
    }
}
