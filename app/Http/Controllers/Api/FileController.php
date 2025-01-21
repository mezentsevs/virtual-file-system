<?php

namespace App\Http\Controllers\Api;

use App\Factories\FileUpdateDtoFactory;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\File\StoreFileRequest;
use App\Http\Requests\Api\File\UpdateFileRequest;
use App\Models\File;
use App\Services\FileService;
use Illuminate\Http\JsonResponse;

class FileController extends Controller
{
    protected FileService $files;

    public function __construct()
    {
        $this->files = app(FileService::class);
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(StoreFileRequest $request)
    {
        //
    }

    public function show(File $file)
    {
        //
    }

    public function edit(File $file)
    {
        //
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

    public function destroy(File $file)
    {
        //
    }
}
