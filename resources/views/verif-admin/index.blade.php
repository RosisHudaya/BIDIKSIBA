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
                        <div class="card-body">
                            <form id="search" method="GET" action="{{ route('jurusan.index') }}">
                                <div class="d-flex mb-3">
                                    <input type="text" name="name" class="form-control mr-2" id="name"
                                        placeholder="cari nama jurusan SMA/SMK..."
                                        value="{{ app('request')->input('name') }}">
                                    <button class="btn btn-primary mr-1 py-0 px-4" type="submit">Submit</button>
                                    <a class="btn btn-secondary py-2 px-4" href="{{ route('jurusan.index') }}">Reset</a>
                                </div>
                            </form>
                            <div class="table-responsive">
                                <table class="table table-bordered table-md">
                                    <tbody>
                                        <tr>
                                            <th class="text-center" style="width: 5%;">#</th>
                                            <th style="width: 20%;">NAMA</th>
                                            <th style="width: 25%;">EMAIL</th>
                                            <th style="width: 15%;">STATUS</th>
                                            <th class="text-center" style="width: 25%;">AKSI</th>
                                        </tr>
                                        @foreach ($biodatas as $key => $biodata)
                                            <tr>
                                                <td class="text-center">
                                                    {{ ($biodatas->currentPage() - 1) * $biodatas->perPage() + $key + 1 }}
                                                </td>
                                                <td>{{ $biodata->nama }}</td>
                                                <td>{{ $biodata->email }}</td>
                                                <td style="text-transform: uppercase;">{{ $biodata->status }}</td>
                                                <td class="text-right">
                                                    <div class="d-flex justify-content-center">
                                                        <a href="{{ route('asal-jurusan.edit', $biodata->id) }}"
                                                            class="btn btn-sm btn-info btn-icon "><i
                                                                class="fas fa-edit"></i>
                                                            Edit
                                                        </a>
                                                        <form action="{{ route('asal-jurusan.destroy', $biodata->id) }}"
                                                            method="POST" class="ml-2" id="del-<?= $biodata->id ?>">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-sm btn-danger btn-icon"
                                                                data-confirm="Konfirmasi Hapus | Apakah Anda yakin ingin menghapus jurusan SMA/SMK ini?"
                                                                data-confirm-yes="submitDel(<?= $biodata->id ?>)"
                                                                data-id="del-{{ $biodata->id }}">
                                                                <i class="fas fa-times"></i> Delete
                                                            </button>
                                                        </form>
                                                        <a class="btn btn-sm btn-secondary ml-2 detail"
                                                            data-id="{{ $biodata->id }}">
                                                            <i class="fas fa-angle-double-down"
                                                                id="toggle-icon-{{ $biodata->id }}">
                                                            </i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                    <tbody class="show-detail-{{ $biodata->id }}" style="display: none;">
                                        <tr>
                                            <th></th>
                                            <th>NIK</th>
                                            <th>NISN</th>
                                            <th>ASAL SEKOLAH</th>
                                            <th></th>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>{{ $biodata->nik }}</td>
                                            <td>{{ $biodata->nisn }}</td>
                                            <td>{{ $biodata->asal_sekolah }}</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <th>KOTA LAHIR</th>
                                            <th>TANGGAL LAHIR</th>
                                            <th>JENIS KELAMIN</th>
                                            <th></th>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>{{ $biodata->kota_lahir }}</td>
                                            <td>{{ \Carbon\Carbon::parse($biodata->tgl_lahir)->format('d F Y') }}
                                            </td>
                                            <td>{{ $biodata->gender }}</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <th>NOMER TELEPON</th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td> {{ $biodata->no_telp }} </td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <th>JURUSAN SMA/SMK</th>
                                            <th>JURUSAN PILIHAN</th>
                                            <th>PRODI PILIHAN</th>
                                            <th></th>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>{{ $biodata->asal_jurusan }}</td>
                                            <td>{{ $biodata->jurusan }}</td>
                                            <td>{{ $biodata->prodi }}</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4"></td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center">
                                                    <form action="{{ route('verifikasi-pendaftar.verif', $biodata->id) }}"
                                                        method="POST" id="ver-<?= $biodata->id ?>">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-sm btn-success"
                                                            data-confirm="Verifikasi Biodata | Apakah data biodata sudah benar dan akan diverifikasi ?"
                                                            data-confirm-yes="submitVer(<?= $biodata->id ?>)"
                                                            data-id="ver-{{ $biodata->id }}">
                                                            <i class="fas fa-check-circle"></i>
                                                            Verifikasi
                                                        </button>
                                                    </form>
                                                    <a class="btn btn-sm btn-danger ml-2 tolak" style="color: white;">
                                                        <i class="fas fa-times-circle"></i>
                                                        Tolak
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="5">
                                                <div class="show-tolak text-right" style="display: none;">
                                                    <form action="{{ route('verifikasi-pendaftar.reject', $biodata->id) }}"
                                                        method="POST" id="rej-<?= $biodata->id ?>"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <textarea name="catatan" id="catatan" cols="100" rows="5">{{ $biodata->catatan }}</textarea>
                                                        <br>
                                                        <p class="mb-2 mt-0 pt-0 text-c">* Tambahkan pesan kesalahan biodata
                                                            pendaftar(opsional)</p>
                                                        <button type="submit" class="btn btn-sm btn-primary ml-2"
                                                            data-confirm="Verifikasi Biodata | Apakah data biodata belum bisa diverifikasi dan kirim pesan kesalahan ?"
                                                            data-confirm-yes="sumbitRej(<?= $biodata->id ?>)"
                                                            data-id="rej-{{ $biodata->id }}">
                                                            <i class="fas fa-paper-plane"></i>
                                                            Kirim
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center">
                                    {{ $biodatas->withQueryString()->links() }}
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
    <script>
        $(document).ready(function() {
            var openedDetailId = null;

            $('.detail').click(function(event) {
                var biodataId = $(this).data('id');
                var toggleIcon = $("#toggle-icon-" + biodataId);

                if (openedDetailId !== null && openedDetailId !== biodataId) {
                    $(".show-detail-" + openedDetailId).slideUp("fast");
                    $("#toggle-icon-" + openedDetailId).removeClass("fa-angle-double-up").addClass(
                        "fa-angle-double-down");
                }

                $(".show-detail-" + biodataId).slideToggle("fast");

                if (openedDetailId === biodataId) {
                    toggleIcon.removeClass("fa-angle-double-up").addClass("fa-angle-double-down");
                } else {
                    toggleIcon.removeClass("fa-angle-double-down").addClass("fa-angle-double-up");
                }

                openedDetailId = (openedDetailId === biodataId) ? null : biodataId;
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.tolak').click(function(event) {
                event.stopPropagation();
                $(".show-tolak").slideToggle("fast");
            });
        });
    </script>
@endpush

@push('customStyle')
    <script>
        function submitDel(id) {
            $('#del-' + id).submit()
        }

        function submitVer(id) {
            $('#ver-' + id).submit()
        }

        function sumbitRej(id) {
            $('#rej-' + id).submit()
        }
    </script>
@endpush
