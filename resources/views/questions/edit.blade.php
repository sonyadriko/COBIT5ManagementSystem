@extends('layouts.app')

@section('breadcrumb', 'Edit Question')
@section('page-title', 'Edit Question')
@section('title', 'Edit Question')

@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-6 mb-md-0 mb-4">
            <div class="card">
                <div class="card-header pb-0">
                    <h6>Edit Question</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('questions.update', $question->id_question) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label for="process_code">Process Code</label>
                            <select class="form-control" id="process_code" name="process_code" required>
                                <option value="">-- Select Process Code --</option>
                                @foreach ($processAudits as $processAudit)
                                    <option value="{{ $processAudit->id_process_audit }}"
                                        {{ $processAudit->id_process_audit == $question->process_code ? 'selected' : '' }}>
                                        {{ $processAudit->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="level">Level</label>
                            <input type="number" class="form-control" id="level" name="level"
                                value="{{ $question->level }}" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="pa">PA</label>
                            <input type="text" class="form-control" id="pa" name="pa"
                                value="{{ $question->pa }}" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="question">Question</label>
                            <textarea class="form-control" id="question" name="question" required>{{ $question->question }}</textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description">{{ $question->description }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('questions.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
