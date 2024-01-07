<?php

namespace App\Repositories;

use App\Models\Region;

class RegionRepository
{
    public function getAll()
    {
        return Region::orderBy('display_order')
        ->get();
    }
}
