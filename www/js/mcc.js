function calendarMouseover(calEvent, jsEvent) {
    var tooltip = '<div class="tooltipevent">' +
                    '<strong>' + calEvent.title +  '</strong>' +
                    '<p>' + calEvent.channel + '</p>' +
                    '<p>' + calEvent.description + '</p>' +
                    '</div>';
    $("body").append(tooltip);
    $(this).mouseover(function(e) {
        $(this).css('z-index', 10000);
        $('.tooltipevent').fadeIn('500');
        $('.tooltipevent').fadeTo('10', 1.9);
    }).mousemove(function(e) {
        $('.tooltipevent').css('top', e.pageY + 10);
        $('.tooltipevent').css('left', e.pageX + 20);
    });
}

function calendarMouseout(calEvent, jsEvent) {
    $(this).css('z-index', 8);
    $('.tooltipevent').remove();
}

function calendarClick(calEvent, jsEvent, view)
{
    showProgramModal('/index.php/guide/detail?chanid=' + calEvent.chanid + '&starttime=' + encodeURIComponent(calEvent.starttime));
}

function showProgramModal(uri){
    console.log(uri);

    $.getJSON(uri, function(data){
        $('#programChannel').html(data['channel']);
        $('#programTitle').html(data['title']);
        $('#programSubtitle').html(data['subtitle']);
        $('#programTime').html(data['starttimeloc'] + " - " + data['endtimeloc']);
        $('#programRecStatus').html(data['recstatus']);
        $('#programDescription').html(data['description']);
    });
    
    $('#programDetailModal').modal();
}
