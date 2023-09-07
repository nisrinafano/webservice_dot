<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Helpers\api_formatter;

class province_controller extends Controller
{
    // function to get province by id
    public function show(Request $request) {
        $id = $request->get('id');
        $province = province::where('province_id', $id)->get();

        if ($province) return api_formatter::create_api(200, 'Success', $province);
        else return api_formatter::create_api(400, 'Data not found');
    }

    public function save($arr) {
        $province_result = province::create([
            'province_id' => $arr['province_id'],
            'province' => $arr['province']
        ]);
    }
    
    public function curl_province($id = null) {
        if($id) $endpoint = "https://api.rajaongkir.com/starter/province?id=".$id;
        else $endpoint = "https://api.rajaongkir.com/starter/province";

        $response = Http::withHeaders([
            'key' => '0df6d5bf733214af6c6644eb8717c92c'
        ])->get($endpoint);
        
        return json_decode($response->body(), true)['rajaongkir']['results'];
    }

    public function fetch_data() {
        $fetch_result = $this->curl_province();
        foreach ($fetch_result as $value) {
            $this->save($value);
        }
    }

    public function swap_source(Request $request) {
        $source = $request->get('source');

        if ($source == 'database') $this->show($request);
        else if ($source == 'api') $this->curl_province($request->get('id'));
        else return api_formatter::create_api(400, 'Source not specified. Please use \'database\' or \'api\' as source value');
    }
}
