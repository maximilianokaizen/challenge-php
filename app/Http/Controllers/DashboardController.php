<?php

namespace App\Http\Controllers;

use App\Services\DiscountService;
use App\Services\BrandService;
use App\Services\RegionService;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $discountService;
    protected $brandService;
    protected $regionService;

    public function __construct(
        DiscountService $discountService,
        BrandService $brandService,
        RegionService $regionService,
    ) {
        $this->discountService = $discountService;
        $this->brandService = $brandService;
        $this->regionService = $regionService;
    }

    public function index(Request $request)
    {
        $page = $request->input('page', 1);
        $perPage = 15;

        $filterParams = [];
        if (is_numeric($request->input('brand_id'))) {
            $filterParams['brand_id'] = $request->input('brand_id');
        }
        if (is_numeric($request->input('region_id'))) {
            $filterParams['region_id'] = $request->input('region_id');
        }
        $filterParams['name'] = $request->input('name');
        $filterParams['code'] = $request->input('code');

        $params = [
            'filter' => $filterParams,
            'order_by' => $request->input('order_by', 'id'),
            'order_direction' => $request->input('order_direction', 'desc'),
            'page' => $page,
            'perPage' => $perPage,
        ];

        $brands = $this->brandService->getAllBrands();
        $regions = $this->regionService->getAllRegions();

        $discountsResult = $this->discountService->getAllDiscounts($params);

        return view('dashboard_home', [
            'discounts' => $discountsResult['data'],
            'pagination' => $discountsResult['pagination'],
            'brands' => $brands,
            'regions' => $regions
        ]);
    }
}
