@extends('layouts.app')

@section('content')
<form action="{{ route('discounts.update', $discount->id) }}" method="POST" id="edit-discount-form">
    @csrf
    @method('PUT')
    <div class="container">
        <!-- Header -->
        <div class="row">
            <div class="col-md-8">
                <div class="text-left">
                    <h3>{{ __('discounts.header_title') }}</h3>
                    <p>{{ __('discounts.header_description') }}</p>
                </div>
            </div>
        </div>

        <!-- Discount Name -->
        <div class="app-form-container" id="dashboard">
            <div class="dashboard-form-container">
                <div class="row">
                    <div class="col-md-10">
                        <label for="ruleName" class="form-label"><strong>{{ __('discounts.rule_name') }}</strong></label>
                        <input type="text" class="form-control discounts-text" id="ruleName" name="ruleName" value="{{ $discount->name }}" required>
                    </div>
                    <div class="col-md-2">
                        <label class="switch float-end">
                            <input type="checkbox" id="activeToggle" name="activeToggle" {{ $discount->active ? 'checked' : '' }}>
                            <span class="slider round"></span>
                        </label>
                        <input type="hidden" id="active" name="active" value="{{ $discount->active }}">
                    </div>
                </div>
            </div>
        </div>

        <!-- Dashboard Filters -->
        <div class="dashboard-form-container">
            <div class="row dashboard-filters">
                <div class="col-md-12">
                    <section>
                        <div class="mb-4 discount-group-field">
                            <label for="rental" class="form-label">{{ __('Rental') }}</label>
                            <select class="form-select dashboard-filters-select" id="rental" name="rental">
                                <option value="null">{{ __('Select') }}</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ $discount->brand_id == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4 discount-group-field">
                            <label for="accessType" class="form-label">{{ __('Access_Type') }}</label>
                            <select class="form-select dashboard-filters-select" id="accessType" name="accessType">
                                <option value="null">{{ __('Select') }}</option>
                                @foreach($accessTypes as $accessType)
                                    <option value="{{ $accessType->code }}" {{ $discount->access_type_code == $accessType->code ? 'selected' : '' }}>{{ $accessType->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4 discount-group-field">
                            <label for="priority" class="form-label">{{ __('Priority') }}</label>
                            <input type="number" class="form-control dashboard-filters-text" id="priority" name="priority" value="{{ $discount->priority }}" min="1" max="1000" required>
                        </div>
                        <div class="mb-4 discount-group-field">
                            <label for="regionSelect" class="form-label">{{ __('Region') }}</label>
                            <select class="form-select dashboard-filters-select" id="regionSelect" name="regionSelect">
                                <option value="null">{{ __('Select') }}</option>
                                @foreach($regions as $region)
                                    <option value="{{ $region->id }}" {{ $discount->region_id == $region->id ? 'selected' : '' }}>{{ $region->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </section>
                </div>
            </div>
        </div>

        <!-- Description -->
        <div class="alert alert-secondary" role="alert">
            {{ __('discounts.warning_text') }}
        </div>

        <!-- Periods -->
<!-- Periods -->
<div class="row">
    @php
        $discountRanges = $discount->discountRanges->toArray();
    @endphp

    @forelse ($discountRanges as $index => $range)
        <div class="col-md-4 periods-form" id="period-fields-{{ $index + 1 }}">
            <!-- ... [campos para cada rango de descuento] ... -->
            <input type="date" value="{{ $range['start'] ?? '' }}" ...>
            <input type="date" value="{{ $range['end'] ?? '' }}" ...>
            <input type="text" value="{{ $range['code'] ?? '' }}" ...>
            <input type="number" value="{{ $range['discount'] ?? '' }}" ...>
            <!-- ... [resto de los campos] ... -->
        </div>
    @empty
        <!-- Manejar caso en que no haya rangos de descuento -->
        <p>No hay rangos de descuento asociados con este descuento.</p>
    @endforelse
</div>


<!-- Adaptation Period Warning -->
<div class="row periods-form warning-period-m" style="display:none">
    <div class="col-md-2">
        <label for="adaptationPeriod" class="form-label"><strong>{{ __('discounts.adaptation_period_label') }}</strong></label>
        <input type="text" class="form-control discounts-text" id="adaptationPeriod" name="adaptationPeriod" placeholder="{{ __('discounts.adaptation_period_label') }}">
    </div>
    <div class="col-md-2">
        <div class="alert alert-secondary warning-period" role="alert">
            {{ __('discounts.warning_period') }}
        </div>
    </div>
</div>


<!-- . periods ..->


        <!-- Buttons -->
        <div class="row">
            <div class="col-12 d-flex justify-content-end mt-4">
                <a href="/dashboard"><button type="button" class="btn btn-secondary me-2">{{ __('discounts.cancel') }}</button></a>
                <button type="submit" class="btn btn-primary" id="btn-edit-discount">{{ __('discounts.save') }}</button>
            </div>
        </div>
    </div>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const checkbox = document.getElementById('activeToggle');
        const hiddenInput = document.getElementById('active');

        checkbox.addEventListener('change', function() {
            hiddenInput.value = checkbox.checked ? '1' : '0';
        });

    });
</script>

@endsection
