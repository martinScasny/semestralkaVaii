window.onscroll = changePos;

function changePos() {
    var header = document.getElementById("top");
    if (window.pageYOffset > 70) {
        header.style.position = "absolute";
        header.style.top = pageYOffset + "px";
    } else {
        header.style.position = "";
        header.style.top = "";
    }
}
$(function () {
    $(document).scroll(function () {
        var $nav = $(".navbar-dark");
        $nav.toggleClass('scrolled', $(this).scrollTop() > $nav.height());
    });
});
