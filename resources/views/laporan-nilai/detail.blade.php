@extends('layouts.app')

@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-container">
            <h1><i class="fas fa-file-contract c-icon"></i> DAFTAR NILAI PERSERTA</h1>
            <hr>
            <table class="table table-bordered table-md">
                <tbody>
                    <tr>
                        <th style="width: 300px;">NAMA UJIAN</th>
                        <td>{{ $ujian->nama_ujian }}</td>
                    </tr>
                    <tr>
                        <th style="width: 300px;">SESI</th>
                        <td>{{ $ujian->nama_sesi }}</td>
                    </tr>
                    <tr>
                        <th style="width: 300px;">MULAI</th>
                        <td>{{ \Carbon\Carbon::parse($ujian->waktu_mulai)->format('d F Y H:i:s') }}</td>
                    </tr>
                    <tr>
                        <th style="width: 300px;">SELESAI</th>
                        <td>{{ \Carbon\Carbon::parse($ujian->waktu_akhir)->format('d F Y H:i:s') }}</td>
                    </tr>
                </tbody>
            </table>
            <div class="text-right">
                <a class="btn btn-secondary" href="{{ route('laporan-nilai.index') }}">Kembali</a>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="header ml-4 mt-3">
                            <a class="btn btn-success" href="{{ route('laporan-nilai.export', $ujian->id) }}">
                                <i class="fas fa-file-csv"></i> Export Nilai
                            </a>
                        </div>
                        <div class="card-body">
                            <form id="search" method="GET" action="">
                                <div class="d-flex mb-3">
                                    <input type="text" name="name" class="form-control mr-2" id="name"
                                        placeholder="cari nama peserta ujian..."
                                        value="{{ app('request')->input('name') }}">
                                    <button class="btn btn-primary mr-1 py-0 px-4" type="submit">Submit</button>
                                    <a class="btn btn-secondary py-2 px-4"
                                        href="{{ route('list-nilai.show', $ujian->id) }}">
                                        Reset
                                    </a>
                                </div>
                            </form>
                            <div class="table-responsive">
                                <table class="table table-bordered table-md">
                                    <tbody>
                                        <tr>
                                            <th class="text-center" style="width: 5%;">NO</th>
                                            <th style="width: 35%">NAMA</th>
                                            <th class="text-center" style="width: 15%;">NILAI</th>
                                            <th class="text-center" style="width: 20%;">STATUS</th>
                                        </tr>
                                        @foreach ($nilai_ujians as $key => $nilai_ujian)
                                            <tr>
                                                <td class="text-center font-weight-bold">
                                                    {{ ($nilai_ujians->currentPage() - 1) * $nilai_ujians->perPage() + $key + 1 }}
                                                </td>
                                                <td style="text-transform: uppercase;">{{ $nilai_ujian->nama }}</td>
                                                <td class="text-center">
                                                    {{ $nilai_ujian->nilai !== null ? $nilai_ujian->nilai : 0 }}
                                                </td>
                                                <td class="text-center">
                                                    @if ($nilai_ujian->status == 'sudah')
                                                        <span class="btn btn-success">SELESAI</span>
                                                    @else
                                                        <span class="btn btn-danger">BELUM</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center">
                                    {{ $nilai_ujians->withQueryString()->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('customScript')
@endpush

@push('customStyle')
    <script>
        function submitDel(id) {
            $('#del-' + id).submit()
        }
    </script>
@endpush
