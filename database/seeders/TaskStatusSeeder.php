<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TaskStatus::firstOrCreate(['name' => 'новый']);
        TaskStatus::firstOrCreate(['name' => 'в работе']);
        TaskStatus::firstOrCreate(['name' => 'на тестировании']);
        TaskStatus::firstOrCreate(['name' => 'завершен']);
    }
}
