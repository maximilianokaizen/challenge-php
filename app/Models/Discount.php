<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Discount extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'priority',
        'active',
        'region_id',
        'brand_id',
        'access_type_code',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'active' => 'boolean',
    ];

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function accessType()
    {
        return $this->belongsTo(AccessType::class, 'access_type_code', 'code');
    }

    public function discountRanges()
    {
        return $this->hasMany(DiscountRange::class);
    }


}
