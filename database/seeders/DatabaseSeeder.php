<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create default admin user
        User::create([
            'name'     => 'Admin',
            'email'    => 'admin@blog.com',
            'password' => Hash::make('password'),
        ]);

        // Create 15 sample blog posts
        Blog::factory(15)->create();

        $this->command->info('✅ Seeded 1 admin user (admin@blog.com / password)');
        $this->command->info('✅ Seeded 15 blog posts');
    }
}
