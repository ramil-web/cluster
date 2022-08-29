<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PageTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now()->format('Y-m-d H:i:s');
        
        DB::table('page_types')->insert([
            [
                'name'       => 'Главная',
                'alias'      => 'home',
                'is_active'  => '1',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name'       => 'Контакты',
                'alias'      => 'contacts',
                'is_active'  => '1',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name'       => 'Новости',
                'alias'      => 'news',
                'is_active'  => '1',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
