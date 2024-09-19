<?php

namespace Database\Seeders;

use App\Models\Note;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();
        if ($user) {
           for($i=0; $i < 10; $i++) {
             Note::create([
                'id' => (string) Str::uuid(),
                'user_id' => $user->id,
                'title' => 'Note title' . ($i + 1),
                'body' => 'Body of the note' . ($i + 1),
                'send_date' => Carbon::now()->addDays(rand(1,30))
             ]);
           }
        } else {
            $this->command->info('no signed in user');
        }
    }
}
