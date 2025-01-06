<?php

namespace Database\Seeders;

use App\Models\Folder;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $users = User::factory(3)->create();

        foreach ($users as $user) {
            $rootFolder = Folder::factory()->hasFiles(1)->create([
                'user_id' => $user->id,
            ]);

            $folders = Folder::factory(2)->hasFiles(2)->create([
                'user_id' => $user->id,
                'folder_id' => $rootFolder->id,
            ]);

            foreach ($folders as $folder) {
                Folder::factory(3)->hasFiles(3)->create([
                    'user_id' => $user->id,
                    'folder_id' => $folder->id,
                ]);
            }
        }
    }
}
