@extends('layouts.app')

@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-container">
            <h1><i class="fas fa-stopwatch c-icon"></i> SESI UJIAN</h1>
            <hr>
            <table class="table table-bordered table-md">
                <tbody>
                    <tr>
                        <th class="th-test" style="width: 300px;">NAMA UJIAN</th>
                        <td>{{ $ujian->nama_ujian }}</td>
                    </tr>
                    <tr>
                        <th class="th-test" style="width: 300px;">JUMLAH</th>
                        <td>{{ $jumlah_peserta_ujian }} Orang</td>
                    </tr>
                    <tr>
                        <th class="th-test" style="width: 300px;">SESI</th>
                        <td>{{ $sesi_ujian->nama_sesi }}</td>
                    </tr>
                    <tr>
                        <th class="th-test" style="width: 300px;">MULAI</th>
                        <td>{{ \Carbon\Carbon::parse($sesi_ujian->waktu_mulai)->format('d F Y H:i:s') }}</td>
                    </tr>
                    <tr>
                        <th class="th-test" style="width: 300px;">SELESAI</th>
                        <td>{{ \Carbon\Carbon::parse($sesi_ujian->waktu_akhir)->format('d F Y H:i:s') }}</td>
                    </tr>
                </tbody>
            </table>
            <div class="text-right">
                <a class="btn btn-secondary" href="{{ route('sesi-ujian.index') }}">Kembali</a>
            </div>
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
                        <div class="d-flex ml-4 mt-3 mr-2">
                            <div class=" col-md-4 m-0 p-0">
                                <a class="btn btn-primary" href="{{ route('sesi-user.create', $sesi_ujian->id) }}">
                                    <i class="fas fa-user-plus"></i> Tambah Peserta Ujian
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form id="search" method="GET" action="{{ route('sesiUjian', $sesi_ujian->id) }}">
                                <div class="d-flex mb-3 d-search">
                                    <input type="text" name="name" class="form-control mr-2 d-input" id="name"
                                        placeholder="cari nama peserta ujian..."
                                        value="{{ app('request')->input('name') }}">
                                    <button class="btn btn-primary mr-1 py-0 px-4 d-submit" type="submit">Submit</button>
                                    <a class="btn btn-secondary py-2 px-4" href="{{ route('sesiUjian', $sesi_ujian->id) }}">
                                        Reset
                                    </a>
                                </div>
                            </form>
                            <div class="table-responsive">
                                <table class="table table-bordered table-md">
                                    <tbody>
                                        <tr>
                                            <th class="text-center" style="width: 100px;">NO</th>
                                            <th>NAMA</th>
                                            <th class="text-center" style="width: 300px;">JENIS KELAMIN</th>
                                            <th class="text-center" style="width: 300px;">AKSI</th>
                                        </tr>
                                        @foreach ($sesi_users as $key => $sesi_user)
                                            <tr>
                                                <td class="text-center font-weight-bold">
                                                    {{ ($sesi_users->currentPage() - 1) * $sesi_users->perPage() + $key + 1 }}
                                                </td>
                                                <td style="text-transform: uppercase;">{{ $sesi_user->nama }}</td>
                                                <td class="text-center">{{ $sesi_user->gender }}</td>
                                                <td class="text-right">
                                                    <div class="d-flex justify-content-center">
                                                        <form
                                                            action="{{ route('sesi-user.destroy', ['sesiUser' => $sesi_user->id, 'sesi_ujian' => $sesi_ujian->id]) }}"
                                                            method="POST" class="ml-2" id="del-<?= $sesi_user->id ?>">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-sm btn-danger btn-icon"
                                                                data-confirm="Konfirmasi Hapus | Apakah Anda yakin ingin menghapus peserta ini dari sesi ujian?"
                                                                data-confirm-yes="submitDel(<?= $sesi_user->id ?>)"
                                                                data-id="del-{{ $sesi_user->id }}">
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
                                {{ $sesi_users->withQueryString()->links() }}
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
