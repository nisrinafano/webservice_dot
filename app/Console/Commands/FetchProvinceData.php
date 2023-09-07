<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\api\province_controller;

class FetchProvinceData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:province';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch province data using Rajaongkir API';

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
    public function handle(province_controller $province)
    {
        $province->fetch_data();
        return 0;
    }
}
