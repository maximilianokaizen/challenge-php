<?php

namespace App\Services;

use App\Repositories\RegionRepository;

class RegionService
{
    protected $regionRepository;

    public function __construct(RegionRepository $regionRepository)
    {
        $this->regionRepository = $regionRepository;
    }

    public function getAllRegions()
    {
        return $this->regionRepository->getAll();
    }
}
