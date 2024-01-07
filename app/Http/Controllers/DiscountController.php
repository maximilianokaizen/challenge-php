<?php

namespace App\Http\Controllers;

use App\Services\BrandService;
use App\Services\AccessTypeService;
use App\Services\RegionService;
use App\Services\DiscountService;
use App\Services\DiscountRangeService;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    protected $brandService;
    protected $accessTypeService;
    protected $regionService;
    protected $discountService;
    protected $discountRangeService;

    public function __construct(
        BrandService $brandService,
        AccessTypeService $accessTypeService,
        RegionService $regionService,
        DiscountService $discountService,
        DiscountRangeService $discountRangeService
    ) {
        $this->brandService = $brandService;
        $this->accessTypeService = $accessTypeService;
        $this->regionService = $regionService;
        $this->discountService = $discountService;
        $this->discountRangeService = $discountRangeService;
    }

    public function create()
    {
        $brands = $this->brandService->getAllBrands();
        $accessTypes = $this->accessTypeService->getAllAccessTypes();
        $regions = $this->regionService->getAllRegions();
        return view('discounts.create', compact('brands', 'accessTypes', 'regions'));
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $this->validateDiscountData($request);
            $discount = $this->discountService->createDiscount($this->mapRequestData($validatedData));
            $this->createDiscountRanges($discount, $validatedData);
            return redirect()->route('dashboard')->with('success', __('Descuento creado con éxito.'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }

    private function validateDiscountData(Request $request)
    {
        return $request->validate([
            'ruleName' => 'required|alpha_num|unique:discounts,name|max:255',
            'active' => 'required|boolean',
            'rental' => 'required|exists:brands,id',
            'accessType' => 'required|exists:access_types,code',
            'priority' => 'required|numeric|min:1|max:1000',
            'regionSelect' => 'required|exists:regions,id',
            'applicationPeriod1Start' => 'required|date',
            'applicationPeriod1End' => 'required|date|after_or_equal:applicationPeriod1Start',
            'applicationPeriod2Start' => 'nullable|date',
            'applicationPeriod2End' => 'nullable|date|after_or_equal:applicationPeriod2Start',
            'applicationPeriod3Start' => 'nullable|date',
            'applicationPeriod3End' => 'nullable|date|after_or_equal:applicationPeriod3Start',
            'discountCode1' => 'required|alpha_num',
            'discountCode2' => 'nullable|alpha_num',
            'discountCode3' => 'nullable|alpha_num',
            'discountPercentage1' => 'required|numeric',
            'discountPercentage2' => 'nullable|numeric',
            'discountPercentage3' => 'nullable|numeric',
        ]);
    }

    public function delete($id)
    {
        try {
            $this->discountService->deleteDiscount($id);
            return redirect()->route('dashboard')->with('success', __('Descuento eliminado con éxito.'));
        } catch (\Exception $e) {
            return redirect()->route('dashboard')->with('error', $e->getMessage());
        }
    }

    private function shouldCreateAdditionalDiscount($validatedData, $periodNumber)
    {
        return isset($validatedData["applicationPeriod{$periodNumber}Start"]) &&
            isset($validatedData["applicationPeriod{$periodNumber}End"]) &&
            !is_null($validatedData["applicationPeriod{$periodNumber}Start"]) &&
            !is_null($validatedData["applicationPeriod{$periodNumber}End"]);
    }

    private function createDiscountRanges($discount, $validatedData)
    {
        for ($i = 1; $i <= 3; $i++) {
            if (!empty($validatedData["applicationPeriod{$i}Start"]) && !empty($validatedData["applicationPeriod{$i}End"])) {
                $this->discountRangeService->createDiscountRange([
                    'from_days' => $this->extractDayNumber($validatedData["applicationPeriod{$i}Start"]),
                    'to_days' => $this->extractDayNumber($validatedData["applicationPeriod{$i}End"]),
                    'discount' => $validatedData["discountPercentage{$i}"] ?? 0,
                    'code' => $validatedData["discountCode{$i}"] ?? null,
                    'discount_id' => $discount->id,
                ]);
            }
        }
    }

    private function createAdditionalDiscount($validatedData, $mappedData, $periodNumber)
    {
        $mappedData['start_date'] = $validatedData["applicationPeriod{$periodNumber}Start"];
        $mappedData['end_date'] = $validatedData["applicationPeriod{$periodNumber}End"];
        $this->discountService->createDiscount($mappedData);
    }

    private function extractDayNumber($date)
    {
        return \Carbon\Carbon::createFromFormat('Y-m-d', $date)->day;
    }

    public function edit($id)
    {
        $discount = $this->discountService->getById($id);
        $brands = $this->brandService->getAllBrands();
        $accessTypes = $this->accessTypeService->getAllAccessTypes();
        $regions = $this->regionService->getAllRegions();
        return view('discounts.edit', compact('discount', 'brands', 'accessTypes', 'regions'));
    }

    public function update(Request $request, $id)
    {
        try {
            $validatedData = $this->validateDiscountData($request);
            $this->discountService->updateDiscount($id, $this->mapRequestData($validatedData));
            $this->updateDiscountRanges($id, $validatedData);
            return redirect()->route('dashboard')->with('success', __('Descuento actualizado con éxito.'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }

    private function updateDiscountRanges($discountId, $validatedData)
{
    $currentRanges = $this->discountRangeService->getRangesByDiscountId($discountId);

    for ($i = 1; $i <= 3; $i++) {
        if (!empty($validatedData["applicationPeriod{$i}Start"]) && !empty($validatedData["applicationPeriod{$i}End"])) {
            $rangeData = [
                'from_days' => $this->extractDayNumber($validatedData["applicationPeriod{$i}Start"]),
                'to_days' => $this->extractDayNumber($validatedData["applicationPeriod{$i}End"]),
                'discount' => $validatedData["discountPercentage{$i}"] ?? 0,
                'code' => $validatedData["discountCode{$i}"] ?? null,
            ];  

            if (isset($currentRanges[$i - 1])) {
                $this->discountRangeService->updateDiscountRange($currentRanges[$i - 1]->id, $rangeData);
            } else {
                $rangeData['discount_id'] = $discountId;
                $this->discountRangeService->createDiscountRange($rangeData);
            }
        }
    }
}

    public function destroy($id)
    {
    }

    private function mapRequestData($data)
    {
        return [
            'name' => $data['ruleName'] ?? null,
            'active' => $data['active'] ?? null,
            'brand_id' => $data['rental'] ?? null,
            'access_type_code' => $data['accessType'] ?? null,
            'priority' => $data['priority'] ?? null,
            'region_id' => $data['regionSelect'] ?? null,
            'start_date' => $data['applicationPeriod1Start'] ?? null,
            'end_date' => $data['applicationPeriod1End'] ?? null,
        ];
    }



}
