<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now()->format('Y-m-d H:i:s');
        DB::table('admins')->insert([
            [
                'name'       => 'Роман',
                'email'      => 'roman@roman.ru',
                'password'   => '$2y$10$H9rsAg8iCe90que4T55Do.cq/.NboDMdqhZ.pd89eegqjd9GLjbBm',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
