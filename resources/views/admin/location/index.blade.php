@extends('admin.layouts.master')

@section('main-content')

  <section class="section">
        <div class="section-header">
            <h1>{{ __('Locations') }}</h1>
            {{ Breadcrumbs::render('departments') }}
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        @can('locations_create')
                            <div class="card-header">
                                <a href="{{ route('admin.locations.create') }}" class="btn btn-icon icon-left btn-primary"><i class="fas fa-plus"></i> {{ __('Add Location') }}</a>
                            </div>
                        @endcan
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table table-striped" id="maintable" data-url="{{ route('admin.locations.get-locations') }}" data-status="{{ \App\Enums\Status::ACTIVE }}" data-hidecolumn="{{ auth()->user()->can('departments_edit') || auth()->user()->can('departments_delete') }}">
                                    <thead>
                                        <tr>
                                            <th>{{ __('levels.id') }}</th>
                                            <th>{{ __('levels.location_name') }}</th>
                                            <th>{{ __('levels.location_code') }}</th>
                                            <th>{{ __('levels.actions') }}</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
@endsection

@section('scripts')
    <script src="{{ asset('assets/modules/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/modules/datatables.net-select-bs4/js/select.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/location/index.js') }}"></script>
@endsection
