<h1>Hallo ini adalah HALAMAN LIST UJIAN Pendaftar</h1>
<form action="{{ route('logout.ujian') }}" method="post">
    @csrf
    <button class="btn btn-danger" type="submit">Logout</button>
</form>
