@extends('layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit Data Kriteria Penghasilan Orang Tua</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <form action="{{ route('penghasilan-ortu.update', $penghasilanOrtu) }}" method="POST">
                    <div class="card-header">
                        <h4>Validasi Edit Data Kriteria Penghasilan Orang Tua</h4>
                    </div>
                    <div class="card-body">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="">Penghasilan Orang Tua</label>
                            <input type="text" class="form-control @error('gaji_ortu') is-invalid @enderror"
                                name="gaji_ortu" value="{{ $penghasilanOrtu->gaji_ortu }}">
                            @error('gaji_ortu')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Nilai</label>
                            <input type="number" class="form-control @error('nilai') is-invalid @enderror" name="nilai"
                                value="{{ $penghasilanOrtu->nilai }}">
                            @error('nilai')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary">Submit</button>
                        <a class="btn btn-secondary" href="{{ route('penghasilan-ortu.index') }}">Cancel</a>
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
