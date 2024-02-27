@extends('layouts.app')

@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>List</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    @include('layouts.alert')
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="header ml-4 mt-3">
                            <a class="btn btn-success" href="{{ route('laporan-nilai.export', request()->all()) }}">
                                <i class="fas fa-file-csv"></i> Export Nilai
                            </a>
                        </div>
                        <div class="card-body">
                            <form id="search" method="GET" action="{{ route('laporan-nilai.index') }}">
                                <div class="d-flex mb-3">
                                    <select class="form-control select2" name="sesi" id="sesi">
                                        <option value="" disabled selected>filter sesi ujian...</option>
                                        @foreach ($sesiUjians as $sesiUjian)
                                            <option value="{{ $sesiUjian->id }}"
                                                @if ($sesiUjian->id == $sesiSelected) selected @endif>
                                                {{ $sesiUjian->nama_sesi }}</option>
                                        @endforeach
                                    </select>
                                    <input type="text" name="name" class="form-control mx-2" id="name"
                                        placeholder="cari nama peserta..." value="{{ app('request')->input('name') }}">
                                    <select class="form-control select2" name="ujian" id="ujian">
                                        <option value="" disabled selected>filter nama ujian...</option>
                                        @foreach ($ujians as $ujian)
                                            <option value="{{ $ujian->id }}"
                                                @if ($ujian->id == $ujianSelected) selected @endif>{{ $ujian->nama_ujian }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <button class="btn btn-primary mr-1 ml-2 py-0 px-4" type="submit">Submit</button>
                                    <a class="btn btn-secondary py-2 px-4" href="{{ route('laporan-nilai.index') }}">
                                        Reset
                                    </a>
                                </div>
                            </form>
                            <div class="table-responsive">
                                <table class="table table-bordered table-md">
                                    <tbody>
                                        <tr>
                                            <th class="text-center" style="width: 50px;">#</th>
                                            <th class="text-center" style="width: 150px;">Sesi</th>
                                            <th style="width: 320px;">Nama</th>
                                            <th class="text-center" style="width: 270px;">Ujian</th>
                                            <th class="text-center" style="width: 70px;">Nilai</th>
                                        </tr>
                                        @foreach ($nilais as $key => $nilai)
                                            <tr>
                                                <td class="text-center">
                                                    {{ ($nilais->currentPage() - 1) * $nilais->perPage() + $key + 1 }}
                                                </td>
                                                <td class="text-center">{{ $nilai->nama_sesi }}</td>
                                                <td style="text-transform: uppercase;">{{ $nilai->nama }}</td>
                                                <td class="text-center">{{ $nilai->nama_ujian }}</td>
                                                <td class="text-right font-weight-bold">
                                                    {{ $nilai->nilai }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center">
                                    {{ $nilais->withQueryString()->links() }}
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endpush

@push('customStyle')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
@endpush
