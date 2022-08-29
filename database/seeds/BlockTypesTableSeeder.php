<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class BlockTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now()->format('Y-m-d H:i:s');

        DB::table('block_types')->insert([
            [
                'name'       => 'Текстовый блок',
                'alias'      => 'text',
                'is_active'  => '1',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name'       => 'Изображение',
                'alias'      => 'image',
                'is_active'  => '1',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name'       => 'Слайдер',
                'alias'      => 'slider',
                'is_active'  => '1',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name'       => 'Изображение + текст',
                'alias'      => 'image_text',
                'is_active'  => '1',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name'       => 'Слайдер с текстом',
                'alias'      => 'slider_text',
                'is_active'  => '1',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name'       => 'Карта "Google"',
                'alias'      => 'google_map',
                'is_active'  => '1',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
