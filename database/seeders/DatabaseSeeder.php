<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'achyutkneupane@gmail.com',
            'password' => Hash::make('Ghost0vperditi0n'),
            'role' => 'admin',
            'email_verified_at' => now(),
            'verify_token' => sha1(sha1(time())),
        ]);
        User::create([
            'name' => 'Alka',
            'email' => 'alka@stringsnbeats.net',
            'password' => Hash::make('Alka@SNB@123'),
            'role' => 'editor',
            'email_verified_at' => now(),
            'verify_token' => sha1(sha1(time())),
        ]);
        Category::create([
            'title' => 'News',
            'slug' => 'news'
        ]);
        Category::create([
            'title' => 'New Releases',
            'slug' => 'new-releases'
        ]);
        Category::create([
            'title' => 'Articles',
            'slug' => 'articles'
        ]);
    }
}
