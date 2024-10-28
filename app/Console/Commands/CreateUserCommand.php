<?php

namespace App\Console\Commands;

use App\Models\Role;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new User';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user['name']=$this->ask('Name of user');
        $user['email']=$this->ask('email of user');
        $user['password']=Hash::make($this->secret('passowrd of user'));
        $roleName=$this->choice('role of user',['admin','editor'],1);
$role=Role::where('name',$roleName)->first();
if(!$role){
    $this->error('Role Not found');
     return -1;
}
        $newuser=User::create($user);
        $newuser->roles()->attach($role->id);
        $this->info('User'.$user['email'].'create successfully');
        return 0;
    }
}