@extends('layouts.app')

@section('breadcrumb', 'Projects')
@section('page-title', 'Add Project')
@section('title', 'Add Project')

@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-6 mb-md-0 mb-4">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-lg-6 col-7">
                            <h6>Add Project</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('projects.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Project Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Enter project name" required>
                        </div>

                        <input type="hidden" name="audit_at" value="{{ now() }}">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('projects.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection
