<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\ProcessAudit;
use Illuminate\Support\Facades\DB;
class QuestionController extends Controller
{
    //
    public function index()
    {
        $questions = DB::table('questions as q')
            ->join('process_audits as pa', 'q.process_code', '=', 'pa.id_process_audit')
            ->select('q.*', 'pa.name as process_name') // Ambil kolom yang dibutuhkan
            ->get();

        return view('questions.index', compact('questions'));
    }
    public function create()
    {
        $processAudits = ProcessAudit::all(); // Ambil semua data ProcessAudit
        return view('questions.create', compact('processAudits'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'process_code' => 'required|exists:process_audits,id_process_audit',
            'level' => 'required|integer',
            'pa' => 'required|string|max:255',
            'question' => 'required|string|max:1000',
            'description' => 'nullable|string|max:2000',
        ]);

        Question::create([
            'process_code' => $request->process_code,
            'level' => $request->level,
            'pa' => $request->pa,
            'question' => $request->question,
            'description' => $request->description,
        ]);

        return redirect()->route('questions.index')->with('success', 'Question added successfully.');
    }

    public function edit($id)
    {
        $question = Question::findOrFail($id);
        $processAudits = ProcessAudit::all(); // Ambil semua data ProcessAudit
        return view('questions.edit', compact('question', 'processAudits'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'process_code' => 'required',
            'level' => 'required',
            'pa' => 'required',
            'question' => 'required',
            'description' => 'nullable',
        ]);

        $question = Question::findOrFail($id);
        $question->update($request->all());

        return redirect()->route('questions.index')->with('success', 'Question updated successfully.');
    }

    public function destroy($id)
    {
        $question = Question::findOrFail($id);
        $question->delete();

        return redirect()->route('questions.index')->with('success', 'Question deleted successfully.');
    }


}
