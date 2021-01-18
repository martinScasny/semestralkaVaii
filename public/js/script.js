var headerBg = document.getElementById('bg');
window.addEventListener('scroll', function () {
    headerBg.style.opacity = 1 - +window.pageYOffset / 550 + ''
    headerBg.style.backgroundPositionY = - +window.pageYOffset/2+'px'
})

var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

$(document).on('click', '#imageClick', (event) => {
    var target = $(event.target);
    console.log(target.html());
    var request = $.get('const/' + target.html());


    request.done(function(response) {
        $('.appendDiv').empty();
        var elementInfo = $("<div/>");
        elementInfo.html((response)['info']);
        $(".appendDiv").css("border","1px solid #faebd71f");
        $(document).find('.appendDiv').append(elementInfo);

        var elementStars = $(".starsText");
        var stringTemp = 'Najjasnejšie hviezdy sú: ';
        stringTemp += (response)['stars'];
        elementStars.html(stringTemp);

    });
});

