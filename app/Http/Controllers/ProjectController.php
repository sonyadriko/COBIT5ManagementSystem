<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ProjectAudit;
use App\Models\Question;
use App\Models\ProcessAudit;
use App\Models\AuditDetail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;


class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.add');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $project = new Project();
        $project->name = $request->name;
        $project->auditor = auth()->user()->name;
        $project->save();

        return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }

    public function audit($id_project)
    {
        $audits = ProjectAudit::with('processAudit') // Eager load relasi 'processAudit'
                          ->where('id_project', $id_project)
                          ->get();
        $project = Project::findOrFail($id_project);
        return view('projects.audit', compact('audits', 'project'));
    }

    public function createAudit($id_project)
    {
        // Mengambil data project yang sesuai dengan id_project
        $project = Project::findOrFail($id_project);
        $process_codes = ProcessAudit::whereNotIn('id_process_audit', function ($query) use ($id_project) {
            $query->select('id_audit_process')
                  ->from('project_audits')
                  ->where('id_project', $id_project);
        })->get();


        // Menampilkan form untuk menambah data audit
        return view('projects.add-audit', compact('project', 'process_codes'));
    }

    public function storeAudit(Request $request, $id_project)
    {
        // Validasi inputan
        $validated = $request->validate([
            'audit_process' => 'required|string|max:255',
        ]);

        // Membuat data audit baru
        ProjectAudit::create([
            'id_project' => $id_project,
            'id_audit_process' => $validated['audit_process'],
            'level' => 1,
        ]);

        // Redirect ke halaman audit
        return redirect()->route('projects.audit', $id_project)->with('success', 'Audit added successfully!');
    }


    public function deleteAudit($id_project, $id)
    {
        // Mencari data audit berdasarkan id
        $audit = ProjectAudit::where('id_project', $id_project)->findOrFail($id);

        // Menghapus data audit
        $audit->delete();

        // Redirect kembali ke halaman audit project dengan pesan sukses
        return redirect()->route('projects.audit', $id_project)->with('success', 'Audit deleted successfully!');
    }

    public function auditProject($id_project, $id)
    {
       // Fetch audit details based on id
        $audit = ProjectAudit::findOrFail($id);
        if (!$audit) {
            abort(404, 'Audit not found');
        }
        $auditProcess = ProcessAudit::findOrFail($audit->id_audit_process);
        if (!$auditProcess) {
            abort(404, 'Audit process not found');
        }
        $questions = Question::where('process_code', $audit->id_audit_process)
            ->where('level', $audit->level)  // Add condition to filter by level
            ->get();

        if ($questions->isEmpty()) {
            Log::info('No questions found for process_code: ' . $audit->id_audit_process . ' and level: ' . $audit->level);
        }
        $groupedQuestions = $questions->groupBy('pa');

        $idProject = $id_project;


        return view('projects.audit-detail', compact('audit', 'auditProcess', 'groupedQuestions', 'idProject'));
    }

    public function storeAuditDetail(Request $request, $id_project, $id)
    {
        $request->validate([
            'id_project_audit' => 'required|integer',
            'id_question' => 'required|array',
            'exist' => 'required|array',
            'document_evidence' => 'required|array',
        ]);

        $totalScore = 0;
        $totalQuestions = count($request->input('id_question'));
        $averageScore = 0;
        $category = '';

        // Log::info("Starting storeAuditDetail process for Project Audit ID: {$id}");

        // Looping untuk menyimpan data detail audit
        foreach ($request->input('id_question') as $index => $questionId) {
            $exist = $request->input('exist')[$questionId] ?? 0;
            $documentEvidence = $request->input('document_evidence')[$questionId] ?? '';

            $score = ($exist == 1) ? 100 : 0;
            $totalScore += $score;

            // Log for debugging
            // Log::info("Received question data", [
            //     'id_question' => $request->input('id_question'),
            //     'exist' => $request->input('exist'),
            //     'document_evidence' => $request->input('document_evidence'),
            // ]);

            AuditDetail::create([
                'id_project_audit' => $request->input('id_project_audit'),
                'id_question' => $questionId,
                'exist' => $exist,
                'document_evidence' => $documentEvidence,
            ]);
        }

        Log::info("Total score: {$totalScore}, Total questions: {$totalQuestions}");

        // Hitung nilai rata-rata
        if ($totalQuestions > 0) {
            $averageScore = $totalScore / $totalQuestions;
        }

        Log::info("Average score: {$averageScore}");

        // Tentukan kategori berdasarkan rata-rata
        if ($averageScore >= 86) {
            $category = 'F';
        } elseif ($averageScore >= 51) {
            $category = 'L';
        } elseif ($averageScore >= 16) {
            $category = 'P';
        } else {
            $category = 'N';
        }

        // Log::info("Determined category: {$category}");

        $audit = ProjectAudit::find($request->input('id_project_audit'));

        // Update level jika kategori adalah 'F'
        if ($category === 'F') {
            if ($audit->level < 5) {
                $audit->level += 1;
                $audit->save();

                // Simpan skor dan kategori ke session
                session()->flash('totalScore', $totalScore);
                session()->flash('averageScore', $averageScore);
                session()->flash('category', $category);

                Log::info("Audit level updated to: {$audit->level}");

                return response()->json([
                    'status' => 'success',
                    'message' => 'Audit updated successfully. Level increased.',
                    'redirect' => 'window.reload' // Tanda untuk reload halaman
                ], 200);
            } else {
                // Jika sudah di level maksimum
                Log::info("Audit already at maximum level (5). No level change.");
                $audit->status = "completed";
                $audit->save();
                return response()->json([
                    'status' => 'success',
                    'message' => 'Audit already at maximum level. No level change.',
                    'redirect' => route('projects.audit', $id_project), // Tetap reload halaman untuk memperbarui UI
                ], 200);
            }
        } elseif ($category === 'N') {
            // Kurangi level jika kategori N
            $audit->level = max(0, $audit->level - 1); // Pastikan level tidak negatif
            $audit->status = "completed";
            $audit->save();

            session()->flash('totalScore', $totalScore);
            session()->flash('averageScore', $averageScore);
            session()->flash('category', $category);

            Log::info("Audit level decreased to: {$audit->level}");

            return response()->json([
                'status' => 'success',
                'message' => 'Audit updated successfully. Level decreased.',
                'redirect' => route('projects.audit', $id_project), // Tanda untuk reload halaman
            ], 200);
        } elseif ($category === 'P') {
            // Kurangi level jika kategori N
            $audit->level = max(0, $audit->level - 1); // Pastikan level tidak negatif
            $audit->status = "completed";
            $audit->save();

            session()->flash('totalScore', $totalScore);
            session()->flash('averageScore', $averageScore);
            session()->flash('category', $category);

            // Log::info("Audit level decreased to: {$audit->level}");

            return response()->json([
                'status' => 'success',
                'message' => 'Audit updated successfully. Level decreased.',
                'redirect' => route('projects.audit', $id_project), // Tanda untuk reload halaman
            ], 200);
        }

        // Log::info("Audit saved without level update. Redirecting to projects.index");

        $audit->status = "completed";
        $audit->save();
        return response()->json([
            'status' => 'success',
            'message' => 'Audit updated successfully. Level increased.',
            'redirect' => route('projects.audit', $id_project),// Tanda untuk mengarah ke halaman projects.index
        ], 200);
    }

    public function showReport($id_project)
    {
        // Fetch data from ProjectAudit by id_project
        $projectAudits = ProjectAudit::where('id_project', $id_project)->get();
        $project = Project::where('id_project', $id_project)->first ();

        $auditDetails = DB::table('project_audits as pa')
        ->join('audit_details as ad', 'ad.id_project_audit', '=', 'pa.id_project_audit')
        ->join('questions as q', 'q.id_question', '=', 'ad.id_question')
        ->join('process_audits as ap', 'ap.id_process_audit', '=', 'q.process_code')
        ->select('ap.name as audit_process', 'q.question', 'ad.exist as score', 'ad.document_evidence', 'q.level', 'q.pa')
        ->where('pa.id_project', $id_project)
        ->orderBy('ap.name')
        ->get()
        ->groupBy('audit_process'); // Group by audit process

        // Initialize variables for calculations
        $total_fi_xi = 0; // Sum of frequency * level
        $total_items = 0; // Total number of items

        foreach ($projectAudits as $audit) {
            $frequency = $audit->frequency ?? 1; // Default frequency to 1 if not available
            $level = $audit->level ?? 0; // Default level to 0 if not available
            $total_fi_xi += $frequency * $level;
            $total_items++;
        }

        // Calculate capability level
        $capability_level = $total_items > 0 ? round($total_fi_xi / $total_items, 2) : 0;

        return view('projects.report', [
            'project' => $project,
            'projectAudits' => $projectAudits,
            'auditDetails' => $auditDetails,
            'capability_level' => $capability_level,
        ]);
    }



}
