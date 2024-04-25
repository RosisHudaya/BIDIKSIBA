@extends('layouts.app')
@section('content')
    <section class="section">
        <div class="section-header d-block">
            <div class="d-flex col-md-12">
                <h1 class="col-md-6 m-0 p-0">Dashboard</h1>
                <div class="col-md-6 text-right m-0 p-0">
                    <a class="btn btn-danger import" style="color: white">
                        <i class="fas fa-file-pdf"></i>
                    </a>
                    <a class="btn btn-primary calender" style="color: white">
                        <i class="fas fa-calendar-plus"></i>
                    </a>
                </div>
            </div>
            <div class="show-import"
                @if ($errors->has('foto') || $errors->has('file')) style="display: block;" @else style="display: none;" @endif>
                <hr>
                <form action="{{ route('upload.file') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="form-group mb-0 pb-0">
                        <p class="p-0 m-0 text-success">* Ekstensi file PDF (wajib diisi)</p>
                        <input type="file" class="form-control @error('file') is-invalid @enderror" id="file"
                            name="file">
                        @error('file')
                            <div class="invalid-feedback feed ml-3">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group my-0 py-0">
                        <p class="p-0 m-0 text-success">
                            * Ekstensi foto .png, .jpg, .jpeg (opsional)
                        </p>
                        <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto"
                            name="foto">
                        @error('foto')
                            <div class="invalid-feedback feed ml-3">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group my-1 py-1">
                        <input type="text" class="form-control @error('judul') is-invalid @enderror"
                            placeholder="masukkan judul berkas..." id="judul" name="judul"
                            value="{{ old('judul') }}">
                        @error('judul')
                            <div class="invalid-feedback feed ml-3">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <textarea class="form-control summernote" name="deskripsi" id="deskripsi">{{ old('deskripsi') }}</textarea>
                    </div>
                    <button class="btn btn-block btn-primary"><i class="fas fa-paper-plane"></i> Upload</button>
                </form>
                <hr>
            </div>
            <div class="show-calender" style="display: none;">
                <hr>
                <form action="{{ route('jadwal') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">Pendaftaran Dibuka</label>
                        <input type="datetime-local" class="form-control" name="start" id="start"
                            value="{{ $jadwal ? $jadwal->start : '' }}">
                    </div>
                    <div class="form-group">
                        <label for="">Pendaftaran Ditutup</label>
                        <input type="datetime-local" class="form-control" name="end" id="end"
                            value="{{ $jadwal ? $jadwal->end : '' }}">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-block btn-primary"><i class="fas fa-save"></i> Simpan</button>
                    </div>
                </form>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card card-statistic-1 p-2">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <div class="card-warp py-3">
                        <p class="text-uppercase card-title p-0 m-0 font-weight-bold">peserta terdaftar</p>
                        <p class="card-text p-0 m-0">{{ $totalCalonMahasiswa }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-statistic-1 p-2">
                    <div class="card-icon bg-success">
                        <i class="fas fa-user-check"></i>
                    </div>
                    <div class="card-warp py-3">
                        <p class="text-uppercase card-title p-0 m-0 font-weight-bold">peserta terverifikasi</p>
                        <p class="card-text p-0 m-0">{{ $verifUser->peserta_verif }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-statistic-1 p-2">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-user-cog"></i>
                    </div>
                    <div class="card-warp py-3">
                        <p class="text-uppercase card-title p-0 m-0 font-weight-bold">admin bidiksiba</p>
                        <p class="card-text p-0 m-0">{{ $totalAdminBidiksiba }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex">
            <div class="col-md-6 pb-3">
                <h2 class="section-title">List Informasi</h2>
                <div class="list-info">
                    @foreach ($files as $key => $file)
                        <div class="bg-informasi mb-2">
                            <div class="d-flex col-md-12 p-2">
                                <div class="d-flex col-md-10">
                                    <i class="fas fa-file-pdf icon-info mr-4"></i>
                                    <div class="my-auto">
                                        <a href="{{ asset('storage/' . $file->file) }}"
                                            class="a-prev text-justify">{{ $file->judul }}
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-2 text-right">
                                    <form action="{{ route('delete-file', $file->id) }}" method="POST"
                                        id="del-<?= $file->id ?>">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger"
                                            data-confirm="Konfirmasi Hapus | Apakah anda yakin menghapus file ini?"
                                            data-confirm-yes="submitDel(<?= $file->id ?>)"
                                            data-id="del-{{ $file->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-6 pb-4">
                <h2 class="section-title">Jadwal Pendaftaran</h2>
                <div class="bg-start">
                    <div class="d-flex py-3">
                        <p class="i-date my-auto mx-3">{{ $d_start ? $d_start : '00' }}</p>
                        <div class="my-2">
                            <p class="p-start">{{ $mY_start ? $mY_start : '-- 0000' }}</p>
                            <hr class="bg-white">
                            <p class="p-date">{{ $t_start ? $t_start : '00:00:00' }}</p>
                        </div>
                    </div>
                </div>
                <br>
                <div class="bg-end">
                    <div class="d-flex py-3">
                        <p class="i-date my-auto mx-3">{{ $d_end ? $d_end : '00' }}</p>
                        <div class="my-2">
                            <p class="p-start">{{ $mY_end ? $mY_end : '-- 0000' }}</p>
                            <hr class="bg-white">
                            <p class="p-date">{{ $t_end ? $t_end : '00:00:00' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('customStyle')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endpush

@push('customScript')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>
    <script>
        function submitDel(id) {
            $('#del-' + id).submit()
        }
    </script>
    <script>
        $(document).ready(function() {
            $('.import').click(function(event) {
                event.stopPropagation();
                $(".show-import").slideToggle("fast");
            });
        })
        $(document).ready(function() {
            $('.calender').click(function(event) {
                event.stopPropagation();
                $(".show-calender").slideToggle("fast");
            });
        })
    </script>
    <script>
        $(".summernote").summernote({
            styleWithSpan: false,
            height: 200,
            placeholder: 'masukkan deskripsi disini(opsional)...',
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
            ],
        });
    </script>
@endpush
