@extends('layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit Data Ujian</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <form action="{{ route('soal-ujian.update', $soal_ujian) }}" method="POST">
                    <div class="card-header">
                        <h4>Validasi Edit Data Ujian</h4>
                    </div>
                    <div class="card-body">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="nama_ujian">Jurusan SMA/SMK</label>
                            <input type="text" class="form-control @error('nama_ujian') is-invalid @enderror"
                                id="nama_ujian" name="nama_ujian" value="{{ $soal_ujian->nama_ujian }}">
                            @error('nama_ujian')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea class="form-control" name="deskripsi" id="deskripsi" style="height: 150px;">{{ $soal_ujian->deskripsi ?? '--' }}</textarea>
                        </div>
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
