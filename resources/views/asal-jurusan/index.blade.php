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
                            <a class="btn btn-primary" href="{{ route('asal-jurusan.create') }}">
                                <i class="fas fa-graduation-cap"></i> Tambah Jurusan SMA/SMK
                            </a>
                        </div>
                        <div class="card-body">
                            <form id="search" method="GET" action="{{ route('asal-jurusan.index') }}">
                                <div class="d-flex mb-3 d-search">
                                    <input type="text" name="name" class="form-control mr-2 d-input" id="name"
                                        placeholder="cari nama jurusan SMA/SMK..."
                                        value="{{ app('request')->input('name') }}">
                                    <button class="btn btn-primary mr-1 py-0 px-4 d-submit" type="submit">Submit</button>
                                    <a class="btn btn-secondary py-2 px-4" href="{{ route('asal-jurusan.index') }}">
                                        Reset
                                    </a>
                                </div>
                            </form>
                            <div class="table-responsive">
                                <table class="table table-bordered table-md">
                                    <tbody>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Jurusan SMA/SMK</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                        @foreach ($asal_jurusans as $key => $asal_jurusan)
                                            <tr>
                                                <td class="text-center">
                                                    {{ ($asal_jurusans->currentPage() - 1) * $asal_jurusans->perPage() + $key + 1 }}
                                                </td>
                                                <td>{{ $asal_jurusan->asal_jurusan }}</td>
                                                <td class="text-right">
                                                    <div class="d-flex justify-content-center">
                                                        <a href="{{ route('asal-jurusan.edit', $asal_jurusan->id) }}"
                                                            class="btn btn-sm btn-info btn-icon "><i
                                                                class="fas fa-edit i-all"></i>
                                                            Edit
                                                        </a>
                                                        <form
                                                            action="{{ route('asal-jurusan.destroy', $asal_jurusan->id) }}"
                                                            method="POST" class="ml-2" id="del-<?= $asal_jurusan->id ?>">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-sm btn-danger btn-icon"
                                                                data-confirm="Konfirmasi Hapus | Apakah Anda yakin ingin menghapus jurusan SMA/SMK ini?"
                                                                data-confirm-yes="submitDel(<?= $asal_jurusan->id ?>)"
                                                                data-id="del-{{ $asal_jurusan->id }}">
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
                                {{ $asal_jurusans->withQueryString()->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('customScript')
    <script src="/assets/js/pagination.js"></script>
@endpush

@push('customStyle')
    <script>
        function submitDel(id) {
            $('#del-' + id).submit()
        }
    </script>
@endpush
