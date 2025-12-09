<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\BulkNotificationMail;

class SendBulkEmailJob implements ShouldQueue
{
    use Queueable, Dispatchable, InteractsWithQueue, SerializesModels;

    public $email;
    public $user;
    public $message;

    /**
     * Create a new job instance.
     */
    public function __construct(string $email ,string $user, string $message)
    {
        $this->user = $user;
        $this->message = $message;
        $this->email = $email;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info('Sending email to : ' . $this->email, [
            'message' => $this->message
        ]);

        // Mail::to($this->user->email)->send(new BulkNotificationMail($this->message));
    }
}
