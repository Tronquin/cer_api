<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Rol;
use App\User;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crea un usuario';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $roles = Rol::all(['name']);
        $role_user = [];
        foreach($roles as $userRol){
            $role_user [] = $userRol;
        }
        $rol = $this->choice('Que rol tendra el usuario?',$role_user,0);
        $name = $this->ask('What is your name?');
        $last_name = $this->ask('What is your last_name?');
        $email = $this->ask('What is your email?');
        $password = $this->secret('What is the password?');
        $this->info('Estos seran los datos de usuario: User '.$email.' Password '.$password);
        if ($this->confirm('Do you wish to continue?')) {
            $user = new User();
            $user->name = $name;
            $user->last_name = $last_name;
            $user->email = $email
            $user->password = 
        }
        //factory(User::class)->create()->with('role',$rol);
    }
}
