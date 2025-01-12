@extends('layouts.app')

@section('breadcrumb', 'Questions')
@section('page-title', 'Questions')
@section('title', 'Questions')

@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-6 mb-md-0 mb-4">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-lg-6 col-7">
                            <h6>Questions</h6>
                        </div>
                        <div class="col-lg-6 col-5 my-auto text-end">
                            <a href="{{ route('questions.create') }}" class="btn btn-primary">Add Question</a>
                        </div>
                    </div>
                </div>
                <div class="card-body ">
                    <div class="table-responsive">
                        <table id="questionsTable" class="table mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder">
                                        Process Code</th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder">
                                        Level</th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder">
                                        PA</th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder">
                                        Question</th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder">
                                        Description</th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($questions as $question)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $question->process_name }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $question->level }}</h6>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $question->pa }}</h6>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $question->question }}</h6>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $question->description }}</h6>
                                            </div>
                                        </td>
                                        <td class="text-sm d-flex justify-content-start">
                                            <a href="{{ route('questions.edit', $question->id_question) }}"
                                                class="btn btn-sm btn-primary me-2">Edit</a>
                                            <form action="{{ route('questions.destroy', $question->id_question) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#questionsTable').DataTable({
                responsive: true,
                autoWidth: true,
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ entri",
                    info: "Menampilkan _START_ ke _END_ dari _TOTAL_ entri",
                    paginate: {
                        previous: "Sebelumnya",
                        next: "Berikutnya",
                    },
                },
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteForms = document.querySelectorAll('form[method="POST"]');

            deleteForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    if (!confirm('Are you sure you want to delete this question?')) {
                        e.preventDefault();
                    }
                });
            });
        });
    </script>


@endsection
