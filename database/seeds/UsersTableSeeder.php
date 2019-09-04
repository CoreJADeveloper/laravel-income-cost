<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      User::truncate();

      $adminRole = Role::where('name', 'admin')->first();
      $editorRole = Role::where('name', 'editor')->first();

      $admin = User::create([
        'name' => 'admin',
        'email' => 'admin@admin.com',
        'password' => bcrypt('admin')
      ]);

      $editor = User::create([
        'name' => 'editor',
        'email' => 'editor@editor.com',
        'password' => bcrypt('editor')
      ]);

      $admin->roles()->attach($adminRole);
      $editor->roles()->attach($editorRole);
    }
}
