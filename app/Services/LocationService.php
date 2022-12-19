<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\Location;
use App\Repositories\LocationRepository;

use Illuminate\Database\Eloquent\Collection;

class LocationService
{
    /**
     * @var $locationRepository
     */
    protected $locationRepository;

    /**
     * LocationService constructor.
     *
     * @param LocationRepository $locationRepository
     */
    public function __construct(LocationRepository $locationRepository)
    {
        $this->locationRepository = $locationRepository;
    }

    /**
     * Returns all locations
     * 
     * @param $filter - array with indecis [latitude, longitude, radius]
     * @return Collection
     */
    public function getAll(array $filter)
    {
        $latitude = $filter['latitude'];
        $longitude = $filter['longitude'];
        $radius = (int) $filter['radius'];

        return $this->locationRepository->getAll($latitude, $longitude, $radius);
    }
}
?>