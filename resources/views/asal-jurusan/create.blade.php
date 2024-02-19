@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Tambah Data Jurusan SMA/SMK</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Validasi Tambah Data Jurusan SMA/SMK</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('asal-jurusan.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="asal_jurusan">Jurusan SMA/SMK</label>
                            <input type="text" class="form-control @error('asal_jurusan') is-invalid @enderror"
                                id="asal_jurusan" name="asal_jurusan" placeholder="Masukkan nama jurusan sma/smk..."
                                value="{{ old('asal_jurusan') }}">
                            @error('asal_jurusan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">Submit</button>
                            <a class="btn btn-secondary" href="{{ route('asal-jurusan.index') }}">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
    </section>
@endsection
