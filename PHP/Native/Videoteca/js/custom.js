let pageContainerDivHeightPerc = 0.8;
let pageContainerDivTopPerc = 0.05;
let videotecaBlockDivHeightPerc = 0.8;
let videotecaBlockTopDiv = 0.025;
let videotecaBlockLeftDiv = 0.02;
let videoListContainerHeightDiv = 0.8;
let tdCellWidthPerc = 0.17;

$('.pageContainerDiv').height($(window).height() * pageContainerDivHeightPerc);
$('.pageContainerDiv').css('margin-top', $(window).height() * pageContainerDivTopPerc);
$('.videotecaBlockDiv').height($('.pageContainerDiv').height() * videotecaBlockDivHeightPerc);
$('.videotecaBlockDiv').css('margin-top', $('.pageContainerDiv').height() * videotecaBlockTopDiv);
$('.videotecaBlockDiv').css('margin-left', $('.pageContainerDiv').width() * videotecaBlockLeftDiv);
$('.videoListContainer').height($('.videotecaBlockDiv').height() * videoListContainerHeightDiv);
$('.tdCell').width($('.videoListContainer').width() * tdCellWidthPerc);

$('.resultDiv').on('click', function(){document.location.href = 'index.php';});

$('.actionSpan').on('click', function(){
    $('.selectActionField').val("");
    $('#idField').val($(this).attr('ref'));
    $('#modField').val($(this).attr('opRef'));
    if($(this).attr('opRef') == 'delete'){
        if(!confirm("Vuoi veramente rimuovere dalla lista questo video?")){
            return false;
        }
        $('#updateVideoForm').submit();
    }
    else{
        $('#changeFormBtn').val('Aggiorna');
        $('#changeFormBtn').css('background-color','orange');
        $('#changeFormBtn').css('color','darkblue');
        $('.actLabelDiv').html('Modifica record');
        $('.actLabelDiv').css('background-color','orange');
        $('#titleField').val($('#tdCellTitle_'+$(this).attr('ref')+'').html());
        $('#authorField').val($('#tdCellAuthor_'+$(this).attr('ref')+'').html());
        $('#yearField').val($('#tdCellYear_'+$(this).attr('ref')+'').html());
        $('#genreField').val($('#tdCellGenre_'+$(this).attr('ref')+'').html());
    }
});

$('.changeFormBtn').on("click", function(){
    if(!$('#modField').val()){$('#modField').val($(this).attr('ref'));}
    if(!($('#titleField').val() != '' & $('#authorField').val() != '' & $('#yearField').val() != '' & $('#genreField').val() != '')){
        alert("Compilare tutti i campi!");
        return false;
    }
    $('#updateVideoForm').submit();
});