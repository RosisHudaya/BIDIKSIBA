@extends('landing-page.app')
@section('title', 'BIDIKSIBA POLINEMA | List Ujian')
@push('style')
    <link rel="stylesheet" href="/assets/css/public.css">
@endpush
@section('main')
    <div class="col-md-11 mx-auto my-4">
        <div class="col-md-12 d-flex p-main-title mb-0 py-1 px-3">
            <div class="col-md-6 p-0">
                <p class="m-0 p-0">HALAMAN UJIAN BIDIKSIBA</p>
            </div>
        </div>
        <div class="p-main pt-1 pb-4 px-3">
            <div class="col-md-9 p-0 my-2 mx-auto col-peng">
                <p class="mb-2 p-0 p-t">LIST UJIAN</p>
                <div class="table-responsive">
                    <table class="table table-bordered table-md">
                        <tbody>
                            <tr>
                                <th class="text-center" style="width: 50px;">#</th>
                                <th style="width: 300px;">Sesi</th>
                                <th style="width: 300px;">Ujian</th>
                                <th style="width: 400px;">Waktu</th>
                                <th class="text-center" style="width: 150px;">Aksi</th>
                            </tr>
                            @foreach ($list_ujians as $key => $list_ujian)
                                <tr>
                                    <td class="text-center">
                                        {{ ($list_ujians->currentPage() - 1) * $list_ujians->perPage() + $key + 1 }}
                                    </td>
                                    <td>{{ $list_ujian->nama_sesi }}</td>
                                    <td>{{ $list_ujian->nama_ujian }}</td>
                                    <td>
                                        Mulai&nbsp;&nbsp; :
                                        {{ \Carbon\Carbon::parse($list_ujian->waktu_mulai)->format('d F Y H:i:s') }}<br>
                                        Selesai :
                                        {{ \Carbon\Carbon::parse($list_ujian->waktu_akhir)->format('d F Y H:i:s') }}
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('pengawas.detail', $list_ujian->id) }}"
                                            class="btn btn-sm btn-success px-3 font-weight-bold">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center d-pag">
                    {{ $list_ujians->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('customScript')
    <script src="/assets/js/pagination.js"></script>
@endpush
