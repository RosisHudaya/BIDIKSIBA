@extends('layouts.app')

@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>List</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    @include('layouts.alert')
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="header ml-4 mt-3">
                            <a class="btn btn-primary" href="{{ route('jurusan.create') }}">
                                <i class="fas fa-graduation-cap"></i> Tambah Jurusan
                            </a>
                        </div>
                        <div class="card-body">
                            <form id="search" method="GET" action="{{ route('jurusan.index') }}">
                                <div class="d-flex mb-3 v-search">
                                    <input type="text" name="name" class="form-control mr-2 d-input" id="name"
                                        placeholder="cari nama jurusan..." value="{{ app('request')->input('name') }}">
                                    <select class="form-control select2" name="asal_jurusan" id="asal_jurusan">
                                        <option value="" disabled selected>cari nama asal jurusan SMA/SMK...</option>
                                        @foreach ($asal_jurusans as $asal_jurusan)
                                            <option value="{{ $asal_jurusan->id }}"
                                                @if ($asal_jurusan->id == $asalJurusanSelected) selected @endif>
                                                {{ $asal_jurusan->asal_jurusan }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="d-flex text-right v-btn">
                                        <button class="btn btn-primary mr-1 ml-2 py-0 px-4 v-submit" type="submit">
                                            Submit
                                        </button>
                                        <a class="btn btn-secondary py-2 px-4 v-reset" href="{{ route('jurusan.index') }}">
                                            Reset
                                        </a>
                                    </div>
                                </div>
                            </form>
                            <div class="table-responsive">
                                <table class="table table-bordered table-md">
                                    <tbody>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th style="width: 350px;">Jurusan SMA/SMK</th>
                                            <th>Jurusan</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                        @foreach ($jurusans as $key => $jurusan)
                                            <tr>
                                                <td class="text-center">
                                                    {{ ($jurusans->currentPage() - 1) * $jurusans->perPage() + $key + 1 }}
                                                </td>
                                                <td>{{ $jurusan->asal }}</td>
                                                <td>{{ $jurusan->jurusan }}</td>
                                                <td class="text-right">
                                                    <div class="d-flex justify-content-center">
                                                        <a href="{{ route('jurusan.edit', $jurusan->id) }}"
                                                            class="btn btn-sm btn-info btn-icon "><i
                                                                class="fas fa-edit i-all"></i>
                                                            Edit
                                                        </a>
                                                        <form action="{{ route('jurusan.destroy', $jurusan->id) }}"
                                                            method="POST" class="ml-2" id="del-<?= $jurusan->id ?>">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-sm btn-danger btn-icon"
                                                                data-confirm="Konfirmasi Hapus | Apakah Anda yakin ingin menghapus jurusan ini?"
                                                                data-confirm-yes="submitDel(<?= $jurusan->id ?>)"
                                                                data-id="del-{{ $jurusan->id }}">
                                                                <i class="fas fa-times i-all"></i> Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-center d-pag">
                                {{ $jurusans->withQueryString()->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('customScript')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
    <script src="/assets/js/pagination.js"></script>
@endpush

@push('customStyle')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script>
        function submitDel(id) {
            $('#del-' + id).submit()
        }
    </script>
@endpush
