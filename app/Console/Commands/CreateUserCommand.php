<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class CreateUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:user {username?} {email?} {password?} {--admin : Create an admin user}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new user';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $username = $this->argument('username') ?? $this->ask('Enter username:');
        $email = $this->argument('email') ?? $this->ask('Enter email:');
        $password = $this->argument('password') ?? $this->secret('Enter password:');
        $isAdmin = $this->option('admin');

        $user = new User();
        $user->name = $username;
        $user->email = $email;
        $user->password = bcrypt($password);
        $user->is_admin = $isAdmin;
        //$user->save();

        $this->info('User created successfully!');

        return Command::SUCCESS;
    }
}
