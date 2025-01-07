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
            $rootFolder = Folder::factory()->create([
                'user_id' => $user->id,
                'name' => 'Root',
            ]);

            $firstLevelFolders = Folder::factory(1)->hasFiles(1)->create([
                'user_id' => $user->id,
                'folder_id' => $rootFolder->id,
            ]);

            foreach ($firstLevelFolders as $firstLevelFolder) {
                $secondLevelFolders = Folder::factory(2)->hasFiles(2)->create([
                    'user_id' => $user->id,
                    'folder_id' => $firstLevelFolder->id,
                ]);

                foreach ($secondLevelFolders as $secondLevelFolder) {
                    $thirdLevelFolders = Folder::factory(3)->hasFiles(3)->create([
                        'user_id' => $user->id,
                        'folder_id' => $secondLevelFolder->id,
                    ]);

                    foreach ($thirdLevelFolders as $thirdLevelFolder) {
                        Folder::factory(4)->hasFiles(4)->create([
                            'user_id' => $user->id,
                            'folder_id' => $thirdLevelFolder->id,
                        ]);
                    }
                }
            }
        }
    }
}
