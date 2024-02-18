@extends('landing-page.app')
@section('title', 'BIDIKSIBA POLINEMA | Dashborad')
@push('style')
    <link rel="stylesheet" href="/assets/css/dashboard.css">
@endpush
@section('main')
    <div class="col-md-11 mx-auto mt-4">
        @if (auth()->user())
            @if ($biodatas?->id_user == null)
                <div class="alert alert-info">
                    <h6 class="m-0 p-0">
                        !!! Silahkan mengisi biodata anda di menu "BIODATA Pendaftar" !!!
                    </h6>
                </div>
            @elseif ($biodatas->status == 'Blm Diverifikasi')
                <div class="alert alert-danger">
                    <h6 class="m-0 p-0">"!!! ADA KESALAHAN DALAM PENGISIAN BIODATA !!!"</h6>
                </div>
            @elseif ($biodatas?->id_user != null && $biodatas?->status != 'Diverifikasi')
                @if (
                    $biodatas?->id_asal_jurusan != null &&
                        $biodatas?->id_jurusan != null &&
                        $biodatas?->id_prodi != null &&
                        $biodatas?->foto != null &&
                        $biodatas?->nik != null &&
                        $biodatas?->nama != null &&
                        $biodatas?->kota_lahir != null &&
                        $biodatas?->tgl_lahir != null &&
                        $biodatas?->gender != null &&
                        $biodatas?->no_telp != null &&
                        $biodatas?->nisn != null &&
                        $biodatas?->asal_sekolah != null)
                    <div class="alert alert-warning" id="warning-alert">
                        <h6 class="m-0 p-0">
                            "DATA SUDAH LENGKAP" | sedang menunggu proses verifikasi oleh admin...
                        </h6>
                    </div>
                @else
                    <div class="alert alert-warning">
                        <h6 class="m-0 p-0">
                            !!! Silahkan melengkapi keseluruhan data pada formulir yang ada di menu "BIODATA Pendaftar" !!!
                        </h6>
                    </div>
                @endif
            @else
                <div class="alert alert-success" id="success-alert">
                    <h6 class="m-0 p-0">
                        Data BIODATA PENDAFTAR telah diverifikasi admin, silahkan cek token dan password ujian di menu
                        "lihat TOKEN" !!!
                    </h6>
                </div>
            @endif
        @endif
    </div>
    <div class="col-md-11 d-flex mx-auto info mb-4">
        <span class="s-info py-2 px-3">UPDATE INFO</span>
        <marquee class="m-desc py-2">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam distinctio beatae consectetur vel
            perferendis, enim itaque, dolor, eveniet unde nihil alias quos eius nulla autem hic nobis. Ducimus, commodi.
            Quam aliquid nihil tempore, nostrum placeat ducimus. Quibusdam neque explicabo quod ut facilis temporibus ea
            magni eum ullam quisquam, tenetur esse, corrupti delectus. Sunt sint porro modi magnam laborum? Perspiciatis
            laboriosam voluptate dolor, maiores architecto nam eius voluptatibus vel sed dolore amet numquam voluptates qui
            recusandae. Ipsum minima corrupti repellat, iusto et assumenda natus animi cupiditate voluptatibus in mollitia
            quia reiciendis impedit, ea dolores? Sequi mollitia reprehenderit similique cum eligendi soluta?
        </marquee>
    </div>
    <div class="d-flex col-md-11 mx-auto text-justify">
        <div class="col-md-8 p-0">
            <p class="p-main-title mb-0 py-1 px-3">TINJAUAN SINGKAT</p>
            <p class="p-main py-1 px-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore vel nihil, placeat
                mollitia consectetur tempora distinctio ut? Voluptates voluptatibus tenetur impedit unde ipsa mollitia
                perferendis! Voluptatem id harum libero, ipsam, maxime tenetur molestiae quisquam quo quia, nihil dolore
                laboriosam deleniti unde. Nisi praesentium inventore ipsa nesciunt neque enim debitis facere. Assumenda
                praesentium, dignissimos illum sed eos unde eaque odit mollitia reprehenderit iste consectetur! Veniam velit
                ipsam nulla laudantium, vitae illum aliquam sapiente, quis expedita voluptate quos doloribus? Dicta
                similique non saepe, facere iure fuga tenetur aut perspiciatis? Placeat mollitia delectus id. Optio hic,
                sunt, veniam doloremque quo dicta accusantium id repellat quas nesciunt corrupti tempore eveniet adipisci
                saepe sed fuga? Libero fuga modi ut ipsa incidunt nulla expedita vel nihil quaerat neque soluta dolore
                praesentium cum illum itaque maiores dicta est architecto, sunt rerum ratione repellendus. Dicta tenetur
                excepturi culpa quidem, iure nemo quis ut reiciendis atque ducimus. Architecto quos exercitationem aperiam
                quod fugit, laboriosam sequi laudantium assumenda tenetur? Nemo odio reiciendis ab laborum enim nobis minima
                consectetur. Ea sequi in, architecto a ipsum temporibus eaque, nisi earum inventore maiores at reiciendis.
                Aperiam, exercitationem ut ipsa est quam architecto alias, quibusdam distinctio praesentium porro facere
                totam doloribus beatae eligendi provident nulla hic esse a. Quasi expedita illum maxime dicta sapiente rerum
                minus ducimus fugit placeat, aperiam asperiores itaque deserunt enim consequatur, ipsam non quo. Animi
                dolorem tempore minus ab exercitationem nam dolor soluta non sit ex architecto quae vel modi libero
                corporis, similique officia. Error, deleniti id nihil consequuntur tempore vero sit unde sunt placeat
                exercitationem, nemo similique dolorem ea necessitatibus eos ab, corrupti illum iste! Facere repudiandae,
                quis repellat assumenda ipsam recusandae, in ut eum eligendi alias nam dolore voluptate soluta. Quaerat
                dolore fuga fugit facilis reprehenderit est nesciunt natus culpa, assumenda deleniti, optio repellat, ab
                magnam perferendis iste! Commodi, praesentium porro! Impedit laboriosam id, sint dolorum sequi nobis nisi
                eligendi totam, culpa quidem at ex temporibus nemo aspernatur vel perferendis amet quibusdam. Optio facere
                illo dicta, adipisci, doloribus soluta ea deserunt suscipit deleniti dolore quidem, esse quasi? Voluptatum,
                consequuntur accusantium! Dolor quae totam esse similique impedit sequi est inventore voluptas aut sit
                molestiae ipsa quam sint nesciunt dicta odio debitis animi, dolores alias quasi beatae corrupti laboriosam.
                Aperiam cumque laudantium, fuga a voluptate facilis provident ut temporibus nam nisi eos vel? Asperiores,
                sunt itaque voluptatibus necessitatibus aspernatur vitae natus. Esse similique consectetur molestias
                voluptate, impedit aspernatur, ea error, quam possimus eligendi sunt. Repellat quas minima quo obcaecati
                neque veniam, est, pariatur dolorem illum consequatur exercitationem quos error assumenda incidunt earum
                reiciendis ducimus. Reiciendis illo odio deleniti voluptate eaque odit minima nihil. Eveniet mollitia,
                facilis aperiam quos consequatur cumque fuga dignissimos quibusdam eos culpa vel vero consequuntur rerum,
                sequi explicabo minus maxime est possimus! Laboriosam dolorem natus provident maxime unde laudantium,
                consequuntur eligendi et tenetur fugiat, possimus distinctio, at ipsum officiis vero ipsam cum? Explicabo,
                perferendis quo facilis, vitae saepe doloribus accusantium dicta minima vel necessitatibus quas veniam
                deleniti velit. Tempore accusantium sit repellendus omnis, est quasi necessitatibus pariatur.
            </p>
        </div>
        <div class="col-md-4 pr-0">
            <p class="p-sub-title mb-0 py-1 px-3 text-center">INFORMASI</p>
            <div class="p-sub py-1 p-2 my-2">
                <hr>
                <div class="d-flex">
                    <img class="img-fluid img-h mr-3" src="{{ asset('assets/img/logo.png') }}">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo dicta autem eaque velit
                        voluptate! Impedit at mollitia repellat doloremque eius necessitatibus quaerat magnam, in quia.
                    </p>
                </div>
                <hr class="mt-0">
            </div>
            <div class="p-sub py-1 p-2 my-2">
                <hr>
                <div class="d-flex">
                    <img class="img-fluid img-h mr-3" src="{{ asset('assets/img/logo.png') }}">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo dicta autem eaque velit
                        voluptate! Impedit at mollitia repellat doloremque eius necessitatibus quaerat magnam, in quia.
                    </p>
                </div>
                <hr class="mt-0">
            </div>
            <div class="p-sub py-1 p-2 my-2">
                <hr>
                <div class="d-flex">
                    <img class="img-fluid img-h mr-3" src="{{ asset('assets/img/logo.png') }}">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo dicta autem eaque velit
                        voluptate! Impedit at mollitia repellat doloremque eius necessitatibus quaerat magnam, in quia.
                    </p>
                </div>
                <hr class="mt-0">
            </div>
        </div>
    </div>
@endsection

@push('customScript')
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $("#success-alert").fadeOut('slow');
            }, 5000);
        });
        $(document).ready(function() {
            setTimeout(function() {
                $("#warning-alert").fadeOut('slow');
            }, 5000);
        });
    </script>
@endpush
