<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Models\Location;
use App\Repositories\RepositoryInterfaces\LocationRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class LocationRepository implements LocationRepositoryInterface
{
    public function getAll(string $latitude, string $longitude, int $radius)
    {
        return Location::getLocations($latitude, $longitude, $radius);
    }
}