@extends('layouts.app')

@section('content')
<form action="{{ route('discounts.store') }}" method="POST" id="create-discount-form">
@csrf
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
                    <input type="text" class="form-control discounts-text" id="ruleName" name="ruleName" placeholder="{{ __('discounts.enter_rule_name') }}" required>
                </div>
                <div class="col-md-2">
                    <label class="switch float-end">
                        <input type="checkbox" id="activeToggle" name="activeToggle">
                        <span class="slider round"></span>
                    </label>
                    <input type="hidden" id="active" name="active" value="0">
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
                            <option value="null" selected>{{ __('Select') }}</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4 discount-group-field">
                        <label for="accessType" class="form-label">{{ __('Access_Type') }}</label>
                        <select class="form-select dashboard-filters-select" id="accessType" name="accessType">
                            <option value="null" selected>{{ __('Select') }}</option>
                            @foreach($accessTypes as $accessType)
                                <option value="{{ $accessType->code }}">{{ $accessType->name }}</option>
                            @endforeach
                         </select>
                    </div>
                    <div class="mb-4 discount-group-field">
                        <label for="priority" class="form-label">{{ __('Priority') }}</label>
                        <input type="number" class="form-control dashboard-filters-text" id="priority" name="priority" placeholder="{{ __('Enter...') }}" min="1" max="1000" required>
                    </div>
                    <div class="mb-4 discount-group-field">
                        <label for="regionSelect" class="form-label">{{ __('Region') }}</label>
                        <select class="form-select dashboard-filters-select" id="regionSelect" name="regionSelect">
                        <option value="null" selected>{{ __('Select') }}</option>
                        @foreach($regions as $region)
                            <option value="{{ $region->id }}">{{ $region->name }}</option>
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
    <div class="row">
        <div class="col-md-4 periods-form" id="period-fields-1">
            <div class="mb-3">
                <label for="applicationPeriod1" class="form-label">{{ __('discounts.application_period') }} 1</label>
                <div class="row g-2">
                    <div class="col-6">
                        <input type="date" class="form-control" id="applicationPeriod1Start" name="applicationPeriod1Start" placeholder="{{ __('discounts.start_date') }}">
                    </div>
                    <div class="col-6">
                        <input type="date" class="form-control" id="applicationPeriod1End" name="applicationPeriod1End" placeholder="{{ __('discounts.end_date') }}">
                    </div>
                </div>
            </div>
            <div class="discount-group-field w-100">
                <label for="discountCode1" class="form-label">{{ __('discounts.code_discount_label') }}</label>
                <input type="text" id="discountCode1" name="discountCode1" class="form-control" placeholder="{{ __('Code...') }}">
            </div>
            <div class="discount-group-field w-100">
                <label for="discountPercentage1" class="form-label">{{ __('discounts.porcent_discount_label') }}</label>
                <input type="number" id="discountPercentage1" name="discountPercentage1" class="form-control" placeholder="{{ __('Porcent...') }}">
            </div>
        </div>

        <div class="col-md-4 periods-form" id="period-fields-2">
            <div class="mb-3">
                <label for="applicationPeriod2" class="form-label">{{ __('discounts.application_period') }} 1</label>
                <div class="row g-2">
                    <div class="col-6">
                        <input type="date" class="form-control" id="applicationPeriod2Start" name="applicationPeriod2Start" placeholder="{{ __('discounts.start_date') }}">
                    </div>
                    <div class="col-6">
                        <input type="date" class="form-control" id="applicationPeriod2End" name="applicationPeriod2End" placeholder="{{ __('discounts.end_date') }}">
                    </div>
                </div>
            </div>
            <div class="discount-group-field w-100">
                <label for="discountCode2" class="form-label">{{ __('discounts.code_discount_label') }}</label>
                <input type="text" id="discountCode2" name="discountCode2" class="form-control" placeholder="{{ __('Code...') }}">
            </div>
            <div class="discount-group-field w-100">
                <label for="discountPercentage2" class="form-label">{{ __('discounts.porcent_discount_label') }}</label>
                <input type="number" id="discountPercentage2" name="discountPercentage2" class="form-control" placeholder="{{ __('Porcent...') }}">
            </div>
        </div>

        <div class="col-md-4 periods-form" id="period-fields-3">
            <div class="mb-3">
                <label for="applicationPeriod3" class="form-label">{{ __('discounts.application_period') }} </label>
                <div class="row g-2">
                    <div class="col-6">
                        <input type="date" class="form-control" id="applicationPeriod3Start" name="applicationPeriod3Start" placeholder="{{ __('discounts.start_date') }}">
                    </div>
                    <div class="col-6">
                        <input type="date" class="form-control" id="applicationPeriod3End" name="applicationPeriod3End" placeholder="{{ __('discounts.end_date') }}">
                    </div>
                </div>
            </div>
            <div class="discount-group-field w-100">
                <label for="discountCode3" class="form-label">{{ __('discounts.code_discount_label') }}</label>
                <input type="text" id="discountCode3" name="discountCode3" class="form-control" placeholder="{{ __('Code...') }}">
            </div>
            <div class="discount-group-field w-100">
                <label for="discountPercentage3" class="form-label">{{ __('discounts.porcent_discount_label') }}</label>
                <input type="number" id="discountPercentage3" name="discountPercentage"  class="form-control" placeholder="{{ __('Porcent...') }}">
            </div>
        </div>
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

    <!-- Buttons -->
    <div class="row">
        <div class="col-12 d-flex justify-content-end mt-4">
            <a href="/dashboard"><button type="button" class="btn btn-secondary me-2">{{ __('discounts.cancel') }}</button></a>
            <button type="submit" class="btn btn-primary" id="btn-create-discount">{{ __('discounts.save') }}</button>
        </div>
    </div>
