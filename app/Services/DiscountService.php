<?php

namespace App\Services;
use Exception;

use App\Repositories\DiscountRepository;

class DiscountService
{
    protected $discountRepository;

    public function __construct(DiscountRepository $discountRepository)
    {
        $this->discountRepository = $discountRepository;
    }

    public function createDiscount(array $data)
    {
        try {
            return $this->discountRepository->create($data);
        } catch (Exception $exception) {
            // TODO LOG
            throw new Exception('Error ' . $exception->getMessage());
        }
    }

    public function getAllDiscounts($params)
    {
        try {
            return $this->discountRepository->getAllDiscounts($params);
        } catch (Exception $exception) {
            // TODO LOG
            throw new Exception('Error ' . $exception->getMessage());
        }
    }

    public function deleteDiscount($id)
    {
        try {
            $this->discountRepository->delete($id);
        } catch (Exception $exception) {
            // TODO LOG
            throw new Exception('Error deleting discount: ' . $exception->getMessage());
        }
    }

    public function getById($id)
    {
        return $this->discountRepository->findWithDiscountRanges($id);
    }

    public function updateDiscount($id, array $data)
    {
        $discount = $this->discountRepository->find($id);
        if ($discount) {
            return $discount->update($data);
        }
        throw new \Exception("Discount not found.");
    }

    public function getRangesByDiscountId($discountId)
    {
        return $this->discountRangeRepository->getRangesByDiscountId($discountId);
    }

    public function updateDiscountRange($id, array $data)
    {
        $range = $this->discountRangeRepository->find($id);
        $range->update($data);
    }


}

