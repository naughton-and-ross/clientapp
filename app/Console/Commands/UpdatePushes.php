<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\User;
use DB;

class UpdatePushes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pushes:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Syncs ClientApp record of deployments with latest Forge Deployment.';

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
        DB::table('pushes')->where('is_deployed', 0)->update(['is_deployed' => 1]);
    }
}
