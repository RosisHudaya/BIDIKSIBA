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
                            <form id="search" method="GET" action="{{ route('verifikasi-pendaftar.index') }}">
                                <div class="d-flex mb-3">
                                    <input type="text" name="name" class="form-control mr-2" id="name"
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
                                    <button class="btn btn-primary mr-1 ml-2 py-0 px-4" type="submit">Submit</button>
                                    <a class="btn btn-secondary py-2 px-4" href="{{ route('verifikasi-pendaftar.index') }}">
                                        Reset
                                    </a>
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
                                            @include('verif-admin.biodata')
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

    <!-- modal foto -->
    @foreach ($biodatas as $biodata)
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
