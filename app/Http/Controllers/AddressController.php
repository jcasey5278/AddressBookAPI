<?php

namespace App\Http\Controllers;

use App\Http\Requests\Address\CreateRequest;
use App\Http\Requests\Address\IndexRequest;
use App\Http\Requests\Address\ShowRequest;
use App\Models\Address;

class AddressController extends Controller
{

    public function index(IndexRequest $request)
    {
        return $request->addresses;
    }

    public function show(ShowRequest $request, Address $address): Address
    {
        return $address;
    }

    public function store(CreateRequest $request)
    {
        return Address::firstOrCreate($request->validated());
    }

    public function update()
    {
        //TODO: fill update
    }

    public function delete()
    {
        //TODO: fill delete
    }
}
