@extends('layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit Data Bobot Kriteria</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <form action="{{ route('bobot-kriteria.update', $bobot_kriterium) }}" method="POST">
                    <div class="card-header">
                        <h4>Validasi Edit Data Bobot Kriteria</h4>
                    </div>
                    <div class="card-body">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="">Nama Kriteria</label>
                            <input type="text" class="form-control @error('kriteria') is-invalid @enderror"
                                name="kriteria" value="{{ $bobot_kriterium->kriteria }}">
                            @error('kriteria')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="p-0 m-0" for="">Bobot Kriteria</label>
                            <p class="p-0 m-0 text-success">* untuk desimal menggunakan titik</p>
                            <input type="text" class="form-control @error('bobot') is-invalid @enderror" name="bobot"
                                value="{{ $bobot_kriterium->bobot }}">
                            @error('bobot')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Jenis Kriteria</label>
                            {{-- <select class="form-control select2" name="jenis" id="jenis">
                                <option value="" disabled>Jenis Kriteria</option>
                                <option value="BENEFIT"
                                    {{ isset($bobot_kriterium) && $bobot_kriterium->jenis === 'BENEFIT' ? 'selected' : '' }}>
                                    BENEFIT
                                </option>
                                <option value="COST"
                                    {{ isset($bobot_kriterium) && $bobot_kriterium->jenis === 'COST' ? 'selected' : '' }}>
                                    COST
                                </option>
                            </select> --}}
                            <input type="text" class="form-control" value="{{ $bobot_kriterium->jenis }}" disabled>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary">Submit</button>
                        <a class="btn btn-secondary" href="{{ route('bobot-kriteria.index') }}">Cancel</a>
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
