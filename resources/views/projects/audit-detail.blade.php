@extends('layouts.app')

@section('breadcrumb', 'Projects')
@section('page-title', 'Audit Detail')
@section('title', 'Audit Detail')

@section('content')
    <style>
        .custom-input {
            width: 80px;
            text-align: center;
        }
    </style>
    <div class="row">
        <div class="col-lg-12 col-md-6 mb-md-0 mb-4">
            <div class="card">
                <div class="card-body">
                    <h4>Process: <span class="bg-danger text-white p-1">{{ $auditProcess->name }} -
                            {{ $auditProcess->desc }}</span></h4>
                    <h4>Level: <span class="bg-primary text-white p-1">{{ $audit->level }}</span></h4><br>

                    <form id="auditForm" method="POST"
                        action="{{ route('projects.audit.detail.store', $audit->id_project_audit) }}">
                        @csrf
                        <input type="hidden" name="id_project_audit" value="{{ $audit->id_project_audit }}">
                        <table class="table table-bordered" border="3">
                            <thead>
                                <tr>
                                    <th class="text-center">Process Attribute</th>
                                    <th class="text-center">Question</th>
                                    <th class="text-center">Exist</th>
                                    <th class="text-center">Document Evidence</th>
                                    <th class="text-center">Total Score per PA</th>
                                    <th class="text-center">Category per PA</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($groupedQuestions as $pa => $questions)
                                    @php
                                        $rowCount = count($questions); // Hitung jumlah pertanyaan untuk PA ini
                                    @endphp
                                    @foreach ($questions as $index => $question)
                                        <tr>
                                            <!-- Apply rowspan untuk kolom Process Attribute -->
                                            @if ($index == 0)
                                                <td rowspan="{{ $rowCount }}" class="text-center">
                                                    {{ $pa }}</td>
                                            @endif
                                            <td>{{ $question->question }}</td>
                                            <td class="text-center">
                                                <input type="checkbox" name="exist[{{ $question->id_question }}]"
                                                    value="1" class="paCheckbox" data-pa="{{ $pa }}">
                                                <input type="hidden" name="id_question[]"
                                                    value="{{ $question->id_question }}">
                                            </td>
                                            <td>
                                                <textarea name="document_evidence[{{ $question->id_question }}]" rows="3"></textarea>
                                            </td>
                                            <!-- Kolom Total Score per PA -->
                                            @if ($index == 0)
                                                <td rowspan="{{ $rowCount }}" class="text-center">
                                                    <input type="text" class="paTotalScore custom-input form-control"
                                                        data-pa="{{ $pa }}" value="0" readonly>
                                                </td>
                                                <td rowspan="{{ $rowCount }}" class="text-center">
                                                    <input type="text" class="paCategory custom-input form-control"
                                                        data-pa="{{ $pa }}" value="N/A" readonly>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4" class="text-end"><strong>Total Score Utama:</strong></td>
                                    <td class="text-center">
                                        <input type="text" id="totalScoreMain" class="custom-input form-control"
                                            value="0" readonly>
                                    </td>
                                    <td class="text-center">
                                        <input type="text" id="categoryMain" class="custom-input form-control"
                                            value="N/A" readonly>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>

                        <!-- Input untuk Total Score Utama -->
                        {{-- <div class="mt-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="totalScoreMain"><strong>Total Score Utama:</strong></label>
                                        <input type="text" id="totalScoreMain" value="0" class="form-control"
                                            readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="categoryMain"><strong>Category Utama:</strong></label>
                                        <input type="text" id="categoryMain" value="N/A" class="form-control"
                                            readonly>
                                    </div>
                                </div>
                            </div> --}}


                        {{-- <!-- Input untuk Total Score Utama -->
                            <div>
                                <label for="totalScoreMain">Total Score Utama:</label>
                                <input type="text" id="totalScoreMain" value="0" readonly>
                            </div> --}}


                        {{-- <input type="text" id="totalScore" name="total_score" value="0" readonly disabled>
                            <input type="text" id="totalQuestions" value="{{ count($questions) }}" readonly>
                            <input type="text" id="averageScore" value="0" readonly disabled>
                            <input type="text" id="category" value="0" readonly disabled> --}}
                        <div class="d-flex justify-content-end mt-3">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- </div> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            function calculateScores() {
                let totalScoreMain = 0; // Total skor untuk seluruh PA
                let totalQuestionsMain = 0; // Total jumlah pertanyaan
                let paScores = {}; // Menyimpan skor total per PA
                let paQuestionCounts = {}; // Menyimpan jumlah pertanyaan per PA

                // Inisialisasi skor dan jumlah pertanyaan untuk setiap PA
                $('.paTotalScore').each(function() {
                    let pa = $(this).data('pa');
                    paScores[pa] = 0;
                    paQuestionCounts[pa] = 0;
                });

                // Hitung skor total dan jumlah pertanyaan per PA
                $('.paCheckbox').each(function() {
                    let pa = $(this).data('pa');
                    paQuestionCounts[pa]++; // Tambah jumlah pertanyaan PA ini
                    if ($(this).is(':checked')) {
                        paScores[pa] += 100; // Tambah skor 100 jika checkbox dicentang
                    }
                });

                // Update Total Score per PA dan kategori per PA
                $('.paTotalScore').each(function() {
                    let pa = $(this).data('pa');
                    let totalScorePerPA = paScores[pa];
                    let questionCountPerPA = paQuestionCounts[pa];
                    let averageScorePerPA = questionCountPerPA > 0 ? (totalScorePerPA /
                        questionCountPerPA) : 0;

                    // Update Total Score per PA
                    $(this).val(averageScorePerPA.toFixed(2));

                    // Tentukan kategori berdasarkan rata-rata skor
                    let category = getCategory(averageScorePerPA);
                    $(`.paCategory[data-pa="${pa}"]`).val(category);

                    // Tambahkan skor dan jumlah pertanyaan PA ini ke total utama
                    totalScoreMain += totalScorePerPA;
                    totalQuestionsMain += questionCountPerPA;
                });

                // Hitung skor rata-rata utama
                let averageScoreMain = totalQuestionsMain > 0 ? (totalScoreMain / totalQuestionsMain) : 0;

                // Update total skor utama
                $('#totalScoreMain').val(averageScoreMain.toFixed(2));

                // Tentukan kategori utama berdasarkan rata-rata skor utama
                let mainCategory = getCategory(averageScoreMain);
                $('#categoryMain').val(mainCategory);
            }

            // Fungsi untuk mendapatkan kategori
            function getCategory(score) {
                if (score >= 86) {
                    return 'F'; // Fully Achieved
                } else if (score >= 51) {
                    return 'L'; // Largely Achieved
                } else if (score >= 16) {
                    return 'P'; // Partially Achieved
                } else {
                    return 'N'; // Not Achieved
                }
            }

            // Panggil fungsi calculateScores saat checkbox diubah
            $('input[type="checkbox"]').on('change', function() {
                calculateScores();
            });

            // Pastikan nilai awal terhitung saat halaman dimuat
            calculateScores();

            // Handle form submit
            $('#auditForm').on('submit', function(e) {
                e.preventDefault();
                let data = $(this).serialize();

                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: data,
                    success: function(response) {
                        if (response.status === 'success') {
                            alert('Audit successfully updated!');
                            localStorage.clear(); // Clear localStorage
                            $('#auditForm').find('input[type=checkbox]').prop('checked', false);
                            // Periksa apakah perlu reload atau redirect
                            if (response.redirect === 'reload') {
                                location.reload(); // Reload halaman jika kategori adalah 'F'
                            } else if (response.redirect === 'projects.index') {
                                window.location.href =
                                    '{{ route('projects.index') }}'; // Arahkan ke projects.index
                            }
                        } else {
                            alert('Error: ' + response.message);
                        }
                    },
                    error: function() {
                        alert('An error occurred while submitting the form.');
                    }
                });
            });
        });
    </script>
@endsection
