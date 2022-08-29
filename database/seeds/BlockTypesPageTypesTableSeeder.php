<?php

use Illuminate\Database\Seeder;

class BlockTypesPageTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('block_type_page_type')->insert([
            [
                'block_type_id' => '1',
                'page_type_id'  => '1',
            ],
            [
                'block_type_id' => '2',
                'page_type_id'  => '1',
            ],
            [
                'block_type_id' => '3',
                'page_type_id'  => '1',
            ],
            
            [
                'block_type_id' => '1',
                'page_type_id'  => '2',
            ],
            [
                'block_type_id' => '2',
                'page_type_id'  => '2',
            ],
            [
                'block_type_id' => '3',
                'page_type_id'  => '2',
            ],
            
            [
                'block_type_id' => '1',
                'page_type_id'  => '3',
            ],
            [
                'block_type_id' => '2',
                'page_type_id'  => '3',
            ],
            [
                'block_type_id' => '3',
                'page_type_id'  => '3',
            ],
        ]);
    }
}
