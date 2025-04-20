<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            DB::table('employees')->insert([
            [
            'name' => 'Arif',
            'salary' => 5000000,
            'registered_since' =>  '2020-06-30',
            'job_position' => 'Front-end Developer',
            ],
            [
            'name' => 'Joko',
            'salary' => 4000000,
            'registered_since' =>  '2021-02-20',
            'job_position' => 'Back-end Developer',
            ],
            [
            'name' => 'Ali',
            'salary' => 7000000,
            'registered_since' =>  '2019-04-20',
            'job_position' => 'Full-Stack Developer',
            ],
        ]);
    }
}
