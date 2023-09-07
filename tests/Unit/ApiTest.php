<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\province;
use App\Models\city;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\Sanctum;

class ApiTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    // test to allow only authenticated user to get the province data
    public function test_show_province_to_authenticated_user() {
        Sanctum::actingAs(
            User::factory()->create(),
        );

        $response = $this->get('/api/search/provinces?id=1');
        $province = province::where('province_id', 1)->get();

        $response->assertStatus(200);
        $response->assertSeeText($province[0]['province']);
    }

    // test to allow only authenticated user to get the city data
    public function test_show_city_to_authenticated_user() {
        Sanctum::actingAs(
            User::factory()->create(),
        );

        $response = $this->get('/api/search/cities?id=1');
        $city = city::where('city_id', 1)->get();

        $response->assertStatus(200);
        $response->assertSeeText($city[0]['province']);
        $response->assertSeeText($city[0]['type']);
        $response->assertSeeText($city[0]['city_name']);
        $response->assertSeeText($city[0]['postal_code']);
    }

    // test to block unauthenticated user to get the province data
    public function test_not_allow_access_province_publicly() {
        $response = $this->get('/api/search/provinces?id=1', [
            'Accept' => 'application/json'
        ]);
        $response->assertSeeText('message');
        $response->assertSeeText('Unauthenticated');
    }

    // test to block unauthenticated user to get the city data
    public function test_not_allow_access_city_publicly() {
        $response = $this->get('/api/search/cities?id=1', [
            'Accept' => 'application/json'
        ]);
        $response->assertSeeText('message');
        $response->assertSeeText('Unauthenticated');
    }

    // test to see if the authenticated user get the token
    public function test_token_for_valid_user() {
        $response = $this->post('/api/login', [
            'email' => 'admin@noemail.com',
            'password' => 'h3LL0WoRLd'
        ]);

        $response->assertStatus(200);
        $response->assertSeeText('token');
    }
}
