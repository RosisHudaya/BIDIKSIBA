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
                            @role('super-admin')
                                <a class="btn btn-primary" href="{{ route('ujian.create') }}">
                                    <i class="fas fa-edit"></i> Tambah Ujian
                                </a>
                            @endrole
                        </div>
                        <div class="card-body">
                            <form id="search" method="GET" action="{{ route('ujian.index') }}">
                                <div class="d-flex mb-3 d-search">
                                    <input type="text" name="name" class="form-control mr-2 d-input" id="name"
                                        placeholder="cari nama ujian..." value="{{ app('request')->input('name') }}">
                                    <button class="btn btn-primary mr-1 py-0 px-4 d-submit" type="submit">Submit</button>
                                    <a class="btn btn-secondary py-2 px-4" href="{{ route('ujian.index') }}">Reset</a>
                                </div>
                            </form>
                            <div class="table-responsive">
                                <table class="table table-bordered table-md">
                                    <tbody>
                                        <tr>
                                            <th class="text-center" style="width: 50px;">#</th>
                                            <th style="width: 250px;">Nama Ujian</th>
                                            <th class="text-center" style="width: 150px;">Jumlah Soal</th>
                                            <th style="width: 250px;">Deskripsi</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                        @foreach ($ujians as $key => $ujian)
                                            <tr>
                                                <td class="text-center">
                                                    {{ ($ujians->currentPage() - 1) * $ujians->perPage() + $key + 1 }}
                                                </td>
                                                <td>{{ $ujian->nama_ujian }}</td>
                                                <td class="text-center">{{ $ujian->jumlah_soal }}</td>
                                                <td class="text-justify">{!! $ujian->deskripsi ?? '--' !!}</td>
                                                <td class="text-right">
                                                    <div class="d-flex justify-content-center">
                                                        <a href="{{ route('soalUjian', $ujian->id) }}"
                                                            class="btn btn-sm btn-exam">
                                                            <i class="fas fa-file-medical i-all"></i>
                                                            Soal
                                                        </a>
                                                        @role('super-admin')
                                                            <a href="{{ route('ujian.edit', $ujian->id) }}"
                                                                class="btn btn-sm btn-info btn-icon ml-2">
                                                                <i class="fas fa-edit i-all"></i>
                                                                Edit
                                                            </a>
                                                            <form action="{{ route('ujian.destroy', $ujian->id) }}"
                                                                method="POST" class="ml-2" id="del-<?= $ujian->id ?>">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-sm btn-danger btn-icon"
                                                                    data-confirm="Konfirmasi Hapus | Apakah Anda yakin ingin menghapus data ujian ini?"
                                                                    data-confirm-yes="submitDel(<?= $ujian->id ?>)"
                                                                    data-id="del-{{ $ujian->id }}">
                                                                    <i class="fas fa-times i-all"></i> Delete
                                                                </button>
                                                            </form>
                                                        @endrole
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-center d-pag">
                                {{ $ujians->withQueryString()->links() }}
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
