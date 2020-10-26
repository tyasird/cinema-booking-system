$(document).ready(function () {


    $('#select_location').on('change', function () {
        $(".listShowtimes ul").empty();
        var $locationID = $(this).val();
        var $movieID = $(this).data("movie_id")
        if ($locationID && $movieID) {
            $('.listShowtimes').show()
            $.ajax({
                type: 'POST',
                url: 'actions?action=get_showtimes',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {'movieID': $movieID, 'locationID': $locationID},
                success: function (res) {
                    r = jQuery.parseJSON(res)
                    if (r.result == 1) {
                        var dd = null
                        var dt = new Date();
                        var aa = dt.getDate() + "-" + dt.getMonth() + 1;
                        $.each(r.showtimes, function (k, v) {
                            //var bb = v.movie_time.substring(0,10)
                            //v.movie_time.substring(11, 16)
                            $(".listShowtimes ul").append('<li><a href="do_selection?showtimeID=' + v.id + '">' + v.movie_time.substring(11, 16) + ' / ' + v.movie_time.substring(0, 10) + '</a></li>');
                        })
                    } else {
                        $.notify({message: r.message}, {type: 'danger', delay: 2000});
                    }
                }
            })

        }

        return false;
    });


    $('#do_reservation').submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'actions?action=do_reservation',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: $('#do_reservation').serialize(),
            success: function (res) {
                r = jQuery.parseJSON(res)
                if (r.result == 1) {
                    window.location = 'show_ticket'
                } else {
                    $.notify({message: r.message}, {type: 'danger', delay: 2000});
                }
            }
        })

    })




    addEventListener("load", function () {
        setTimeout(hideURLbar, 0);
    }, false);

    function hideURLbar() {
        window.scrollTo(0, 1);
    }

    $('.popup-with-zoom-anim').magnificPopup({
        type: 'inline',
        fixedContentPos: false,
        fixedBgPos: true,
        overflowY: 'auto',
        closeBtnInside: true,
        preloader: false,
        midClick: true,
        removalDelay: 300,
        mainClass: 'my-mfp-zoom-in'
    });


    $("#flexiselDemo1").flexisel({
        visibleItems: 6,
        animationSpeed: 1000,
        autoPlay: true,
        autoPlaySpeed: 1000,
        pauseOnHover: false,
        enableResponsiveBreakpoints: true,
        responsiveBreakpoints: {
            portrait: {
                changePoint: 480,
                visibleItems: 2
            },
            landscape: {
                changePoint: 640,
                visibleItems: 3
            },
            tablet: {
                changePoint: 768,
                visibleItems: 4
            }
        }
    });


})