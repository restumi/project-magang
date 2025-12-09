<?php

namespace App\Http\Controllers;

use App\Jobs\SendBulkEmailJob;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MailController extends Controller
{
    public function sendEmails()
    {
        $users = [
            [
                'name' => 'User 1',
                'email' => 'user1@example.com'
            ],
            [
                'name' => 'User 2',
                'email' => 'user2@example.com'
            ],
            [
                'name' => 'User 3',
                'email' => 'user3@example.com'
            ],
            [
                'name' => 'User 4',
                'email' => 'user4@example.com'
            ],
            [
                'name' => 'User 5',
                'email' => 'user5@example.com'
            ],
            [
                'name' => 'User 6',
                'email' => 'user6@example.com'
            ],
            [
                'name' => 'User 7',
                'email' => 'user7@example.com'
            ],
            [
                'name' => 'User 8',
                'email' => 'user8@example.com'
            ],
            [
                'name' => 'User 9',
                'email' => 'user9@example.com'
            ],
            [
                'name' => 'User 10',
                'email' => 'user10@example.com'
            ],
        ];

        $message = 'Ini adalah pesan uji coba dari laravel [AllCode]! Maintance On Profress, please wait for it!';

        try {
            foreach($users as $user){
                SendBulkEmailJob::dispatch($user['email'], $user['name'] , $message);
            }

            return view('sendTenEmails');
        } catch(Exception $e){
            Log::info([
                'error' => $e->getMessage()
            ]);
        }
    }
}
