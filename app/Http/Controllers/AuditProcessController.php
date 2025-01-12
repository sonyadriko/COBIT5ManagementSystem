<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProcessAudit;

class AuditProcessController extends Controller
{
    public function index()
    {
        $audit_process = ProcessAudit::all();
        return view('audit_process.index', compact('audit_process'));
    }
    public function create()
    {
        return view('audit_process.add');
    }
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'desc' => 'nullable|string',
        ]);

        // Simpan data ke database
        ProcessAudit::create([
            'name' => $validatedData['name'],
            'desc' => $validatedData['desc'] ?? null,
        ]);

        // Redirect ke halaman yang diinginkan dengan pesan sukses
        return redirect()->route('audit-process.index') // Ganti dengan route atau URL tujuan Anda
                         ->with('success', 'Process Audit created successfully!');
    }
}
