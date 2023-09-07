<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\api\city_controller;

class FetchCityData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:city';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch city data using Rajaongkir API';

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
     * @return int
     */
    public function handle(city_controller $city)
    {
        $city->curl_city();
        return 'Success';
    }
}
