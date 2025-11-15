<?php

namespace Database\Seeders;

use App\Http\Controllers\Helpers\GeneralHelper;
use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $array = ['product','blog','user','category'];

        foreach($array as $item){
            $p = new Permission();
            $p->name = $item;
           $p->slug = GeneralHelper::createSlug($item);
           $p->save();
        }
    }
}
