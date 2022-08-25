<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Comment;
use App\Models\Listing;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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
        // $user = User::factory()->create([
        //     'name' => 'John Doe',
        //     'email' => 'john@gmail.com'
        // ]);
        // // auth()->user()->assignRole('Admin');
        // $user->assignRole('Admin');
        // $listing = Listing::factory(6)->create([
        //     'user_id' => $user->id
        // ]);
        // Comment::factory()->create([
        //         'user_id'=> $user->id,
        //         'listing_id' =>$listing->id
        //     ]
        // );
        $permissions = array(
            "can see all post" => array('A','E'),
            "can see their post" =>array('A','E','C'),
            'create post' => array('A','E','C'),
            'update post' => array('A','E','C'),
            'delete post' => array('A',),
            'publish post' => array('A',),
            'unpublish post' => array('A','E','C'),
            'create comment' => array('A','E','C','S'),
            'update comment' => array('A','E'),
            'approve comment' => array('A','E'),
            'reject comment' => array('A','E'),
            'delete comment' => array('A',),
        );
        // $admin = Role::create(['name' => 'Admin']);
        // $editor = Role::create(['name' => 'Editor']);
        // $contributor = Role::create(['name' => 'Contributor']);
        // $subscriber = Role::create(['name' => 'Subscriber']);
        
        $admin = Role::findById(1);
        $editor = Role::findById(2);
        $contributor = Role::findById(3);
        $subscriber = Role::findById(4);
        
        foreach($permissions as $key => $value) {
            // $permission = Permission::create(['name' => $key]);
            $permission = Permission::findByName($key);
            $x = 0;
            while($x < count($value)) {
                if($value[$x] == "A"){
                    // echo "\n Admin ";
                    $admin-> givePermissionTo($permission);
                }
                else if($value[$x] == 'E'){                    
                    // echo "EDITOR ";
                    $editor-> givePermissionTo($permission);
                }
                else if($value[$x] == 'C'){
                    // echo "Contributor ";
                    $contributor-> givePermissionTo($permission);
                }
                else if($value[$x] == 'S'){
                    // echo "Subscriber";
                    $subscriber-> givePermissionTo($permission);
                }
                $x++;
            }

        }
    }
}
