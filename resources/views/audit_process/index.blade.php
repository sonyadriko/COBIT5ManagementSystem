@extends('layouts.app')

@section('breadcrumb', 'Audit Process')
@section('page-title', 'Audit Process')
@section('title', 'Audit Process')

@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-6 mb-md-0 mb-4">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-lg-6 col-7">
                            <h6>Audit Process</h6>
                        </div>
                        <div class="col-lg-6 col-5 my-auto text-end">
                            <a href="{{ route('audit-process.create') }}" class="btn btn-primary">Add Audit Process</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="questionsTable" class="table mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder">
                                        Name</th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder">
                                        Desc</th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($audit_process as $audit)
                                    <tr>
                                        <td>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $audit->name }}</h6>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $audit->desc }}</h6>
                                            </div>
                                        </td>
                                        <td class="text-sm d-flex justify-content-start">
                                            <a href="{{ route('audit-process.edit', $audit->id_process_audit) }}"
                                                class="btn btn-sm btn-primary me-2">Edit</a>
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

@endsection
