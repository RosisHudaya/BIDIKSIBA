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
                            <label for="id_asal_jurusan">Jurusan SMA/SMK</label>
                            <select name="id_asal_jurusan[]"
                                class="form-control select2 @error('id_asal_jurusan') is-invalid @enderror" multiple>
                                <option value="" disabled selected>Pilih jurusan SMA/SMK</option>
                                @foreach ($asal_jurusans as $asal_jurusan)
                                    <option
                                        value="{{ $asal_jurusan->id }}"{{ in_array($asal_jurusan->id, old('id_asal_jurusan', [])) ? 'selected' : '' }}>
                                        {{ $asal_jurusan->asal_jurusan }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_asal_jurusan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
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
