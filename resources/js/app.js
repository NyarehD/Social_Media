require('./bootstrap');
$(document).ready(function () {
    $(".toast").toast("show")
    $(".post-carousel").slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: false
    })
})
