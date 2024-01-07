<?php

namespace App\Services;

use App\Repositories\AccessTypeRepository;

class AccessTypeService
{
    protected $accessTypeRepository;

    public function __construct(AccessTypeRepository $accessTypeRepository)
    {
        $this->accessTypeRepository = $accessTypeRepository;
    }

    public function getAllAccessTypes()
    {
        return $this->accessTypeRepository->getAll();
    }
}
