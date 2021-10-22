require('./bootstrap');
$(document).ready(function () {
    $(".toast").toast("show")
    $(".post-carousel").slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: false,
        arrows: true,
        dots: false,
        infinite: false,
        left: true,
    })
    $(".show-post-carousel").slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: false,
        arrows: true,
        dots: true,
        infinite: false,
        left: true,
    })
})
