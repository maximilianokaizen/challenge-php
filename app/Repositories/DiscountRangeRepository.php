<?php
namespace App\Repositories;

use App\Models\DiscountRange;
use Exception;

class DiscountRangeRepository
{
    public function create(array $data)
    {
        return DiscountRange::create($data);
    }

    public function getRangesByDiscountId($discountId)
    {
        return DiscountRange::where('discount_id', $discountId)->get();
    }

    public function find($id)
    {
        return DiscountRange::find($id);
    }

    public function update($id, array $data)
    {
        try {
            $discountRange = $this->find($id);
            if ($discountRange) {
                $discountRange->update($data);
                return $discountRange;
            } else {
                throw new Exception("Discount range not found.");
            }
        } catch (Exception $e) {
            throw new Exception('Error updating discount range: ' . $e->getMessage());
        }
    }
}
