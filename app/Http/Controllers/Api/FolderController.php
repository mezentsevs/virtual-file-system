<?php

namespace App\Http\Controllers\Api;

use App\Factories\FolderCreateDtoFactory;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Folder\DeleteFolderRequest;
use App\Http\Requests\Api\Folder\IndexFolderRequest;
use App\Http\Requests\Api\Folder\StoreFolderRequest;
use App\Http\Requests\Api\Folder\UpdateFolderRequest;
use App\Models\Folder;
use App\Services\FolderService;
use Illuminate\Http\JsonResponse;

class FolderController extends Controller
{
    protected FolderService $folders;

    public function __construct()
    {
        $this->folders = app(FolderService::class);
    }

    public function index(IndexFolderRequest $request): JsonResponse
    {
        return response()->json([
            'success' => true,
            'folders' => $request->user()->folders()->whereNull('folder_id')->with('childrenFolders')->get(),
        ]);
    }

    public function store(StoreFolderRequest $request): JsonResponse
    {
        $folder = $this->folders->create(FolderCreateDtoFactory::fromArray([
            'user_id' => $request->user()->id,
            'folder_id' => $request->integer('folder_id'),
            'name' => $request->string('name'),
        ]));

        return response()->json([
            'success' => true,
            'folder' => $folder,
        ]);
    }

    public function update(UpdateFolderRequest $request, Folder $folder): JsonResponse
    {
        $folder->name = $request->string('name');

        $folder->save();

        return response()->json([
            'success' => true,
            'folder' => $folder,
        ]);
    }

    public function destroy(DeleteFolderRequest $request, Folder $folder): JsonResponse
    {
        $folder->delete();

        return response()->json([
            'success' => true,
            'folder' => $folder,
        ]);
    }
}
