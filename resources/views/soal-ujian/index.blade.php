@extends('layouts.app')

@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-container">
            <h1><i class="fas fa-pen-square c-icon"></i> UJIAN</h1>
            <hr>
            <table class="table table-bordered table-md">
                <tbody>
                    <tr>
                        <th class="th-test" style="width: 300px;">NAMA UJIAN</th>
                        <td>{{ $ujian->nama_ujian }}</td>
                    </tr>
                    <tr>
                        <th class="th-test" style="width: 300px;">JUMLAH</th>
                        <td>{{ $jumlah_soal_ujian }} Soal</td>
                    </tr>
                    <tr>
                        <th class="th-test" style="width: 300px;">DESKRIPSI</th>
                        <td>{!! $ujian->deskripsi ?? '--' !!}</td>
                    </tr>
                </tbody>
            </table>
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
                        <div class="d-flex ml-4 mt-3 mr-2 d-test">
                            @role('super-admin')
                                <a class="btn btn-primary mr-1" href="{{ route('soal-ujian.create', $ujian->id) }}">
                                    <i class="fas fa-edit"></i> Tambah Soal
                                </a>
                                <a class="btn btn-success import mr-1" style="color: white">
                                    <i class="fas fa-file-csv"></i> Import Soal
                                </a>
                                <form action="{{ route('soal-ujian.destroyAll', ['ujian' => $ujian->id]) }}" method="POST"
                                    id="delAll-<?= $ujian->id ?>">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-del-all"
                                        data-confirm="Konfirmasi Hapus | Apakah Anda yakin menghapus semua soal yang ada?"
                                        data-confirm-yes="submitDelAll(<?= $ujian->id ?>)" data-id="delAll-{{ $ujian->id }}">
                                        <i class="fas fa-trash"></i> Semua Soal
                                    </button>
                                </form>
                            @endrole
                        </div>
                        <div class="card-body">
                            <div class="show-import"
                                @if ($errors->has('import-file')) style="display: block;" @else style="display: none;" @endif>
                                Unduh template <a href="{{ asset('assets/format-file/template-soal.xlsx') }}"
                                    download>disini</a>
                                <p class="m-0 p-0 text-c">
                                    * Eksenti (.xlxc, .csv, atau .xls) | Ukuran file maksimal 10 MB
                                </p>
                                <form action="{{ route('soal-ujian.import', $ujian->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('POST')
                                    <div class="custom-file">
                                        <div class="d-flex m-0 p-0">
                                            <div class="col-md-11 m-0 p-0">
                                                <label
                                                    class="custom-file-label @error('import-file', 'ImportSoalUjianRequest') is-invalid @enderror"
                                                    for="file-upload">Pilih File
                                                </label>
                                                <input type="file" id="file-upload" class="custom-file-input"
                                                    name="import-file" data-id="send-import">
                                            </div>
                                            <div class="col-md-1 p-0 ml-2">
                                                <button class="btn btn-primary px-3 py-2"
                                                    data-id="submit-import">Import</button>
                                            </div>
                                        </div>
                                    </div>
                                    <br />
                                    @error('import-file')
                                        <div class="invalid-feedback d-flex" role="alert">
                                            <div class="alert_alert-dange_mt-1_mb-1 mt-1 ml-1">
                                                {{ $message }}
                                            </div>
                                        </div>
                                    @enderror
                                    <hr>
                                    <br>
                                </form>
                            </div>
                            <form id="search" method="GET" action="{{ route('soalUjian', $ujian->id) }}">
                                <div class="d-flex mb-3 d-search">
                                    <input type="text" name="name" class="form-control mr-2 d-input" id="name"
                                        placeholder="cari soal..." value="{{ app('request')->input('name') }}">
                                    <button class="btn btn-primary mr-1 py-0 px-4 d-submit" type="submit">Submit</button>
                                    <a class="btn btn-secondary py-2 px-4" href="{{ route('soalUjian', $ujian->id) }}">
                                        Reset
                                    </a>
                                </div>
                            </form>

                            @php
                                function isImageUrl($url)
                                {
                                    return strpos($url, 'thumbnail?id=') !== false;
                                }
                            @endphp

                            <div class="table-responsive">
                                <table class="table table-bordered table-md">
                                    <tbody>
                                        <tr>
                                            <th class="text-center" style="width: 100px;">NO</th>
                                            <th>SOAL</th>
                                            @role('super-admin')
                                                <th class="text-center" style="width: 300px;">AKSI</th>
                                            @endrole
                                        </tr>
                                        @foreach ($soal_ujians as $key => $soal_ujian)
                                            <tr>
                                                <td class="text-center font-weight-bold">
                                                    {{ ($soal_ujians->currentPage() - 1) * $soal_ujians->perPage() + $key + 1 }}
                                                </td>
                                                <td>
                                                    @if ($soal_ujian->gambar)
                                                        <img src="{{ $soal_ujian->gambar }}" alt="gambar-soal"
                                                            style="width: 200px; height: 200px; object-fit: contain;"><br>
                                                    @endif
                                                    <strong>{{ $soal_ujian->soal }}</strong>
                                                    <hr>
                                                    @if ($soal_ujian->jawaban_benar == 'A')
                                                        @if (isImageUrl($soal_ujian->jawaban_a))
                                                            <span class="font-weight-bold" style="color: #3eac57;">A.</span>
                                                            <img class="mb-2" src="{{ $soal_ujian->jawaban_a }}"
                                                                alt="Jawaban A"
                                                                style="max-width: 200px; max-height: 200px; object-fit: contain;">
                                                        @else
                                                            <span class="font-weight-bold" style="color: #3eac57;">A.
                                                                {{ $soal_ujian->jawaban_a }}</span>
                                                        @endif
                                                    @else
                                                        @if (isImageUrl($soal_ujian->jawaban_a))
                                                            A. <img class="mb-2" src="{{ $soal_ujian->jawaban_a }}"
                                                                alt="Jawaban A"
                                                                style="max-width: 200px; max-height: 200px; object-fit: contain;">
                                                        @else
                                                            A. {{ $soal_ujian->jawaban_a }}
                                                        @endif
                                                    @endif
                                                    <br>
                                                    @if ($soal_ujian->jawaban_benar == 'B')
                                                        @if (isImageUrl($soal_ujian->jawaban_b))
                                                            <span class="font-weight-bold" style="color: #3eac57;">B.</span>
                                                            <img class="mb-2" src="{{ $soal_ujian->jawaban_b }}"
                                                                alt="Jawaban B"
                                                                style="max-width: 200px; max-height: 200px; object-fit: contain;">
                                                        @else
                                                            <span class="font-weight-bold" style="color: #3eac57;">B.
                                                                {{ $soal_ujian->jawaban_b }}</span>
                                                        @endif
                                                    @else
                                                        @if (isImageUrl($soal_ujian->jawaban_b))
                                                            B. <img class="mb-2" src="{{ $soal_ujian->jawaban_b }}"
                                                                alt="Jawaban B"
                                                                style="max-width: 200px; max-height: 200px; object-fit: contain;">
                                                        @else
                                                            B. {{ $soal_ujian->jawaban_b }}
                                                        @endif
                                                    @endif
                                                    <br>
                                                    @if ($soal_ujian->jawaban_benar == 'C')
                                                        @if (isImageUrl($soal_ujian->jawaban_c))
                                                            <span class="font-weight-bold"
                                                                style="color: #3eac57;">C.</span>
                                                            <img class="mb-2" src="{{ $soal_ujian->jawaban_b }}"
                                                                alt="Jawaban C"
                                                                style="max-width: 200px; max-height: 200px; object-fit: contain;">
                                                        @else
                                                            <span class="font-weight-bold" style="color: #3eac57;">C.
                                                                {{ $soal_ujian->jawaban_c }}</span>
                                                        @endif
                                                    @else
                                                        @if (isImageUrl($soal_ujian->jawaban_c))
                                                            C. <img class="mb-2" src="{{ $soal_ujian->jawaban_c }}"
                                                                alt="Jawaban B"
                                                                style="max-width: 200px; max-height: 200px; object-fit: contain;">
                                                        @else
                                                            C. {{ $soal_ujian->jawaban_c }}
                                                        @endif
                                                    @endif
                                                    <br>
                                                    @if ($soal_ujian->jawaban_benar == 'D')
                                                        @if (isImageUrl($soal_ujian->jawaban_d))
                                                            <span class="font-weight-bold"
                                                                style="color: #3eac57;">D.</span>
                                                            <img class="mb-2" src="{{ $soal_ujian->jawaban_d }}"
                                                                alt="Jawaban D"
                                                                style="max-width: 200px; max-height: 200px; object-fit: contain;">
                                                        @else
                                                            <span class="font-weight-bold" style="color: #3eac57;">D.
                                                                {{ $soal_ujian->jawaban_d }}</span>
                                                        @endif
                                                    @else
                                                        @if (isImageUrl($soal_ujian->jawaban_d))
                                                            D. <img class="mb-2" src="{{ $soal_ujian->jawaban_d }}"
                                                                alt="Jawaban D"
                                                                style="max-width: 200px; max-height: 200px; object-fit: contain;">
                                                        @else
                                                            D. {{ $soal_ujian->jawaban_d }}
                                                        @endif
                                                    @endif
                                                    <br>
                                                </td>
                                                @role('super-admin')
                                                    <td class="text-right">
                                                        <div class="d-flex justify-content-center">
                                                            <a href="{{ route('soal-ujian.edit', ['soalUjian' => $soal_ujian->id, 'ujian' => $ujian->id]) }}"
                                                                class="btn btn-sm btn-info btn-icon ml-2">
                                                                <i class="fas fa-edit i-all"></i>
                                                                Edit
                                                            </a>
                                                            <form
                                                                action="{{ route('soal-ujian.destroy', ['soalUjian' => $soal_ujian->id, 'ujian' => $ujian->id]) }}"
                                                                method="POST" class="ml-2"
                                                                id="del-<?= $soal_ujian->id ?>">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-sm btn-danger btn-icon"
                                                                    data-confirm="Konfirmasi Hapus | Apakah Anda yakin ingin menghapus soal ujian ini?"
                                                                    data-confirm-yes="submitDel(<?= $soal_ujian->id ?>)"
                                                                    data-id="del-{{ $soal_ujian->id }}">
                                                                    <i class="fas fa-times i-all"></i> Delete
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                @endrole
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-center d-pag">
                                {{ $soal_ujians->withQueryString()->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('customScript')
    <script>
        $(document).ready(function() {
            $('.import').click(function(event) {
                event.stopPropagation();
                $(".show-import").slideToggle("fast");
            });
            $('#file-upload').change(function() {
                var i = $(this).prev('label').clone();
                var file = $('#file-upload')[0].files[0].name;
                $(this).prev('label').text(file);
            });
        })
    </script>
    <script src="/assets/js/pagination.js"></script>
@endpush

@push('customStyle')
    <script>
        function submitDel(id) {
            $('#del-' + id).submit()
        }
    </script>
    <script>
        function submitDelAll(id) {
            $('#delAll-' + id).submit()
        }
    </script>
@endpush
