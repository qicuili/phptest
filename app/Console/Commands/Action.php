<?php

namespace App\Console\Commands;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\APIController;
use App\Http\Controllers\LoginController;
use Illuminate\Console\Command;

class Action extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'action:getoutput';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Execute the getdepart method in the AdminController class.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $admin = app(APIController::class);
        $admin->getstatus();
        $this->info('Action executed successfully.');
        return 0;
    }
}
