<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    use TruncateTable, DisableForeignKeys;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // 1 User Memiliki Lima Daftar Tugas
        $this->disableForeignKeys();
        $this->truncate('users');
        $users = User::factory(50)
            ->has(Task::factory()
                ->count(5))
            ->create();
        $this->enableForeignKeys();
    }
}
