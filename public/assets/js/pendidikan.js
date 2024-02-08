$(document).ready(function () {
    $("#asal_jurusan_id").change(function () {
        if ($(this).val() == "") {
            $("#jurusan_id").attr("disabled", true);
        } else {
            $("#jurusan_id").removeAttr("disabled", false);
        }

        var asalJurusanId = $(this).val();
        $.ajax({
            url: getJurusansRoute,
            type: "GET",
            data: {
                asal_jurusan_id: asalJurusanId,
            },
            success: function (response) {
                $("#jurusan_id").html(
                    '<option value="">-- Pilih jurusan --</option>'
                );
                $.each(response.jurusans, function (key, jurusan) {
                    $("#jurusan_id").append(
                        '<option value="' +
                            jurusan.id +
                            '">' +
                            jurusan.jurusan +
                            "</option>"
                    );
                });
            },
            error: function (xhr) {
                console.log(xhr.responseText);
            },
        });
    });
});

$(document).ready(function () {
    $("#jurusan_id").change(function () {
        if ($(this).val() == "") {
            $("#prodi_id").attr("disabled", true);
        } else {
            $("#prodi_id").removeAttr("disabled", false);
        }

        var jurusanId = $(this).val();
        $.ajax({
            url: getProdisRoute,
            type: "GET",
            data: {
                jurusan_id: jurusanId,
            },
            success: function (response) {
                $("#prodi_id").html(
                    '<option value="">-- Pilih program studi --</option>'
                );
                $.each(response.prodis, function (key, prodi) {
                    $("#prodi_id").append(
                        '<option value="' +
                            prodi.id +
                            '">' +
                            prodi.prodi +
                            "</option>"
                    );
                });
            },
            error: function (xhr) {
                console.log(xhr.responseText);
            },
        });
    });
});
