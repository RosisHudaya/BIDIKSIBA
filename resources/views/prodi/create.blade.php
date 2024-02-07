@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Tambah Data Program Studi</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Validasi Tambah Data Program Studi</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('program-studi.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="jurusan">Jurusan</label>
                            <select class="form-control select2 @error('id_jurusan') is-invalid @enderror" name="id_jurusan"
                                data-id="select-jurusan" id="id_jurusan">
                                <option value="">-- Pilih jurusan --</option>
                                @foreach ($jurusans as $jurusan)
                                    <option value="{{ $jurusan->id }}"
                                        {{ old('id_jurusan') == $jurusan->id ? 'selected' : '' }}>
                                        {{ $jurusan->jurusan }}</option>
                                @endforeach
                            </select>
                            @error('id_jurusan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="prodi">Program Studi</label>
                            <input type="text" class="form-control @error('prodi') is-invalid @enderror" id="prodi"
                                name="prodi" placeholder="Masukkan nama program studi..." value="{{ old('prodi') }}">
                            @error('prodi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">Submit</button>
                            <a class="btn btn-secondary" href="{{ route('program-studi.index') }}">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
    </section>
@endsection

@push('customScript')
    <script src="/assets/js/select2.min.js"></script>
@endpush

@push('customStyle')
    <link rel="stylesheet" href="/assets/css/select2.min.css">
@endpush
