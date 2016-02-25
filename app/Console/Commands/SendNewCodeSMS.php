<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\User;
use SMS;

class SendNewCodeSMS extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sms:notify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send an SMS notification of new code on the server to every user.';

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
        $users = User::all();

        foreach ($users as $user) {
            SMS::send($user->phone_number, 'New code has been deployed onto ClientApp');
        }
    }
}
