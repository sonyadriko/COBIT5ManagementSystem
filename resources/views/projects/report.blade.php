<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title', 'Report')</title>

    <!-- Fonts and Icons -->
    <link href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,800" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .table-container {
            margin-top: 30px;
        }

        h4,
        h5 {
            margin-top: 20px;
        }

        .no-print {
            margin-bottom: 20px;
        }

        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body class="bg-gray-100">
    <main class="container py-4">
        <div class="no-print text-end">
            <button class="btn btn-primary" onclick="window.print()">
                <i class="fas fa-print"></i> Print Report
            </button>
        </div>

        <h1>Audit Report</h1>
        <h3>Project ID: {{ $project->name }}</h3>

        <!-- Summary of Audit -->
        <div class="table-container">
            <h4>Summary</h4>
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Audit Process</th>
                        <th>Description</th>
                        <th>Level</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @foreach ($projectAudits as $audit)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $audit->processAudit->name ?? '-' }}</td>
                            <td>{{ $audit->processAudit->desc ?? '-' }}</td>
                            <td>{{ $audit->level }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="3"><strong>Overall Governance Level:</strong></td>
                        <td><strong>{{ round($capability_level) }}</strong></td>
                    </tr>

                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2">Keterangan: </td>
                        <td colspan="2">
                            @php
                                $descriptions = [
                                    0 => [
                                        'title' => 'Sangat Kurang',
                                        'details' => 'Proses tidak berjalan atau tidak mencapai tujuannya. Tidak ada bukti pelaksanaan proses yang efektif.'
                                    ],
                                    1 => [
                                        'title' => 'Kurang',
                                        'details' => 'Proses telah dilakukan tetapi tidak terkelola dengan baik. Tidak ada dokumentasi atau standarisasi yang jelas.'
                                    ],
                                    2 => [
                                        'title' => 'Cukup',
                                        'details' => 'Proses sudah mulai direncanakan, dikelola, dan dikendalikan. Dokumentasi dan pengukuran kinerja mulai diterapkan.'
                                    ],
                                    3 => [
                                        'title' => 'Baik',
                                        'details' => 'Proses telah distandarisasi dan diterapkan secara konsisten. Ada pendekatan formal dalam pengelolaan dan dokumentasi proses.'
                                    ],
                                    4 => [
                                        'title' => 'Sangat Baik',
                                        'details' => 'Proses sudah dapat diprediksi dengan baik dan memiliki kontrol yang kuat. Performa proses diukur dan dianalisis secara konsisten.'
                                    ],
                                    5 => [
                                        'title' => 'Sempurna',
                                        'details' => 'Proses terus-menerus diperbaiki melalui inovasi dan evaluasi berkelanjutan. Fokus pada efisiensi dan peningkatan kualitas secara terus-menerus.'
                                    ],
                                ];

                                $roundedLevel = round($capability_level);
                                $keterangan = $descriptions[$roundedLevel] ?? ['title' => '-', 'details' => '-'];
                            @endphp
                            <strong>{{ $keterangan['title'] }}</strong><br>
                            {{ $keterangan['details'] }}
                        </td>
                    </tr>
                </tfoot>

            </table>
        </div>

        <!-- Audit Details -->
        <div class="table-container">
            <h4>Audit Details</h4>
            @foreach ($auditDetails as $auditProcess => $details)
                <h5>Audit Process: {{ $auditProcess }}</h5>
                @foreach ($details->groupBy('level') as $level => $levelDetails)
                    <h6>Level: {{ $level }}</h6>
                    <table class="table table-bordered table-striped">
                        <thead class="table-secondary">
                            <tr>
                                <th>#</th>
                                <th>Question</th>
                                <th>Score</th>
                                <th>Document Evidence</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @foreach ($levelDetails as $detail)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $detail->question }}</td>
                                    <td>{{ $detail->score }}</td>
                                    <td>{{ $detail->document_evidence }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endforeach
            @endforeach
        </div>
    </main>

    <!-- Bootstrap Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
