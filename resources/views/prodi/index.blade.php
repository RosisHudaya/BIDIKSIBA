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
                            <a class="btn btn-primary" href="{{ route('program-studi.create') }}">
                                <i class="fas fa-graduation-cap"></i> Tambah Program Studi
                            </a>
                        </div>
                        <div class="card-body">
                            <form id="search" method="GET" action="{{ route('program-studi.index') }}">
                                <div class="d-flex mb-3">
                                    <input type="text" name="name" class="form-control mr-2" id="name"
                                        placeholder="cari nama program studi..."
                                        value="{{ app('request')->input('name') }}">
                                    <button class="btn btn-primary mr-1 py-0 px-4" type="submit">Submit</button>
                                    <a class="btn btn-secondary py-2 px-4" href="{{ route('program-studi.index') }}">
                                        Reset
                                    </a>
                                </div>
                            </form>
                            <div class="table-responsive">
                                <table class="table table-bordered table-md">
                                    <tbody>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Jurusan</th>
                                            <th>Program Studi</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                        @foreach ($prodis as $key => $prodi)
                                            <tr>
                                                <td class="text-center">
                                                    {{ ($prodis->currentPage() - 1) * $prodis->perPage() + $key + 1 }}
                                                </td>
                                                <td>{{ $prodi->jurusan }}</td>
                                                <td>{{ $prodi->prodi }}</td>
                                                <td class="text-right">
                                                    <div class="d-flex justify-content-center">
                                                        <a href="{{ route('program-studi.edit', $prodi->id) }}"
                                                            class="btn btn-sm btn-info btn-icon "><i
                                                                class="fas fa-edit"></i>
                                                            Edit
                                                        </a>
                                                        <form action="{{ route('program-studi.destroy', $prodi->id) }}"
                                                            method="POST" class="ml-2">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-sm btn-danger btn-icon confirm-delete">
                                                                <i class="fas fa-times"></i> Delete </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center">
                                    {{ $prodis->withQueryString()->links() }}
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
            $('.import').click(function(event) {
                event.stopPropagation();
                $(".show-import").slideToggle("fast");
                $(".show-search").hide();
            });
            $('.search').click(function(event) {
                event.stopPropagation();
                $(".show-search").slideToggle("fast");
                $(".show-import").hide();
            });
            //ganti label berdasarkan nama file
            $('#file-upload').change(function() {
                var i = $(this).prev('label').clone();
                var file = $('#file-upload')[0].files[0].name;
                $(this).prev('label').text(file);
            });
        });
    </script>
@endpush

@push('customStyle')
    <script>
        function submitDel(id) {
            $('#del-' + id).submit()
        }

        function submitVeri(id) {
            $('#vel-' + id).submit()
        }
    </script>
@endpush
