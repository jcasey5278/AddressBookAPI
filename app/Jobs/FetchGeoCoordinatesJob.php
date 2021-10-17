<?php

namespace App\Jobs;

use App\Interfaces\ICoordinates;
use App\Models\Address;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class FetchGeoCoordinatesJob implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $api;
    protected $address;

    public $uniqueFor = 1;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Address $address)
    {
        $this->api = app()->make(ICoordinates::class);
        $this->address = $address;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $address = $this->address->address;
        $latitude = $this->api->fetchLatitude($address);
        $longitude = $this->api->fetchLongitude($address);
        $this->address->update([
            'lat' => $latitude,
            'long' => $longitude
        ]);
    }
}
