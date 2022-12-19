<?php
namespace App\Repositories\RepositoryInterfaces;

interface LocationRepositoryInterface
{
   public function getAll(string $latitude, string $longitude, int $radius);
}