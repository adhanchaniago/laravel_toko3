<?php

use App\Admin;
use App\Customer;
use Illuminate\Database\Seeder;

class CustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Customer::create([
            'name' => 'customer',
            'email' => 'customer@gmai.com',
            'password' => bcrypt(123123123),
        ]);
    }
}
