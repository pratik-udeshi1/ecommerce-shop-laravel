<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use App\Models\Shop;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        return Shop::all();
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        return "shop stored succesfully!";
    }

    public function show(Shop $shop)
    {

    }

    public function edit(Shop $shop)
    {

    }

    public function update(Request $request, Shop $shop)
    {

    }

    public function destroy(Shop $shop)
    {

    }
}
