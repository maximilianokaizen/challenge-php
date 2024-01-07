<?php
namespace App\Repositories;

use App\Models\Discount;
use Illuminate\Database\QueryException;

class DiscountRepository
{
    public function create(array $data)
    {
        try {
            return Discount::create($data);
        } catch (QueryException $exception) {
            // TODO LOG
            throw new \Exception('Error creating discount');
        }
    }

    public function getAllDiscounts($params)
    {
        $query = Discount::query();

        $query->with([
            'brand',
            'region',
            'accessType',
            'discountRanges'
        ]);

        if (!empty($params['filter']['brand_id'])) {
            $query->where('brand_id', $params['filter']['brand_id']);
        }

        if (!empty($params['filter']['region_id'])) {
            $query->where('region_id', $params['filter']['region_id']);
        }

        if (!empty($params['filter']['name'])) {
            $query->where('name', 'like', '%' . $params['filter']['name'] . '%');
        }

        if (!empty($params['filter']['code'])) {
            $query->whereHas('discountRanges', function ($q) use ($params) {
                $q->where('code', $params['filter']['code']);
            });
        }

        if (isset($params['order_by']) && isset($params['order_direction'])) {
            $query->orderBy($params['order_by'], $params['order_direction']);
        }

        $perPage = $params['perPage'] ?? 1;
        $page = $params['page'] ?? 1;
        $total = $query->count();
        $query->skip(($page - 1) * $perPage)->take($perPage);

        $discounts = $query->get()->map(function ($discount) {
            $discountRangesString = $discount->discountRanges->map(function ($range) {
                return "{$range->from_days}-{$range->to_days}\n";
            })->join('');

            $discountCodesString = $discount->discountRanges->map(function ($range) {
                return "{$range->code}\n";
            })->join('');

            $discountPercentagesString = $discount->discountRanges->map(function ($range) {
                return "{$range->discount}%\n";
            })->join('');

            return [
                'id' => $discount->id ?? '',
                'rentadora' => $discount->brand->name ?? '',
                'region' => $discount->region->name ?? '',
                'nombre' => $discount->name,
                'tipo_acceso' => $discount->accessType->name ?? '',
                'estado' => $discount->active,
                'periodo' => $discountRangesString,
                'awd_bcd' => $discountCodesString,
                'descuento_gsa' => $discountPercentagesString,
                'prioridad' => $discount->priority,
            ];
        });

        $result = [
            'data' => $discounts,
            'pagination' => [
                'total' => $total,
                'per_page' => $perPage,
                'current_page' => $page,
                'last_page' => ceil($total / $perPage),
                'from' => (($page - 1) * $perPage) + 1,
                'to' => min($page * $perPage, $total),
            ],
        ];

        return $result;
    }

    public function delete($id)
    {
        try {
            $discount = Discount::find($id);
            $discount->delete();
        } catch (QueryException $exception) {
            // TODO LOG
            throw new \Exception('Error deleting discount');
        }
    }

    public function findById($id)
    {
        try {
            return Discount::findOrFail($id);
        } catch (QueryException $exception) {
            // TODO LOG
            throw new \Exception('Error finding discount');
        }
    }

    public function findWithDiscountRanges($id)
    {
        return Discount::with('discountRanges')->find($id);
    }

}
