@extends('layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit Data Jurusan</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <form action="{{ route('jurusan.update', $jurusan) }}" method="POST">
                    <div class="card-header">
                        <h4>Validasi Edit Data Jurusan</h4>
                    </div>
                    <div class="card-body">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="jurusan">Your Name</label>
                            <input type="text" class="form-control @error('jurusan') is-invalid @enderror" id="jurusan"
                                name="jurusan" value="{{ $jurusan->jurusan }}">
                            @error('jurusan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
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
