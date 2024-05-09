@extends('layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit Data Kriteria Kepemilikan Kamar Mandi</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <form action="{{ route('kamar-mandi.update', $kamarMandi) }}" method="POST">
                    <div class="card-header">
                        <h4>Validasi Edit Kriteria Data Kepemilikan Kamar Mandi</h4>
                    </div>
                    <div class="card-body">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="">Kepemilikan Kamar Mandi</label>
                            <input type="text" class="form-control @error('kamar_mandi') is-invalid @enderror"
                                name="kamar_mandi" value="{{ $kamarMandi->kamar_mandi }}">
                            @error('kamar_mandi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Nilai</label>
                            <input type="number" class="form-control @error('nilai') is-invalid @enderror" name="nilai"
                                value="{{ $kamarMandi->nilai }}">
                            @error('nilai')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary">Submit</button>
                        <a class="btn btn-secondary" href="{{ route('kamar-mandi.index') }}">Cancel</a>
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
