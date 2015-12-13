<?php
use App\Model\User;

class UserSeed
{
    public function run()
    {
        User::create([
            'name' => 'Paulo First',
            'username' => 'paul',
            'email' => 'paul@email.com',
            'password' => password_hash("paul", PASSWORD_DEFAULT)
        ]);

        User::create([
            'name' => 'John Second',
            'username' => 'john',
            'email' => 'john@email.com',
            'password' => password_hash("john", PASSWORD_DEFAULT)
        ]);
    }
}
