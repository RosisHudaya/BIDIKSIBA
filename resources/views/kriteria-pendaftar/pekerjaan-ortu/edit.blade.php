@extends('layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit Data Kriteria Pekerjaan Orang Tua</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <form action="{{ route('pekerjaan-ortu.update', $pekerjaanOrtu) }}" method="POST">
                    <div class="card-header">
                        <h4>Validasi Edit Data Kriteria Pekerjaan Orang Tua</h4>
                    </div>
                    <div class="card-body">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="">Pekerjaan Orang Tua</label>
                            <input type="text" class="form-control @error('pekerjaan_ortu') is-invalid @enderror"
                                name="pekerjaan_ortu" value="{{ $pekerjaanOrtu->pekerjaan_ortu }}">
                            @error('pekerjaan_ortu')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Nilai</label>
                            <input type="number" class="form-control @error('nilai') is-invalid @enderror" name="nilai"
                                value="{{ $pekerjaanOrtu->nilai }}">
                            @error('nilai')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary">Submit</button>
                        <a class="btn btn-secondary" href="{{ route('pekerjaan-ortu.index') }}">Cancel</a>
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
