@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Tambah Data Jurusan</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Validasi Tambah Data Jurusan</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('jurusan.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="jurusan">Jurusan</label>
                            <input type="text" class="form-control @error('jurusan') is-invalid @enderror" id="jurusan"
                                name="jurusan" placeholder="Masukkan nama jurusan...">
                            @error('jurusan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">Submit</button>
                            <a class="btn btn-secondary" href="{{ route('jurusan.index') }}">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
    </section>
@endsection
