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
                                <i class="fas fa-feather-alt"></i> Tambah Ujian
                            </a>
                        </div>
                        <div class="card-body">
                            <form id="search" method="GET" action="{{ route('jurusan.index') }}">
                                <div class="d-flex mb-3">
                                    <input type="text" name="name" class="form-control mr-2" id="name"
                                        placeholder="cari nama ujian..." value="{{ app('request')->input('name') }}">
                                    <button class="btn btn-primary mr-1 py-0 px-4" type="submit">Submit</button>
                                    <a class="btn btn-secondary py-2 px-4" href="{{ route('jurusan.index') }}">Reset</a>
                                </div>
                            </form>
                            <div class="table-responsive">
                                <table class="table table-bordered table-md">
                                    <tbody>
                                        <tr>
                                            <th class="text-center" style="width: 50px;">#</th>
                                            <th class="text-center">Ujian</th>
                                            <th class="text-center">Jumlah Soal</th>
                                            <th class="text-center">Deskripsi</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                        {{-- @foreach ($jurusans as $key => $jurusan)
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
                                                                class="fas fa-edit"></i>
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
                                                                <i class="fas fa-times"></i> Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach --}}
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center">
                                    {{-- {{ $jurusans->withQueryString()->links() }} --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('customScript')
@endpush

@push('customStyle')
    <script>
        function submitDel(id) {
            $('#del-' + id).submit()
        }
    </script>
@endpush
