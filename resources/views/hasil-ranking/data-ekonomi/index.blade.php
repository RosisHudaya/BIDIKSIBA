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
                            <a class="btn btn-success" href="{{ route('export.alternative') }}">
                                <i class="fas fa-file-csv"></i> Export
                            </a>
                        </div>
                        <div class="card-body">
                            <form id="search" method="GET" action="{{ route('menu-ranking.data-ekonomi') }}">
                                <div class="d-flex mb-3 d-search">
                                    <input type="text" name="name" class="form-control mr-2 d-input" id="name"
                                        placeholder="cari nama siswa" value="{{ app('request')->input('name') }}">
                                    <button class="btn btn-primary mr-1 ml-2 py-0 px-4 d-submit" type="submit">
                                        Submit
                                    </button>
                                    <a class="btn btn-secondary py-2 px-4" href="{{ route('menu-ranking.data-ekonomi') }}">
                                        Reset
                                    </a>
                                </div>
                            </form>
                            <div class="table-responsive">
                                <table class="table table-bordered table-md">
                                    <tbody>
                                        <tr>
                                            <th class="text-center align-middle" style="width: 5%;">#</th>
                                            <th class="align-middle" style="width: 25%;">NAMA</th>
                                            <th class="align-middle" style="width: 25%;">ASAL SEKOLAH</th>
                                            <th class="align-middle" style="width: 15%;">POINT</th>
                                            <th colspan="2" class="align-middle text-center" style="width: 20%;">
                                                RANKING
                                            </th>
                                        </tr>
                                        @foreach ($results as $key => $result)
                                            <tr>
                                                <td class="text-center">
                                                    {{ ($results->currentPage() - 1) * $results->perPage() + $key + 1 }}
                                                </td>
                                                <td style="text-transform: uppercase;">{{ $result['nama'] }}</td>
                                                <td style="text-transform: uppercase;">{{ $result['sekolah'] }}</td>
                                                <td>{{ $result['difference'] }}</td>
                                                <td class="text-center" style="width: 10%;">
                                                    {{ $result['rank'] }}
                                                </td>
                                                <td class="text-center" style="width: 10%;">
                                                    <a class="btn btn-sm btn-secondary ml-2 detail"
                                                        data-id="{{ $result['id'] }}">
                                                        <i class="fas fa-angle-double-down"
                                                            id="toggle-icon-{{ $result['id'] }}">
                                                        </i>
                                                    </a>
                                                </td>
                                            </tr>
                                            @include('hasil-ranking.data-ekonomi.detail')
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-center d-pag">
                                {{ $results->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('customScript')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
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
                }
            });
        });
    </script>
    <script src="/assets/js/pagination.js"></script>
@endpush
