function PopupCenter(url, title, w, h) {
    // Fixes dual-screen position                         Most browsers      Firefox
    var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : window.screenX;
    var dualScreenTop = window.screenTop != undefined ? window.screenTop : window.screenY;

    var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
    var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

    var left = ((width / 2) - (w / 2)) + dualScreenLeft;
    var top = ((height / 2) - (h / 2)) + dualScreenTop;
    var newWindow = window.open(url, title, 'scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

    // Puts focus on the newWindow
    if (window.focus) {
        newWindow.focus();
    }
}

$(document).ready(function () {


    if (window.location.hash === '#1') {
        $.notify({message: "Film başarılı şekilde eklendi."}, {type: 'info', delay: 1000});
    }

    if (window.location.hash === '#2') {
        $.notify({message: "Seans başarılı şekilde eklendi."}, {type: 'info', delay: 1000});
    }

    if (window.location.hash === '#3') {
        $.notify({message: "Film başarılı şekilde düzenlendi."}, {type: 'info', delay: 1000});
    }

    if (window.location.hash === '#4') {
        $.notify({message: "Seans başarılı şekilde düzenlendi."}, {type: 'info', delay: 1000});
    }

    $.datetimepicker.setLocale('tr');
    jQuery('#datetimepicker').datetimepicker({
        inline: true,
        step: 15,
        format: 'Y-m-d H:i',
        onChangeDateTime: function (dp, $input) {
            $('input[name=movie_time]').val($input.val())
        }
    });

    jQuery('#datetimepicker2').datetimepicker({
        inline: false,
        step: 30,
        format: 'Y-m-d',
        timepicker:false,

        onChangeDateTime: function (dp, $input) {
            $('input[name=search]').val($input.val())
        }
    });


    $('#add_movies').submit(function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: 'admin_actions?action=add_movies',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: $(this).serialize(),
            success: function (res) {
                console.log(res)
                r = jQuery.parseJSON(res)
                if (r.result == 1) {
                    window.location.href = "movies#1";
                } else {
                    $.notify({message: r.message}, {type: 'danger', timer: 2000});

                }
            },
        });
    })


    $('#add_showtimes').submit(function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: 'admin_actions?action=add_showtimes',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: $(this).serialize(),
            success: function (res) {
                console.log(res)
                r = jQuery.parseJSON(res)
                if (r.result == 1) {
                    window.location.href = "showtimes#1";
                } else {
                    $.notify({message: r.message}, {type: 'danger', timer: 2000});
                }
            },
        });
    })

    $('#edit_movies').submit(function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: 'admin_actions?action=edit_movies',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: $(this).serialize(),
            success: function (res) {
                console.log(res)
                r = jQuery.parseJSON(res)
                if (r.result == 1) {
                    window.location.href = "movies#3";
                } else {
                    $.notify({message: r.message}, {type: 'danger', timer: 2000});

                }
            },
        });
    })


    $('#edit_showtimes').submit(function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: 'admin_actions?action=edit_showtimes',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: $(this).serialize(),
            success: function (res) {
                console.log(res)
                r = jQuery.parseJSON(res)
                if (r.result == 1) {
                    window.location.href = "showtimes#4";
                } else {
                    $.notify({message: r.message}, {type: 'danger', timer: 2000});

                }
            },
        });
    })


    $('.delete_movies').click(function (e) {

        var movieid = $(this).data("movieid")
        $(this).closest('tr').remove();
        $.ajax({
            type: "POST",
            url: 'admin_actions?action=delete_movies',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {'id': movieid},
            success: function (res) {
                r = jQuery.parseJSON(res)
                if (r.result == 1) {
                    $.notify({message: "Film silindi."}, {type: 'info', delay: 1000});
                } else {
                    $.notify({message: r.message}, {type: 'danger', timer: 2000});
                }
            },
        });
    })


    $('.delete_showtimes').click(function (e) {

        var showtimeid = $(this).data("showtimeid")
        $(this).closest('tr').remove();
        $.ajax({
            type: "POST",
            url: 'admin_actions?action=delete_showtimes',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {'id': showtimeid},
            success: function (res) {
                r = jQuery.parseJSON(res)
                if (r.result == 1) {
                    $.notify({message: "Seans silindi."}, {type: 'info', delay: 1000});
                } else {
                    $.notify({message: r.message}, {type: 'danger', timer: 2000});
                }
            },
        });
    })


    $('.delete_reservations').click(function (e) {

        var reservationid = $(this).data("reservationid")
        $(this).closest('tr').remove();
        $.ajax({
            type: "POST",
            url: 'admin_actions?action=delete_reservations',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {'id': reservationid},
            success: function (res) {
                console.log(res)
                r = jQuery.parseJSON(res)
                if (r.result == 1) {
                    $.notify({message: "Rezervasyon silindi."}, {type: 'info', delay: 1000});
                } else {
                    $.notify({message: r.message}, {type: 'danger', timer: 2000});
                }
            },
        });
    })


    $('.delete_sales').click(function (e) {

        var saleid = $(this).data("saleid")
        $(this).closest('tr').remove();
        $.ajax({
            type: "POST",
            url: 'admin_actions?action=delete_sales',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {'id': saleid},
            success: function (res) {
                r = jQuery.parseJSON(res)
                if (r.result == 1) {
                    $.notify({message: "Satış Silindi."}, {type: 'info', delay: 1000});
                } else {
                    $.notify({message: r.message}, {type: 'danger', timer: 2000});
                }
            },
        });
    })

    $('.cancel_sales').click(function (e) {

        var saleid = $(this).data("saleid")
        $(this).closest('tr').remove();
        $.ajax({
            type: "POST",
            url: 'admin_actions?action=cancel_sales',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {'id': saleid},
            success: function (res) {
                r = jQuery.parseJSON(res)
                if (r.result == 1) {
                    $.notify({message: "Satış İptal Edildi."}, {type: 'info', delay: 1000});
                } else {
                    $.notify({message: r.message}, {type: 'danger', timer: 2000});
                }
            },
        });
    })


    $(':file').on('change', function () {
        $.ajax({
            url: 'admin_actions?action=upload_image',
            type: 'POST',
            data: new FormData($('form')[0]),
            cache: false,
            contentType: false,
            processData: false,
            xhr: function () {
                var myXhr = $.ajaxSettings.xhr();
                if (myXhr.upload) {
                    myXhr.upload.addEventListener('progress', function (e) {
                        if (e.lengthComputable) {
                            $('progress').attr({
                                value: e.loaded,
                                max: e.total,
                            });
                        }
                    }, false);
                }
                return myXhr;
            },
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (data) {
                console.log(data);
                r = jQuery.parseJSON(data)
                if (r.result == 1) {
                    $('img.movie_poster').attr('src', '../uploads/' + r.newfilename)
                    $('input[name="movie_poster"]').val(r.newfilename)
                }
            },

        });

    });


});