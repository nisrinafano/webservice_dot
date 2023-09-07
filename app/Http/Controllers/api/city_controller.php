<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Helpers\api_formatter;
use App\Models\city;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class city_controller extends Controller
{
    // function to get city by id
    public function show(Request $request) {
        $id = $request->get('id');
        $city = city::where('city_id', $id)->get();

        if ($city) return api_formatter::create_api(200, 'Success', $city);
        else return api_formatter::create_api(400, 'Data not found');
    }

    public function save($arr) {
        $city_result = city::create([
            'city_id' => $arr['city_id'],
            'province_id' => $arr['province_id'],
            'province' => $arr['province'],
            'type' => $arr['type'],
            'city_name' => $arr['city_name'],
            'postal_code' => $arr['postal_code']
        ]);
    }

    public function curl_city($id = null) {
        if($id) $endpoint = "https://api.rajaongkir.com/starter/city?id=".$id;
        else $endpoint = "https://api.rajaongkir.com/starter/city";
        
        $response = Http::withHeaders([
            'key' => '0df6d5bf733214af6c6644eb8717c92c'
        ])->get($endpoint);
        
        return json_decode($response->body(), true)['rajaongkir']['results'];
    }

    public function fetch_data() {
        $fetch_result = $this->curl_city();
        foreach ($fetch_result as $value) {
            $this->save($value);
        }
    }

    public function swap_source(Request $request) {
        $source = $request->get('source');

        if ($source == 'database') $this->show($request);
        else if ($source == 'api') $this->curl_city($request->get('id'));
        else return api_formatter::create_api(400, 'Source not specified. Please use \'database\' or \'api\' as source value');
    }
}
