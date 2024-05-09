@extends('layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit Data Kriteria Status Orang Tua</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <form action="{{ route('status-ortu.update', $statusOrtu) }}" method="POST">
                    <div class="card-header">
                        <h4>Validasi Edit Data Kriteria Status Orang Tua</h4>
                    </div>
                    <div class="card-body">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="">Status Orang Tua</label>
                            <input type="text" class="form-control @error('status_ortu') is-invalid @enderror"
                                name="status_ortu" value="{{ $statusOrtu->status_ortu }}">
                            @error('status_ortu')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Nilai</label>
                            <input type="number" class="form-control @error('nilai') is-invalid @enderror" name="nilai"
                                value="{{ $statusOrtu->nilai }}">
                            @error('nilai')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary">Submit</button>
                        <a class="btn btn-secondary" href="{{ route('status-ortu.index') }}">Cancel</a>
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
