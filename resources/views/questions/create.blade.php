@extends('layouts.app')

@section('breadcrumb', 'Add Question')
@section('page-title', 'Add Question')
@section('title', 'Add Question')

@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-6 mb-md-0 mb-4">
            <div class="card">
                <div class="card-header pb-0">
                    <h6>Add Question</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('questions.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="process_code">Process Code</label>
                            <select class="form-control" id="process_code" name="process_code" required>
                                <option value="">-- Select Process Code --</option>
                                @foreach ($processAudits as $processAudit)
                                    <option value="{{ $processAudit->id_process_audit }}">
                                        {{ $processAudit->name }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="text-muted">Choose the process code associated with this question.</small>
                        </div>
                        <div class="form-group mb-3">
                            <label for="level">Level</label>
                            <input type="number" class="form-control" id="level" name="level"
                                placeholder="Enter level (e.g., 1, 2, 3)" required>
                            <small class="text-muted">Specify the level for this question.</small>
                        </div>
                        <div class="form-group mb-3">
                            <label for="pa">PA</label>
                            <input type="text" class="form-control" id="pa" name="pa"
                                placeholder="Enter PA code (e.g., PA1, PA2)" required>
                            <small class="text-muted">Provide the PA code for this question.</small>
                        </div>
                        <div class="form-group mb-3">
                            <label for="question">Question</label>
                            <textarea class="form-control" id="question" name="question" placeholder="Enter the question text here" rows="3"
                                required></textarea>
                            <small class="text-muted">Write the question clearly and concisely.</small>
                        </div>
                        <div class="form-group mb-3">
                            <label for="description">Description (Optional)</label>
                            <textarea class="form-control" id="description" name="description"
                                placeholder="Enter a brief description or additional details (optional)" rows="3"></textarea>
                            <small class="text-muted">Add extra details about the question, if needed.</small>
                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>
                        <a href="{{ route('questions.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
