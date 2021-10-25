require('./bootstrap');
$(document).ready(function () {
    $(".toast").toast("show")
    // Carousel for posts in newsfeed
    $(".post-carousel").slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: false,
        arrows: true,
        dots: false,
        infinite: false,
        left: true,
    })
    // Carousel for post show
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
