<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRecords = [
            [
                'id'=>1,
                'name'=>'Dragan',
                'email'=>'draganmatic@crkvamokro.com',
                'password'=>'$2a$12$/5EGYMQ0ese94iLpmLQQLOT7C7DxSamzBxUKl6V9T0mIeBGpXXyGm',
                'status'=>1
            ],
            [
                'id'=>2,
                'name'=>'Dalibor',
                'email'=>'daliborstakic@crkvamokro.com',
                'password'=>'$2a$12$gx5aSdcTEXcuGVPbMPEJf.ulVgyqQfa9qbaAazJrGeHdCI4JeeiJe',
                'status'=>1
            ],
            [
                'id'=>3,
                'name'=>'Savo',
                'email'=>'savo@s.s',
                'password'=>'$2a$12$i3oBiofEIyYszR1nz9BO6OiI95FXacas1YAMC2Z8Q34MCchCS5dTm',
                'status'=>1
            ]
        ];
        Admin::insert($adminRecords);
    }
}
