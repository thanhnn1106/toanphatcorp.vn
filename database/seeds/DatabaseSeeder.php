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
        $this->call(RolesTableSeeder::class);
        $this->call(AdminTableSeeder::class);
        $this->call(StaticPagesTableSeeder::class);
        $this->call(FaqsTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(TagsTableSeeder::class);
        $this->call(FilesInfoTableSeeder::class);
        $this->call(PackagesTableSeeder::class);
        $this->call(ContactsTableSeeder::class);
        $this->call(UserTableSeeder::class);
    }
}
