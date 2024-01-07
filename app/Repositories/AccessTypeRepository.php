<?php

namespace App\Repositories;

use App\Models\AccessType;

class AccessTypeRepository
{
    public function getAll()
    {
        return AccessType::orderBy('display_order')
            ->get();
    }
}
