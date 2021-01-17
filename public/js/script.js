


var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

$(document).on('click', '#imageClick', (event) => {
    var target = $(event.target);
    console.log(target.html());
    var request = $.get('const/' + target.html());


    request.done(function(response) {
        $('.appendDiv').empty();
        var element = $("<div/>");
        element.className = 'col-6 offset-3';
        element.html((response)['info']);
        $(document).find('.appendDiv').append(element);
    });
});

