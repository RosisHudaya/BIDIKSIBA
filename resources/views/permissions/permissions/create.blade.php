@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Roles and Permission</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Form Tambah Data Permission</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('permission.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">Permission</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" placeholder="masukkan name permission baru..." value="{{ old('name') }}">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="name">Guard Name</label>
                            <input type="text" class="form-control @error('guard_name') is-invalid @enderror"
                                id="guard_name" name="guard_name" placeholder="" value="{{ old('guard_name', 'web') }}">
                            @error('guard_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary">Submit</button>
                    <a class="btn btn-secondary" href="{{ route('permission.index') }}">Cancel</a>
                </div>
                </form>
            </div>
        </div>
    </section>
@endsection
