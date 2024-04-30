<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="/assets/css/landing-page.css">
</head>

<body>
    <div class="header col-md-12 d-flex justify-content-around align-items-end">
        <div class="col-md-8">
            <div class="d-flex justify-content-start">
                <img class="img-fluid img-h my-2 mr-3" src="{{ asset('assets/img/logo.png') }}">
                <div class="t-header">
                    <span class="s-b">BIDIKSIBA </span><span class="s-p">POLINEMA</span>
                    <p class="p-header">Beasiswa Pendidikan Sekitar Bukit Asam Politeknik Negeri Malang
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <p id="realtime-clock" class="p-header p-time text-right"></p>
        </div>
    </div>
    <div class="p-sub-main"></div>
    <script>
        function updateRealTimeClock() {
            var now = new Date();
            var dayNames = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu"];
            var day = now.getDay();
            var date = now.getDate();
            var monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September",
                "Oktober", "November", "Desember"
            ];
            var month = now.getMonth();
            var year = now.getFullYear();
            var hours = now.getHours();
            var minutes = now.getMinutes();
            var seconds = now.getSeconds();

            var formattedTime = dayNames[day] + ', ' + date + ' ' + monthNames[month] + ' ' + year + ' ~ ' + hours + ':' + (
                minutes < 10 ? '0' : '') + minutes + ':' + (seconds < 10 ? '0' : '') + seconds;

            document.getElementById("realtime-clock").textContent = formattedTime;
        }

        updateRealTimeClock();

        setInterval(updateRealTimeClock, 1000);
    </script>
</body>

</html>
