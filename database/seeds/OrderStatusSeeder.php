<?php

use App\Models\OrderStatus;

use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OrderStatus::insert($this->data());
    }

    private function data()
    {
        return [
            ['name' => 'placed'],
            ['name' => 'approved'],
            ['name' => 'delivered'],
        ];
    }
}
