<?php

namespace App\Http\Controllers\Api;

use App\Factories\FileCreateDtoFactory;
use App\Factories\FileUpdateDtoFactory;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\File\DeleteFileRequest;
use App\Http\Requests\Api\File\StoreFileRequest;
use App\Http\Requests\Api\File\UpdateFileRequest;
use App\Models\File;
use App\Services\FileService;
use Illuminate\Http\JsonResponse;

class FileController extends Controller
{
    public function __construct(protected FileService $files) {}

    public function store(StoreFileRequest $request): JsonResponse
    {
        return response()->json([
            'success' => true,
            'file' => $this->files->create(FileCreateDtoFactory::fromArray([
                'folder_id' => $request->integer('folder_id'),
                'name' => $request->string('name'),
                'content' => $request->string('content'),
            ])),
        ]);
    }

    public function update(UpdateFileRequest $request, File $file): JsonResponse
    {
        return response()->json([
            'success' => true,
            'file' => $this->files->update(FileUpdateDtoFactory::fromArray([
                'file' => $file,
                'name' => $request->string('name'),
                'content' => $request->string('content'),
            ])),
        ]);
    }

    public function destroy(DeleteFileRequest $request, File $file): JsonResponse
    {
        return response()->json([
            'success' => true,
            'file' => $this->files->delete($file),
        ]);
    }
}
