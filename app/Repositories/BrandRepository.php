<?php

namespace App\Repositories;

use App\Models\Brand;

class BrandRepository
{
    public function getAll()
    {
        return Brand::where('active', 1)
            ->orderBy('display_order')
            ->get();
    }
}
