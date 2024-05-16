@extends('layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Matriks Perbandingan Pasangan</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    @include('layouts.alert')
                </div>
            </div>
            <div class="card">
                <form action="{{ route('update.matriks') }}" method="POST">
                    <div class="card-header">
                        <h4 class="h-bobot">List Matriks Perbandingan Pasangan</h4>
                    </div>
                    <div class="card-body">
                        @csrf
                        @method('PUT')
                        <div class="col-md-12 d-flex m-0 p-0">
                            <p class="col-md-10 p-bobot text-uppercase">Pekerjaan Orang Tua</p>
                            <div class="text-right p-bobot"><span class="span-bobot">|</span>
                                <a class="btn btn-sm btn-secondary ml-2 detail-pekerjaan"
                                    data-id="{{ $bobot_pekerjaan->id }}">
                                    <i class="fas fa-angle-double-down"
                                        id="toggle-icon-pekerjaan{{ $bobot_pekerjaan->id }}"></i>
                                </a>
                            </div>
                        </div>
                        <hr class="mt-0">
                        @include('hasil-ranking.bobot-kriteria.bobot_pekerjaan')
                        <div class="col-md-12 d-flex m-0 p-0">
                            <p class="col-md-10 p-bobot text-uppercase">Penghasilan Orang Tua</p>
                            <div class="text-right p-bobot"><span class="span-bobot">|</span>
                                <a class="btn btn-sm btn-secondary ml-2 detail-penghasilan"
                                    data-id="{{ $bobot_penghasilan->id }}">
                                    <i class="fas fa-angle-double-down"
                                        id="toggle-icon-penghasilan{{ $bobot_penghasilan->id }}">
                                    </i>
                                </a>
                            </div>
                        </div>
                        <hr class="mt-0">
                        @include('hasil-ranking.bobot-kriteria.bobot_penghasilan')
                        <div class="col-md-12 d-flex m-0 p-0">
                            <p class="col-md-10 p-bobot text-uppercase">Luas Tanah</p>
                            <div class="text-right p-bobot"><span class="span-bobot">|</span>
                                <a class="btn btn-sm btn-secondary ml-2 detail-tanah" data-id="{{ $bobot_tanah->id }}">
                                    <i class="fas fa-angle-double-down" id="toggle-icon-tanah{{ $bobot_tanah->id }}"></i>
                                </a>
                            </div>
                        </div>
                        <hr class="mt-0">
                        @include('hasil-ranking.bobot-kriteria.bobot_tanah')
                        <div class="col-md-12 d-flex m-0 p-0">
                            <p class="col-md-10 p-bobot text-uppercase">Jumlah Kamar</p>
                            <div class="text-right p-bobot"><span class="span-bobot">|</span>
                                <a class="btn btn-sm btn-secondary ml-2 detail-kamar" data-id="{{ $bobot_kamar->id }}">
                                    <i class="fas fa-angle-double-down" id="toggle-icon-kamar{{ $bobot_kamar->id }}"></i>
                                </a>
                            </div>
                        </div>
                        <hr class="mt-0">
                        @include('hasil-ranking.bobot-kriteria.bobot_kamar')
                        <div class="col-md-12 d-flex m-0 p-0">
                            <p class="col-md-10 p-bobot text-uppercase">Kepemilikan Kamar Mandi</p>
                            <div class="text-right p-bobot"><span class="span-bobot">|</span>
                                <a class="btn btn-sm btn-secondary ml-2 detail-kamar-mandi"
                                    data-id="{{ $bobot_kamar_mandi->id }}">
                                    <i class="fas fa-angle-double-down"
                                        id="toggle-icon-kamar-mandi{{ $bobot_kamar_mandi->id }}"></i>
                                </a>
                            </div>
                        </div>
                        <hr class="mt-0">
                        @include('hasil-ranking.bobot-kriteria.bobot_kamar_mandi')
                        <div class="col-md-12 d-flex m-0 p-0">
                            <p class="col-md-10 p-bobot text-uppercase">Tagihan Listrik</p>
                            <div class="text-right p-bobot"><span class="span-bobot">|</span>
                                <a class="btn btn-sm btn-secondary ml-2 detail-listrik" data-id="{{ $bobot_listrik->id }}">
                                    <i class="fas fa-angle-double-down"
                                        id="toggle-icon-listrik{{ $bobot_listrik->id }}"></i>
                                </a>
                            </div>
                        </div>
                        <hr class="mt-0">
                        @include('hasil-ranking.bobot-kriteria.bobot_listrik')
                        <div class="col-md-12 d-flex m-0 p-0">
                            <p class="col-md-10 p-bobot text-uppercase">Jumlah Hutang</p>
                            <div class="text-right p-bobot"><span class="span-bobot">|</span>
                                <a class="btn btn-sm btn-secondary ml-2 detail-hutang" data-id="{{ $bobot_hutang->id }}">
                                    <i class="fas fa-angle-double-down" id="toggle-icon-hutang{{ $bobot_hutang->id }}"></i>
                                </a>
                            </div>
                        </div>
                        <hr class="mt-0">
                        @include('hasil-ranking.bobot-kriteria.bobot_hutang')
                        <div class="col-md-12 d-flex m-0 p-0">
                            <p class="col-md-10 p-bobot text-uppercase">Jumlah Saudara</p>
                            <div class="text-right p-bobot"><span class="span-bobot">|</span>
                                <a class="btn btn-sm btn-secondary ml-2 detail-saudara" data-id="{{ $bobot_saudara->id }}">
                                    <i class="fas fa-angle-double-down"
                                        id="toggle-icon-saudara{{ $bobot_saudara->id }}"></i>
                                </a>
                            </div>
                        </div>
                        <hr class="mt-0">
                        @include('hasil-ranking.bobot-kriteria.bobot_saudara')
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-success">Hitung Bobot</button>
                        <a class="btn btn-secondary" href="{{ route('bobot-kriteria.index') }}">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@push('customStyle')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
@endpush

@push('customScript')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.detail-pekerjaan').click(function() {
                var pekerjaanId = $(this).data('id');
                $('.show-pekerjaan-' + pekerjaanId).toggle();
                $('#toggle-icon-pekerjaan' + pekerjaanId).toggleClass(
                    'fa-angle-double-down fa-angle-double-up');
            });
        });

        $(document).ready(function() {
            $('.detail-penghasilan').click(function() {
                var penghasilanId = $(this).data('id');
                $('.show-penghasilan-' + penghasilanId).toggle();
                $('#toggle-icon-penghasilan' + penghasilanId).toggleClass(
                    'fa-angle-double-down fa-angle-double-up');
            });
        });

        $(document).ready(function() {
            $('.detail-tanah').click(function() {
                var tanahId = $(this).data('id');
                $('.show-tanah-' + tanahId).toggle();
                $('#toggle-icon-tanah' + tanahId).toggleClass(
                    'fa-angle-double-down fa-angle-double-up');
            });
        });

        $(document).ready(function() {
            $('.detail-kamar').click(function() {
                var kamarId = $(this).data('id');
                $('.show-kamar-' + kamarId).toggle();
                $('#toggle-icon-kamar' + kamarId).toggleClass(
                    'fa-angle-double-down fa-angle-double-up');
            });
        });

        $(document).ready(function() {
            $('.detail-kamar-mandi').click(function() {
                var kamar_mandiId = $(this).data('id');
                $('.show-kamar-mandi-' + kamar_mandiId).toggle();
                $('#toggle-icon-kamar-mandi' + kamar_mandiId).toggleClass(
                    'fa-angle-double-down fa-angle-double-up');
            });
        });

        $(document).ready(function() {
            $('.detail-listrik').click(function() {
                var listrikId = $(this).data('id');
                $('.show-listrik-' + listrikId).toggle();
                $('#toggle-icon-listrik' + listrikId).toggleClass(
                    'fa-angle-double-down fa-angle-double-up');
            });
        });

        $(document).ready(function() {
            $('.detail-hutang').click(function() {
                var hutangId = $(this).data('id');
                $('.show-hutang-' + hutangId).toggle();
                $('#toggle-icon-hutang' + hutangId).toggleClass(
                    'fa-angle-double-down fa-angle-double-up');
            });
        });

        $(document).ready(function() {
            $('.detail-saudara').click(function() {
                var saudaraId = $(this).data('id');
                $('.show-saudara-' + saudaraId).toggle();
                $('#toggle-icon-saudara' + saudaraId).toggleClass(
                    'fa-angle-double-down fa-angle-double-up');
            });
        });
    </script>
@endpush
