<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Folder\IndexFolderRequest;
use App\Http\Requests\Api\Folder\StoreFolderRequest;
use App\Http\Requests\Api\Folder\UpdateFolderRequest;
use App\Models\Folder;
use Illuminate\Http\JsonResponse;

class FolderController extends Controller
{
    public function index(IndexFolderRequest $request): JsonResponse
    {
        return response()->json([
            'success' => true,
            'folders' => $request->user()->folders()->whereNull('folder_id')->with('childrenFolders')->get(),
        ]);
    }

    public function create()
    {
        //
    }

    public function store(StoreFolderRequest $request)
    {
        //
    }

    public function show(Folder $folder)
    {
        //
    }

    public function edit(Folder $folder)
    {
        //
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

    public function destroy(Folder $folder)
    {
        //
    }
}
