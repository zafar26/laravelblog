<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Listing;
use App\Models\Comment;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $user = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@gmail.com'
        ]);
        $listing = Listing::factory(6)->create([
            'user_id' => $user->id
        ]);
        Comment::factory()->create([
                'user_id'=> $user->id,
                'listing_id' =>$listing->id
            ]
        );

    }
}
