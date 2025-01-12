@extends('layouts.app')

@section('breadcrumb', 'Projects')
@section('page-title', 'Add Data Audit')
@section('title', 'Add Data Audit')
@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-6 mb-md-0 mb-4">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-lg-6 col-7">
                            <h6>Add Data Audit</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <!-- Form untuk menambah data audit, dengan route dan method yang benar -->
                    <form method="POST" action="{{ route('projects.audit.store', $project->id_project) }}">
                        @csrf
                        <input type="hidden" name="id_project" value="{{ $project->id_project }}">

                        <div class="mb-3">
                            <label for="audit_process" class="form-label">Audit Process</label>
                            <select class="form-select" id="audit_process" name="audit_process" required>
                                <option value="" disabled selected>Pilih Audit Process</option>
                                <!-- Gantilah kode PHP di sini dengan data yang dinamis dari Laravel -->
                                @foreach ($process_codes as $process)
                                    <option value="{{ $process->id_process_audit }}">{{ $process->name }} -
                                        {{ $process->desc }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('projects.audit', $project->id_project) }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
