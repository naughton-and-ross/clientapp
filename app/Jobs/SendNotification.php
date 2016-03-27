<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\User;

class SendNotification extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $client = new \GuzzleHttp\Client();

        $client->post('https://api.pushover.net/1/messages.json', [
               'form_params' => [
                   'token' => 'aPyrQdB2SiftgA66segaDbLcii1eYo',
                   'user' => 'uJf9GrZjjGKAfzCxmos4R91TTceSFL',
                   'title' => 'Test Title',
                   'message' => $this->user->name,
                   'sound' => 'siren'
               ],
            ]);
    }
}
