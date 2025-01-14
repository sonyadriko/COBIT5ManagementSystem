@extends('layouts.app')

@section('breadcrumb', 'Users')
@section('page-title', 'Users')
@section('title', 'Users')

@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-6 mb-md-0 mb-4">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-lg-6 col-7">
                            <h6>Users</h6>
                        </div>
                        <div class="col-lg-6 col-5 my-auto text-end">
                            <a href="{{ route('users.create') }}" class="btn btn-primary">Add User</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="usersTable" class="table mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder">
                                        Name</th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder">
                                        Email</th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder">
                                        Role</th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $user->name }}</h6>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $user->email }}</h6>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $user->role }}</h6>
                                            </div>
                                        </td>
                                        <td class="text-sm d-flex justify-content-start">
                                            <a href="{{ route('users.edit', $user->id) }}"
                                                class="btn btn-sm btn-primary me-2">Edit</a>
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                class="d-inline delete-form">
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
            $('#usersTable').DataTable({
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
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.delete-form');

            deleteButtons.forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault(); // Prevent the form from submitting immediately

                    // Show confirmation alert
                    const confirmation = confirm("Are you sure you want to delete this audit?");

                    if (confirmation) {
                        // If user confirms, submit the form
                        form.submit();
                    }
                });
            });
        });
    </script>

@endsection
