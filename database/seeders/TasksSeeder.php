<?php

namespace Database\Seeders;

use App\Models\Tasks;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TasksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $userIds = User::pluck('id')->toArray();

        Tasks::factory()->count(1000)->create([
            'assigned_by_id' => 1,
            'assigned_to_id' => function () use ($userIds) {
                return $userIds[array_rand($userIds)];
            },
        ]);
    }
}
