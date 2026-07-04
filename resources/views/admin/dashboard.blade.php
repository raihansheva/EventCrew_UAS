@extends('layouts.mainAdmin')
@section('page-title', 'Dashboard')
<link rel="stylesheet" href="{{ asset('style/admin/dashboard.css') }}">
@section('content')
    <div class="admin-section">
        {{-- <div class="section-header"></div>  --}}
        <div class="section-body">
            <div class="area-total-statik">
                <div class="card-total one">
                    <div class="total-value">{{ $volunteer }}</div>
                    <div class="total-label">Total Volunteers</div>
                </div>
                <div class="card-total two">
                    <div class="total-value">{{ $event }}</div>
                    <div class="total-label">Active Events</div>
                </div>
                <div class="card-total three">
                    <div class="total-value">{{ $kategori }}</div>
                    <div class="total-label">Upcoming Events</div>
                </div>
                <div class="card-total four">
                    <div class="total-value">75</div>
                    <div class="total-label">Completed Events</div>
                </div>
            </div>
        </div>
    </div>
@endsection