</div>
</form>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const checkbox = document.getElementById('activeToggle');
    const hiddenInput = document.getElementById('active');

    checkbox.addEventListener('change', function() {
        if (checkbox.checked) {
            hiddenInput.value = '1';
        } else {
            hiddenInput.value = '0';
        }
    });

    /* validate selects */

    const form = document.getElementById("create-discount-form");

    form.addEventListener('submit', function(event) {
        const rental = document.getElementById('rental').value;
        const accessType = document.getElementById('accessType').value;
        const priority = document.getElementById('priority').value;
        const regionSelect = document.getElementById('regionSelect').value;

        if (rental === 'null' || accessType === 'null' || priority === '' || regionSelect === 'null') {
            event.preventDefault();
            // todo show alert
            return false;
        }
    });

    disableFields('period-fields-2');
    disableFields('period-fields-3');
    addChangeEventToPeriodFields('period-fields-1', 'period-fields-2');
    addChangeEventToPeriodFields('period-fields-2', 'period-fields-3');

    function addChangeEventToPeriodFields(currentPeriodId, nextPeriodId) {
        document.querySelectorAll('#' + currentPeriodId + ' input').forEach(function(input) {
            input.addEventListener('change', function() {
                if (checkPeriodFields(currentPeriodId)) {
                    enableFields(nextPeriodId);
                }
            });
        });
    }

    function disableFields(periodId) {
        document.querySelectorAll('#' + periodId + ' input').forEach(function(input) {
            input.disabled = true;
        });
    }

    function enableFields(periodId) {
        document.querySelectorAll('#' + periodId + ' input').forEach(function(input) {
            input.disabled = false;
        });
    }

    function checkPeriodFields(periodId) {
        const periodNumber = periodId.match(/\d+/)[0];
        const startDate = document.getElementById('applicationPeriod' + periodNumber + 'Start');
        const endDate = document.getElementById('applicationPeriod' + periodNumber + 'End');
        const discountCode = document.getElementById('discountCode' + periodNumber);
        const discountPercentage = document.getElementById('discountPercentage' + periodNumber);
        const createButton = document.getElementById('btn-create-discount');

        if (!startDate.value || !endDate.value) {
            return false;
        }

        if (startDate.value > endDate.value) {
            console.log('Error'); // TODO show popup or message
            createButton.disabled = true;
            return false;
        }else{
            createButton.disabled = false;
        }

        if (discountCode.value || discountPercentage.value) {
            return true;
        }
        return false;
    }
});
</script>


@endsection
