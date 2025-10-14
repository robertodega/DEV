$('.dataTableDiv').height($(window).height() * 0.6);
$('.datatd').width($(window).width() * 0.2);
$('.datatd').height($(window).height() * 0.08);
$('.datatdErr').width($('.dataTable').width());
$('.formField').width($(window).width() * 0.2);

$('.editableData').on('click', function() {
    $(this).attr('contenteditable', 'true');
    var formName = "updateRowForm";
    $(this).on('blur', function () {

        var rowId = $(this).attr('refId');

        $('#refId').val($('#subject_' + rowId).attr('refId'));
        $('#subject').val($('#subject_' + rowId).text());
        $('#username').val($('#username_' + rowId).text());
        $('#password').val($('#password_' + rowId).text());
        $('#note').val($('#note_' + rowId).text());
        if (formName) {$('#' + formName).submit();}
    });
});

function deleteRow(id) {
    if (confirm("Are you sure you want to delete this row?")) {
        $.ajax({
            url: './?action=delete&refId=' + id,
            type: 'POST',
            success: function(response) {
                
            },
            error: function(xhr, status, error) {
                alert('Error deleting row: ' + error);
            }
        });
    }
    document.location.reload();
}