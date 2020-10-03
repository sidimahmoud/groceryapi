<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Product;

class MakeAllPricetwodecimal extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:all-price-float';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make all price float';

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
        $products = Product::get();

        foreach($products as $pro){
            $this->info("price" . $pro->id);
            $this->info($pro->price);
            $this->info(number_format($pro->price, 2));
            $this->info("------");
        }
    }
}
