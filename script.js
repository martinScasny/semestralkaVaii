$(function () {
    $(document).scroll(function () {
        var $nav = $(".navbar-dark");
        $nav.toggleClass('scrolled', $(this).scrollTop() > $nav.height());
    });
});
