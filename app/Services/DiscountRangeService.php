<?php

namespace App\Services;

use App\Models\DiscountRange;
use App\Repositories\DiscountRangeRepository;

class DiscountRangeService
{
    protected $discountRangeRepository;

    public function __construct(DiscountRangeRepository $discountRangeRepository)
    {
        $this->discountRangeRepository = $discountRangeRepository;
    }

    public function createDiscountRange(array $data)
    {
        return $this->discountRangeRepository->create($data);
    }
}
