<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Profile;
use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 🔥 Disable foreign key checks temporarily
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // 🔁 Truncate tables in order: children first, then parents
        Post::truncate();
        //Profile::truncate();
        User::truncate();

        // ✅ Enable them back
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // ➕ Now seed the database
        User::factory()->count(10)->create()->each(function ($user) {
            // Each user gets 3 posts
            Post::factory()->count(3)->create([
                'user_id' => $user->id,
            ]);
        });

        Profile::factory()->count(10)->create();
    }
}
