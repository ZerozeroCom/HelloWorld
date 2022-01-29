<?php

namespace Database\Seeders;

use App\Actions\Fortify\CreateNewUser;
use App\Models\Allow_list;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(CreateNewUser $createNewUser)
    {
        $data=['type'=> 'admin','name'=> 'FirstAdmin', 'email'=> 'a@a' ,'password'=>'aaaaaaaa','password_confirmation'=>'aaaaaaaa'];
        $createNewUser->create($data);
        $user=User::where('name','FirstAdmin')->first();
        Allow_list::create(['user_id'=>$user->id,'allow_ip_addr'=>'127.0.0.1']);
        $this->call(ProductSeeder::class);
        $this->command->info('產生Admin帳號');
    }
}
