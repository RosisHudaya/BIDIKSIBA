@extends('layouts.app')

@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-container">
            <h1><i class="fas fa-pen-square c-icon"></i> Detail Ujian</h1>
            <hr>
            <form action="{{ route('soalUjian', $ujian) }}">
                <table class="table table-bordered table-md">
                    <tbody>
                        <tr>
                            <th style="width: 300px;">Nama Ujian</th>
                            <td>{{ $ujian->nama_ujian }}</td>
                        </tr>
                        <tr>
                            <th style="width: 300px;">Jumlah Soal</th>
                            <td>{{ $jumlah_soal_ujian }} Soal</td>
                        </tr>
                        <tr>
                            <th style="width: 300px;">Deskripsi</th>
                            <td>{{ $ujian->deskripsi ?? '--' }}</td>
                        </tr>
                    </tbody>
                </table>
            </form>
            <div class="text-right">
                <a class="btn btn-secondary" href="{{ route('ujian.index') }}">Kembali</a>
            </div>
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
                        <div class="d-flex ml-4 mt-3 mr-2">
                            <div class=" col-md-4 m-0 p-0">
                                <a class="btn btn-primary" href="{{ route('soal-ujian.create', $ujian->id) }}">
                                    <i class="fas fa-edit"></i> Tambah Soal
                                </a>
                            </div>
                            <form class="col-md-8 d-flex justify-content-end"
                                action="{{ route('soal-ujian.import', $ujian->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <input class="form-input my-auto p-1 mx-1" type="file" name="import-file">
                                <div class="mx-0 my-auto p-0">
                                    <button class="btn btn-success">
                                        <i class="fas fa-file-csv"></i> Import
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <form id="search" method="GET" action="{{ route('ujian.index') }}">
                                <div class="d-flex mb-3">
                                    <input type="text" name="name" class="form-control mr-2" id="name"
                                        placeholder="cari nama ujian..." value="{{ app('request')->input('name') }}">
                                    <button class="btn btn-primary mr-1 py-0 px-4" type="submit">Submit</button>
                                    <a class="btn btn-secondary py-2 px-4" href="{{ route('ujian.index') }}">Reset</a>
                                </div>
                            </form>
                            <div class="table-responsive">
                                <table class="table table-bordered table-md">
                                    <tbody>
                                        <tr>
                                            <th class="text-center" style="width: 100px;">NO</th>
                                            <th>SOAL</th>
                                            <th class="text-center" style="width: 300px;">AKSI</th>
                                        </tr>
                                        @foreach ($soal_ujians as $key => $soal_ujian)
                                            <tr>
                                                <td class="text-center font-weight-bold">
                                                    {{ ($soal_ujians->currentPage() - 1) * $soal_ujians->perPage() + $key + 1 }}
                                                </td>
                                                <td>
                                                    <strong>{{ $soal_ujian->soal }}</strong>
                                                    <hr>
                                                    @if ($soal_ujian->jawaban_a == $soal_ujian->jawaban_benar)
                                                        <span class="font-weight-bold" style="color: #3eac57;">A.
                                                            {{ $soal_ujian->jawaban_a }}
                                                        </span>
                                                    @else
                                                        A. {{ $soal_ujian->jawaban_a }}
                                                    @endif
                                                    <br>
                                                    @if ($soal_ujian->jawaban_b == $soal_ujian->jawaban_benar)
                                                        <span class="font-weight-bold" style="color: #3eac57;">B.
                                                            {{ $soal_ujian->jawaban_b }}
                                                        </span>
                                                    @else
                                                        B. {{ $soal_ujian->jawaban_b }}
                                                    @endif
                                                    <br>
                                                    @if ($soal_ujian->jawaban_c == $soal_ujian->jawaban_benar)
                                                        <span class="font-weight-bold" style="color: #3eac57;">C.
                                                            {{ $soal_ujian->jawaban_c }}
                                                        </span>
                                                    @else
                                                        C. {{ $soal_ujian->jawaban_c }}
                                                    @endif
                                                    <br>
                                                    @if ($soal_ujian->jawaban_d == $soal_ujian->jawaban_benar)
                                                        <span class="font-weight-bold" style="color: #3eac57;">D.
                                                            {{ $soal_ujian->jawaban_d }}
                                                        </span>
                                                    @else
                                                        D. {{ $soal_ujian->jawaban_d }}
                                                    @endif
                                                    <br>
                                                </td>
                                                <td class="text-right">
                                                    <div class="d-flex justify-content-center">
                                                        <a href="{{ route('soal-ujian.edit', ['soalUjian' => $soal_ujian->id, 'ujian' => $ujian->id]) }}"
                                                            class="btn btn-sm btn-info btn-icon ml-2">
                                                            <i class="fas fa-edit"></i>
                                                            Edit
                                                        </a>
                                                        <form
                                                            action="{{ route('soal-ujian.destroy', ['soalUjian' => $soal_ujian->id, 'ujian' => $ujian->id]) }}"
                                                            method="POST" class="ml-2" id="del-<?= $soal_ujian->id ?>">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-sm btn-danger btn-icon"
                                                                data-confirm="Konfirmasi Hapus | Apakah Anda yakin ingin menghapus soal ujian ini?"
                                                                data-confirm-yes="submitDel(<?= $soal_ujian->id ?>)"
                                                                data-id="del-{{ $soal_ujian->id }}">
                                                                <i class="fas fa-times"></i> Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center">
                                    {{ $soal_ujians->withQueryString()->links() }}
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
