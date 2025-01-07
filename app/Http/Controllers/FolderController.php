<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFolderRequest;
use App\Http\Requests\UpdateFolderRequest;
use App\Models\Folder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class FolderController extends Controller
{
    public function index(Request $request): Collection
    {
        return $request->user()->folders()->whereNull('folder_id')
            ->with('childrenFolders')
            ->get();
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

    public function update(UpdateFolderRequest $request, Folder $folder)
    {
        //
    }

    public function destroy(Folder $folder)
    {
        //
    }
}
