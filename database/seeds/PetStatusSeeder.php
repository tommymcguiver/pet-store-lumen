<?php

use App\Models\PetStatus;

use Illuminate\Database\Seeder;

class PetStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PetStatus::insert($this->data());
    }

    private function data()
    {
        return [
            ['name' => 'available'],
            ['name' => 'pending'],
            ['name' => 'sold'],
        ];
    }
}
