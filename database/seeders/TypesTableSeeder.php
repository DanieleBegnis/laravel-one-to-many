<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = ['HTML', 'CSS', 'Javascript', 'PHP', 'Laravel', 'Bootstrap'];
        foreach ($types as $singleType) {
            $newType = new Type();
            $newType->type = $singleType;
            $newType->save();
        }
    }
}
