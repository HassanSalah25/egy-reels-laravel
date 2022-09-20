<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Comment;
use App\Models\CommentUser;
use App\Models\Like;
use App\Models\Reel;
use App\Models\ReelUser;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Comment::factory()->times(10)->create();
        CommentUser::factory()->times(10)->create();
        Like::factory()->times(10)->create();
        Reel::factory()->times(10)->create();
        ReelUser::factory()->times(10)->create();
//        Role::factory()->times(10)->create();
        RoleUser::factory()->times(10)->create();
        User::factory()->times(10)->create();

        $this->call(RoleSeeder::class);

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
