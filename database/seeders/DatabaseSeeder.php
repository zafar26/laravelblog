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
        $user = User::where('name','=','John Doe')->first();
        echo "USER id: $user->id \n";

        // $listing = Listing::factory(6)->create([
        //     'user_id' => $user->id
        // ]);
        $listing = Listing::where('id','=','55')->first();
        $id = $listing->id;
        echo "LISTING ID: $id \n ";
        Comment::factory()->create([
                'user_id'=> $user->id,
                'listing_id' =>$listing->id
            ]
        );
        $this->rolesandPermissions($user);
    }
    public function rolesandPermissions($user){
        echo "Roles&permissions";

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
        
        $admin = Role::where('name','=','Admin')->first();
        $editor = Role::where('name','=','Editor')->first();
        $contributor = Role::where('name','=','Contributor')->first();
        $subscriber = Role::where('name','=','Subscriber')->first();
        $user->assignRole($admin);
        
        echo "Before Looping";
        // foreach($permissions as $key => $value) {
        //     $permission = Permission::create(['name' => $key]);
        // }
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
