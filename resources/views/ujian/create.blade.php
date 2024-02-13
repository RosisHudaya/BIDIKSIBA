@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Tambah Ujian</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Validasi Tambah Data Ujian</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('soal-ujian.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="nama_ujian">Nama Ujian</label>
                            <input type="text" class="form-control @error('nama_ujian') is-invalid @enderror"
                                id="nama_ujian" name="nama_ujian" placeholder="Masukkan nama ujian...">
                            @error('nama_ujian')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea class="form-control" name="deskripsi" id="deskripsi" style="height: 150px;"
                                placeholder="Masukkan deskripsi ujian..."></textarea>
                            <p class="text-c">* Tambahkan deskripsi ujian(opsional)</p>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">Submit</button>
                            <a class="btn btn-secondary" href="{{ route('soal-ujian.index') }}">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
    </section>
@endsection

@push('customStyle')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
@endpush

@push('customScript')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endpush
