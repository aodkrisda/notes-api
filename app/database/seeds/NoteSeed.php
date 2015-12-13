<?php
use App\Model\Note;
use App\Model\User;

class NoteSeed
{
    public function run()
    {
        $user = User::where('username', 'paul')->first();

        Note::create([
            'body' => 'First note',
            'user_id' => $user->id
        ]);

        Note::create([
            'body' => 'Second note',
            'user_id' => $user->id
        ]);

        $user = User::where('username', 'john')->first();

        Note::create([
            'body' => 'Third note',
            'user_id' => $user->id
        ]);

        Note::create([
            'body' => 'Fourth note',
            'user_id' => $user->id
        ]);
    }
}
