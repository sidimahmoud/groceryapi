<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Order;

class make_all_orders_done extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:all-command-done';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make all orders status to be done';

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
        Order::where('status_id', '!=' , 4)->update([
            "status_id" => 4
        ]);
    }
}
