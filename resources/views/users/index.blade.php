@extends('layouts.app')

@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>User List</h1>
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
                            <a class="btn btn-primary" href="{{ route('user.create') }}">
                                <i class="fas fa-user-plus"></i> Tambah User
                            </a>
                        </div>
                        <div class="card-body">
                            <form id="search" method="GET" action="{{ route('user.index') }}">
                                <div class="d-flex mb-3">
                                    <input type="text" name="name" class="form-control mr-2" id="name"
                                        placeholder="cari nama..." value="{{ app('request')->input('name') }}">
                                    <button class="btn btn-primary mr-1 py-0 px-4" type="submit">Submit</button>
                                    <a class="btn btn-secondary py-2 px-4" href="{{ route('user.index') }}">Reset</a>
                                </div>
                            </form>
                            <div class="table-responsive">
                                <table class="table table-bordered table-md">
                                    <tbody>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th class="text-center">Akun</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                        @foreach ($users as $key => $user)
                                            <tr>
                                                <td>{{ ($users->currentPage() - 1) * $users->perPage() + $key + 1 }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>
                                                    @foreach ($user->roles as $role)
                                                        {{ $role->name }}
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        @if (is_null($user->email_verified_at))
                                                            <form
                                                                action="{{ route('user.verify-email', ['id' => $user->id, 'hash' => sha1($user->email)]) }}"
                                                                method="POST" class="d-inline-block"
                                                                id="vel-<?= $user->id ?>">
                                                                @csrf
                                                                <button type="submit" class="btn btn-sm btn-primary px-3"
                                                                    data-confirm="Aktifkan Akun User | Apakah kamu yakin meaktifkan akun user ?"
                                                                    data-confirm-yes="submitVeri(<?= $user->id ?>)"
                                                                    data-id="vel-{{ $user->id }}">Aktifkan akun
                                                                </button>
                                                            </form>
                                                        @else
                                                            <form
                                                                action="{{ route('user.verify-email', ['id' => $user->id, 'hash' => sha1($user->email)]) }}"
                                                                method="POST" class="d-inline-block"
                                                                id="vel-<?= $user->id ?>">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-light"
                                                                    data-confirm="Nonaktifkan Akun User |Apakah kamu yakin menonatifkan akun user ?"
                                                                    data-confirm-yes="submitVeri(<?= $user->id ?>)"
                                                                    data-id="vel-{{ $user->id }}">Nonaktifkan akun
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td class="text-right">
                                                    <div class="d-flex justify-content-center">
                                                        <a href="{{ route('user.edit', $user->id) }}"
                                                            class="btn btn-sm btn-info btn-icon "><i
                                                                class="fas fa-edit"></i> Edit
                                                        </a>
                                                        <form action="{{ route('user.destroy', $user->id) }}"
                                                            method="POST" class="ml-2">
                                                            {{-- <input type="hidden" name="_method" value="DELETE">
                                                            <input type="hidden" name="_token"
                                                                value="{{ csrf_token() }}"> --}}
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
                                    {{ $users->withQueryString()->links() }}
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
