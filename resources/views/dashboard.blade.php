@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="row">
        <div class="col-12">
            <h1>Welcome to the Dashboard</h1>
            <p>{{ __("You're logged in as") }} <strong>{{ auth()->user()->role }}</strong></p>
        </div>
    </div>
    <div class="row">
        <!-- Total Questions -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Total Questions</h5>
                    <p class="card-text">
                        {{ $totalQuestions }}
                    </p>
                </div>
            </div>
        </div>
        <!-- Total Process Audits -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">Total Process Audits</h5>
                    <p class="card-text">
                        {{ $totalProcessAudits }}
                    </p>
                </div>
            </div>
        </div>
        <!-- Total Projects -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <h5 class="card-title">Total Projects</h5>
                    <p class="card-text">
                        {{ $totalProjects }}
                    </p>
                </div>
            </div>
        </div>
        <!-- Add more totals as needed -->
    </div>
@endsection
