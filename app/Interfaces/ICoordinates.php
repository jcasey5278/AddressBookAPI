<?php

namespace App\Interfaces;

interface ICoordinates
{

    public function fetchLatitude(string $address): string;

    public function fetchLongitude(string $address): string;
}
