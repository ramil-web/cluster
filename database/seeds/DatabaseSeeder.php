<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Добавляем администратора Роман 
        $this->call(AdminsTableSeeder::class);
        //Добавляем роли
        $this->call(RolesTableSeeder::class);
        //Добавляем доступы
        $this->call(PermissionsTableSeeder::class);
        //Связываем роли и доступы
        $this->call(PermissionRoleTableSeeder::class);
        //Устанавливаем админу Роман роль "СУПЕР"
        $this->call(AdminRoleTableSeeder::class);
        //Добавляем три типа страниц
        $this->call(PageTypesTableSeeder::class);
        //Добавляем три типа блоков
        $this->call(BlockTypesTableSeeder::class);
        //Связываем типы страниц с блоками
        $this->call(BlockTypesPageTypesTableSeeder::class);
    }
}
