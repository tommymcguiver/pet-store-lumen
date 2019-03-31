<?php

use App\Models\PetCategory;

use Illuminate\Database\Seeder;

class PetCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PetCategory::insert($this->data());
    }

    private function data()
    {
        return [
            ['name' => 'cat'],
            ['name' => 'dog'],
            ['name' => 'hamster'],
            ['name' => 'kangaroo'],
        ];
    }
}
