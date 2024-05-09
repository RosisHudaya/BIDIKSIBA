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
                            <a class="btn btn-success btn-spk" href="{{ route('export.biodata') }}">
                                <i class="fas fa-file-csv"></i> Biodata
                            </a>
                            <a class="btn btn-success btn-spk" href="{{ route('export.ekonomi') }}">
                                <i class="fas fa-file-csv"></i> Data SPK
                            </a>
                            <a class="btn btn-success btn-spk" href="{{ route('export.pendaftar') }}">
                                <i class="fas fa-file-csv"></i> Data Pendaftar
                            </a>
                        </div>
                        <div class="card-body">
                            <form id="search" method="GET" action="{{ route('verifikasi-pendaftar.index') }}">
                                <div class="d-flex mb-3 v-search">
                                    <input type="text" name="name" class="form-control mr-2 d-input" id="name"
                                        placeholder="cari nama pendaftar..." value="{{ app('request')->input('name') }}">
                                    <select class="form-control select2" name="status" id="status">
                                        <option value="" disabled selected>
                                            filter status pendaftar...
                                        </option>
                                        <option value="Pending" @if ($statusSelected == 'Pending') selected @endif>
                                            PENDING
                                        </option>
                                        <option value="Blm Diverifikasi" @if ($statusSelected == 'Blm Diverifikasi') selected @endif>
                                            BLM DIVERIFIKASI
                                        </option>
                                        <option value="Diverifikasi" @if ($statusSelected == 'Diverifikasi') selected @endif>
                                            DIVERIFIKASI
                                        </option>
                                    </select>
                                    <div class="d-flex text-right v-btn">
                                        <button class="btn btn-primary mr-1 ml-2 py-0 px-4 v-submit" type="submit">
                                            Submit
                                        </button>
                                        <a class="btn btn-secondary py-2 px-4 v-reset"
                                            href="{{ route('verifikasi-pendaftar.index') }}">
                                            Reset
                                        </a>
                                    </div>
                                </div>
                            </form>
                            <div class="table-responsive">
                                <table class="table table-bordered table-md">
                                    <tbody>
                                        <tr>
                                            <th class="text-center" style="width: 5%;">#</th>
                                            <th style="width: 20%;">NAMA</th>
                                            <th style="width: 20%;">EMAIL</th>
                                            <th style="width: 20%;">STATUS</th>
                                            @role('super-admin')
                                                <th class="text-center" style="width: 20%;">AKSI</th>
                                            @endrole
                                            @role('admin-bidiksiba')
                                                <th class="text-left" style="width: 20%;">AKSI</th>
                                            @endrole
                                        </tr>
                                        @foreach ($biodatas as $key => $biodata)
                                            <tr>
                                                <td class="text-center">
                                                    {{ ($biodatas->currentPage() - 1) * $biodatas->perPage() + $key + 1 }}
                                                </td>
                                                <td style="text-transform: uppercase;">{{ $biodata->nama }}</td>
                                                <td>{{ $biodata->email }}</td>
                                                <td class="font-weight-bold"
                                                    style="text-transform: uppercase; 
                                                    color: @if ($biodata->status == 'Pending') #fba605;
                                                           @elseif($biodata->status == 'Diverifikasi') #3eac57;
                                                           @else #eb2a2a; @endif">
                                                    {{ $biodata->status }}
                                                </td>
                                                <td class="text-right">
                                                    @role('super-admin')
                                                        <div class="d-flex justify-content-center">
                                                            <a href="{{ route('verifikasi-pendaftar.edit', $biodata->id) }}"
                                                                class="btn btn-sm btn-info btn-icon "><i
                                                                    class="fas fa-edit i-all"></i>
                                                                Edit
                                                            </a>
                                                            <form
                                                                action="{{ route('verifikasi-pendaftar.destroy', $biodata->id) }}"
                                                                method="POST" class="ml-2" id="del-<?= $biodata->id ?>">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-sm btn-danger btn-icon"
                                                                    data-confirm="Konfirmasi Hapus | Apakah Anda yakin ingin menghapus biodata pendaftar ini?"
                                                                    data-confirm-yes="submitDel(<?= $biodata->id ?>)"
                                                                    data-id="del-{{ $biodata->id }}">
                                                                    <i class="fas fa-times i-all"></i> Delete
                                                                </button>
                                                            </form>
                                                            <a class="btn btn-sm btn-secondary ml-2 detail"
                                                                data-id="{{ $biodata->id }}">
                                                                <i class="fas fa-angle-double-down"
                                                                    id="toggle-icon-{{ $biodata->id }}">
                                                                </i>
                                                            </a>
                                                        </div>
                                                    @endrole
                                                    @role('admin-bidiksiba')
                                                        <div class="d-flex justify-content-start">
                                                            <a class="btn btn-sm btn-secondary ml-2 detail"
                                                                data-id="{{ $biodata->id }}">
                                                                <i class="fas fa-angle-double-down"
                                                                    id="toggle-icon-{{ $biodata->id }}">
                                                                </i>
                                                            </a>
                                                        </div>
                                                    @endrole
                                                </td>
                                            </tr>
                                            @include('verif-admin.biodata')
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center d-pag">
                                    {{ $biodatas->withQueryString()->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @foreach ($biodatas as $biodata)
        <!-- modal foto -->
        <div class="modal fade" id="fotoModal-{{ $biodata->id }}" tabindex="-1" role="dialog"
            aria-labelledby="fotoModalLabel-{{ $biodata->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        @if ($biodata && $biodata->foto)
                            <img class="w-100" src="{{ asset('storage/' . $biodata->foto) }}" alt="foto">
                        @else
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- modal ktp -->
        <div class="modal fade" id="fotoKtp-{{ $biodata->id }}" tabindex="-1" role="dialog"
            aria-labelledby="fotoKtpModalLabel-{{ $biodata->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        @if ($biodata && $biodata->ktp)
                            <img class="w-100" src="{{ asset('storage/' . $biodata->ktp) }}" alt="ktp">
                        @else
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- modal kk -->
        <div class="modal fade" id="fotoKk-{{ $biodata->id }}" tabindex="-1" role="dialog"
            aria-labelledby="fotoKkModalLabel-{{ $biodata->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        @if ($biodata && $biodata->kk)
                            <img class="w-100" src="{{ asset('storage/' . $biodata->kk) }}" alt="kk">
                        @else
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- modal kartu siswa -->
        <div class="modal fade" id="fotoKartuSiswa-{{ $biodata->id }}" tabindex="-1" role="dialog"
            aria-labelledby="fotoKartuSiswaModalLabel-{{ $biodata->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        @if ($biodata && $biodata->kartu_siswa)
                            <img class="w-100" src="{{ asset('storage/' . $biodata->kartu_siswa) }}" alt="kartu_siswa">
                        @else
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- modal slip gaji -->
        <div class="modal fade" id="fotoSlipGaji-{{ $biodata->id }}" tabindex="-1" role="dialog"
            aria-labelledby="fotoSlipGajiModalLabel-{{ $biodata->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        @if ($biodata && $biodata->slip_gaji)
                            <img class="w-100" src="{{ asset('storage/' . $biodata->slip_gaji) }}" alt="slip-gaji">
                        @else
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- modal shm -->
        <div class="modal fade" id="fotoShm-{{ $biodata->id }}" tabindex="-1" role="dialog"
            aria-labelledby="fotoShmLabel-{{ $biodata->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        @if ($biodata && $biodata->shm)
                            <img class="w-100" src="{{ asset('storage/' . $biodata->shm) }}" alt="shm">
                        @else
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- modal foto kamar -->
        <div class="modal fade" id="fotoKamar-{{ $biodata->id }}" tabindex="-1" role="dialog"
            aria-labelledby="fotoKamarLabel-{{ $biodata->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        @if ($biodata && $biodata->foto_kmr)
                            <img class="w-100" src="{{ asset('storage/' . $biodata->foto_kmr) }}" alt="foto-kamar">
                        @else
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- modal foto kamar mandi -->
        <div class="modal fade" id="fotoKamarMandi-{{ $biodata->id }}" tabindex="-1" role="dialog"
            aria-labelledby="fotoKamarMandiLabel-{{ $biodata->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        @if ($biodata && $biodata->foto_kmr_mandi)
                            <img class="w-100" src="{{ asset('storage/' . $biodata->foto_kmr_mandi) }}"
                                alt="foto-kamar-mandi">
                        @else
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- modal foto tagihan listrik -->
        <div class="modal fade" id="fotoTagihanListrik-{{ $biodata->id }}" tabindex="-1" role="dialog"
            aria-labelledby="fotoTagihanListrikLabel-{{ $biodata->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        @if ($biodata && $biodata->slip_tagihan)
                            <img class="w-100" src="{{ asset('storage/' . $biodata->slip_tagihan) }}"
                                alt="tagihan-listrik">
                        @else
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- modal foto slip pbb -->
        <div class="modal fade" id="fotoSlipPbb-{{ $biodata->id }}" tabindex="-1" role="dialog"
            aria-labelledby="fotoSlipPbbLabel-{{ $biodata->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        @if ($biodata && $biodata->slip_pbb)
                            <img class="w-100" src="{{ asset('storage/' . $biodata->slip_pbb) }}" alt="slip-pbb">
                        @else
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- modal foto surat ket saudara -->
        <div class="modal fade" id="fotoKetSdr-{{ $biodata->id }}" tabindex="-1" role="dialog"
            aria-labelledby="fotoKetSdrLabel-{{ $biodata->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        @if ($biodata && $biodata->surat_ket_sdr)
                            <img class="w-100" src="{{ asset('storage/' . $biodata->surat_ket_sdr) }}" alt="ket-sdr">
                        @else
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- modal foto surat ket yatim -->
        <div class="modal fade" id="fotoKetYatim-{{ $biodata->id }}" tabindex="-1" role="dialog"
            aria-labelledby="fotoKetYatimLabel-{{ $biodata->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        @if ($biodata && $biodata->surat_ket_yatim)
                            <img class="w-100" src="{{ asset('storage/' . $biodata->surat_ket_yatim) }}"
                                alt="ket-yatim">
                        @else
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach
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

        function submitVer(id) {
            $('#ver-' + id).submit()
        }

        function sumbitRej(id) {
            $('#rej-' + id).submit()
        }
    </script>
@endpush
