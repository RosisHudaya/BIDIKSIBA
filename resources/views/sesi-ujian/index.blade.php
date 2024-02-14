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
                            <a class="btn btn-primary" href="{{ route('sesi-ujian.create') }}">
                                <i class="fas fa-edit"></i> Tambah Sesi Ujian
                            </a>
                        </div>
                        <div class="card-body">
                            <form id="search" method="GET" action="{{ route('ujian.index') }}">
                                <div class="d-flex mb-3">
                                    <input type="text" name="name" class="form-control mr-2" id="name"
                                        placeholder="cari sesi ujian..." value="{{ app('request')->input('name') }}">
                                    <button class="btn btn-primary mr-1 py-0 px-4" type="submit">Submit</button>
                                    <a class="btn btn-secondary py-2 px-4" href="{{ route('ujian.index') }}">Reset</a>
                                </div>
                            </form>
                            <div class="table-responsive">
                                <table class="table table-bordered table-md">
                                    <tbody>
                                        <tr>
                                            <th class="text-center align-middle" style="width: 75px;">#</th>
                                            <th class="align-middle" style="width: 200px;">Sesi Ujian</th>
                                            <th class="align-middle" style="width: 200px;">Ujian</th>
                                            <th class="text-center align-middle" style="width: 100px;">Jumlah Peserta</th>
                                            <th class="text-center align-middle" style="width: 400px;">Waktu</th>
                                            <th class="text-center align-middle">Aksi</th>
                                        </tr>
                                        @foreach ($sesiUjians as $key => $sesiUjian)
                                            <tr>
                                                <td class="text-center">
                                                    {{ ($sesiUjians->currentPage() - 1) * $sesiUjians->perPage() + $key + 1 }}
                                                </td>
                                                <td>{{ $sesiUjian->nama_sesi }}</td>
                                                <td>{{ $sesiUjian->nama_ujian }}</td>
                                                <td class="text-center">-</td>
                                                <td class="text-center">
                                                    {{ \Carbon\Carbon::parse($sesiUjian->waktu_mulai)->format('d F Y H:i:s') }}
                                                    -
                                                    {{ \Carbon\Carbon::parse($sesiUjian->waktu_akhir)->format('d F Y H:i:s') }}
                                                </td>
                                                <td class="text-right">
                                                    <div class="d-flex justify-content-center">
                                                        <a href="{{ route('sesi-ujian.edit', $sesiUjian->id) }}"
                                                            class="btn btn-sm btn-info btn-icon ml-2">
                                                            <i class="fas fa-edit"></i>
                                                            Edit
                                                        </a>
                                                        <form action="{{ route('sesi-ujian.destroy', $sesiUjian->id) }}"
                                                            method="POST" class="ml-2" id="del-<?= $sesiUjian->id ?>">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-sm btn-danger btn-icon"
                                                                data-confirm="Konfirmasi Hapus | Apakah Anda yakin ingin menghapus data sesi ujian ini?"
                                                                data-confirm-yes="submitDel(<?= $sesiUjian->id ?>)"
                                                                data-id="del-{{ $sesiUjian->id }}">
                                                                <i class="fas fa-times"></i> Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center">
                                    {{ $sesiUjians->withQueryString()->links() }}
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
