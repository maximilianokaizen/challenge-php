@extends('layouts.app')
@section('content')
<form action="{{ route('dashboard') }}" method="get">
<div class="container">
    <!-- header -->
    <div class="row">
        <div class="col-md-8">
            <div class="text-left">
                <h3>{{ __('dashboard_home.header_title') }}</h3>
                <p>{{ __('dashboard_home.header_description') }}</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="text-right float-end">
                <button class="btn btn-primary btn-success">
                    <a href="discount/create"><i class="fas fa-plus"></i> {{ __('dashboard_home.btn_new_descount') }}</a>
                </button>
            </div>
        </div>
    </div>
</div>
<!-- .header -->
<div class="clearfix"></div>
<!-- filters -->
<div class="dashboard-form-container" id="dashboard">
    <div class="row dashboard-filters">
        <div class="col-md-9">
            <section>
                <div class="mb-3 dashboard-filter-field">
                    <label for="rental" class="form-label">{{ __('Rental') }}</label>
                    <select class="form-select dashboard-filters-select" id="rental" name="brand_id">
                        <option value="">{{ __('Select') }}</option>
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}" {{ request('brand_id') == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3 dashboard-filter-field">
                    <label for="region" class="form-label">{{ __('Region') }}</label>
                    <select class="form-select dashboard-filters-select" id="region" name="region_id">
                        <option value="">{{ __('Select') }}</option>
                        @foreach($regions as $region)
                            <option value="{{ $region->id }}" {{ request('region_id') == $region->id ? 'selected' : '' }}>{{ $region->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3 dashboard-filter-field">
                    <label for="name" class="form-label">{{ __('Name') }}</label>
                    <input type="text" class="form-control dashboard-filters-text" id="name" name="name" value="{{ request('name') }}" placeholder="{{ __('Enter...') }}">
                </div>
                <div class="mb-3 dashboard-filter-field">
                    <label class="form-label">{{ __('AWD/BCD') }}</label>
                    <input type="text" class="form-control dashboard-filters-text" id="awd-bcd" name="code" value="{{ request('code') }}" placeholder="{{ __('Missing...') }}">
                </div>
            </section>
        </div>
        <div class="col-md-3 float-end">
        <a href="{{ route('dashboard') }}">
            <button class="btn btn-secondary btn-dashboard-blue btn-sm f-r" id="clearFiltersBtn">{{ __('Clear Filters') }}</button>
        </a>
        <button class="btn btn-secondary btn-dashboard-gray btn-sm f-r">{{ __('Search') }}</button>
        </div>
    </div>
</div>
<!-- .filters -->
<!-- discounts list -->
<div class="dashboard-form-container">
<table class="table table-striped table-hover" id="discounts-list">
    <thead>
        <tr>
            <th>{{ __('Rental') }} </i></th>
            <th>{{ __('Region') }} </i></th>
            <th>{{ __('Name') }} </i></th>
            <th>{{ __('Access Type') }} </i></th>
            <th>{{ __('Status') }} </i></th>
            <th>{{ __('Period') }} </i></th>
            <th>{{ __('AWD/BCD') }} </i></th>
            <th>{{ __('GSA Discounts') }} </i></th>
            <th>{{ __('Promotion Period') }} </i></th>
            <th>{{ __('Priority') }} </i></th>
            <th>{{ __('Editar') }} </i></th>
            <th>{{ __('Eliminar') }} </i></th>
        </tr>
    </thead>
    <tbody>
        @foreach($discounts as $discount)
        <tr>
            <td>{{ $discount['rentadora'] }}</td>
            <td>{{ $discount['region'] }}</td>
            <td>{{ $discount['nombre'] }}</td>
            <td>{{ $discount['tipo_acceso'] }}</td>
            @if($discount['estado'])
            <td><span class="badge bg-success">ACTIVE</span></td>
            @else
            <td><span class="badge bg-danger">INACTIVE</span></td>
            @endif
            <td>{!! nl2br(e($discount['periodo'])) !!}</td>
            <td>{!! nl2br(e($discount['awd_bcd'])) !!}</td>
            <td>GSA Discounts 1</td>
            <td>{!! nl2br(e($discount['descuento_gsa'])) !!}</td>
            <td>{{ $discount['prioridad'] }}</td>
            <td> <a href="{{ route('discount.edit', $discount['id']) }}" class="btn btn-primary">{{ __('Edit') }}</a></td>
            <td>
                <a href="{{ route('discount.delete', $discount['id']) }}" class="btn btn-danger" onclick="return confirm('{{ __('¿Estás seguro de que quieres eliminar este elemento?') }}')">
                    {{ __('Delete') }}
                </a>
            </td>
        </tr>
        @endforeach
        <!-- Agrega más filas según sea necesario -->
    </tbody>
</table>
</div>
<!-- end of discounts list  -->
<!-- pagination -->
<nav aria-label="Page navigation example">
    <ul class="pagination">
        <li class="page-item {{ $pagination['current_page'] == 1 ? 'disabled' : '' }}">
        <a class="page-link" href="/dashboard/?page={{ $pagination['current_page'] - 1 }}" aria-label="Prev">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>
        @for ($i = 1; $i <= $pagination['last_page']; $i++)
            <li class="page-item {{ $pagination['current_page'] == $i ? 'active' : '' }}">
                <a class="page-link" href="/dashboard/?page={{ $i }}">{{ $i }}</a>
            </li>
        @endfor
        <li class="page-item {{ $pagination['current_page'] == $pagination['last_page'] ? 'disabled' : '' }}">
            <a class="page-link" href="/dashboard/?page={{ $pagination['current_page'] + 1 }}" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
    </ul>
</nav>
<!-- .pagination -->
</form>
@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('clearFiltersBtn').addEventListener('click', function(event) {
            event.preventDefault();
            window.location.href = '/dashboard';
        });
    });
</script>
@endsection
@endsection

