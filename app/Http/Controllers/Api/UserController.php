<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public $client;
    public $api_url;

    public function __construct(Request $request)
    {
        $this->api_url = env('QUICKBAZAR_API_URL');
        $this->client = new Client();
    }

    public function index()
    {
        $res = $this->client->request('GET', $this->api_url . 'user/all');

        return response()->json(
            \GuzzleHttp\json_decode($res->getBody()),
            $res->getStatusCode()
        );
    }
}
