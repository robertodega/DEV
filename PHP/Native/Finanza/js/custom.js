function contentFill(divName, divContentPath) {
    $('#' + divName).val(divContentPath);
    //  alert(divContentPath);
    $('#financeForm').submit();
}

$('.loginBtn').on('click', function () {
    if ($('#username').val() == '' || $('#password').val() == '') {
        if ($('#username').val() == '') {
            $('#username').addClass('errorField');
        }
        if ($('#password').val() == '') {
            $('#password').addClass('errorField');
        }
        alert('Please fill in all fields.');
        return;
    }
    $('#loginAction').val($(this).attr('actionRef'));
    $('#loginForm').submit();
});

$('#registerBtn').on('click', function () {
    $('#registerFormDiv').fadeIn(1000);
});

$('#registerActBtn').on('click', function () {
    $('#userManagerAction').val($(this).attr('actionRef'));
    $('#userManagerForm').submit();
});

$('#registerUndoBtn').on('click', function () { $('#registerFormDiv').fadeOut(1000); });

$('.logoutButton').on('click', function () {
    $('#logoutAction').val('1');
    $('#financeForm').submit();
});

$('.menuButton').each(function () {
    $(this).removeClass('highlight');
    if (($(this).attr('ref') == $('#tabId').val())) {
        $(this).addClass('highlight');
    }
    $(this).on('click', function () { contentFill('tabId', $(this).attr('ref')); });
});

$('#overviewYearSelect').on('change', function () {
    $('#refYear').val($(this).val());
    $('#financeForm').submit();
});

$('.valueCell.editableField').each(function () {
    $(this).attr('contenteditable', 'true');
    $(this).on('blur', function () {
        updateCellValue($(this).attr('year'), $(this).attr('month'), $(this).attr('target'), $(this).attr('column'), $(this).text(), 'updateForm');
    });
    $(this).on('keypress', function (e) {
        if (e.which == 13) { // Enter key pressed
            e.preventDefault();
            $(this).blur();
        }
    });
});

$('.valueCell').each(function () {
    $(this).on('mouseover', function () {
        $(this).attr('title', $(this).attr('titleRef'));
    });
});

$('.datepickerCell').each(function () {
    $(this).on('blur', function () {
        updateCellValue($(this).attr('year'), $(this).attr('month'), $(this).attr('target'), $(this).attr('column'), $(this).val(), 'updateForm');
    });
    $(this).on('keypress', function (e) {
        if (e.which == 13) { // Enter key pressed
            e.preventDefault();
            $(this).blur();
        }
    });
});

function updateCellValue(year, month, target, column, value, formName) {
    if (!$('#updateYear').val()) { $('#updateYear').val(year); }
    if (!$('#updateMonth').val()) { $('#updateMonth').val(month); }
    if (!$('#updateTarget').val()) { $('#updateTarget').val(target); }
    if (!$('#updateColumn').val()) { $('#updateColumn').val(column); }
    $('#updateValue').val(value);
    if (formName) {
        $('#opAction').val('update');
        $('#' + formName).submit();
    }
    else { alert('Form name not defined for this editable field.'); }
}

$('.bkpTdAction').each(function () {
    $(this).on('click', function () {
        if ($(this).attr('act') == 'del') {
            if (window.confirm('Confirm to DELETE \n\n' + $(this).attr('ref') + '\n\n backup file?')) {
                const backupFilename = '../DB/' + $(this).attr('ref');
                $.ajax({
                    url: 'include/manageBkp.php',
                    type: 'POST',
                    data: { 
                        file: backupFilename,
                        method: 'delete',
                    },
                    success: function (response) {
                        document.location.href = './?backup=1'
                    },
                    error: function () {
                        alert('Error has occured during file removal');
                    }
                });
            }
        }
        else if ($(this).attr('act') == 'reload') {
            if (window.confirm('Confirm to RELOAD \n\n' + $(this).attr('ref') + '\n\n backup file?')) {
                const backupFilename = '../DB/' + $(this).attr('ref');
                $.ajax({
                    url: 'include/manageBkp.php',
                    type: 'POST',
                    data: { 
                        file: backupFilename,
                        method: 'reload',
                    },
                    success: function (response) {
                        document.location.href = './?backup=1'
                    },
                    error: function () {
                        alert('Error has occured during file reload');
                    }
                });
            }
        }
        else {
            window.open('DB/' + $(this).attr('ref'));
        }
    });
});

/*  Accordion section */
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function () {
        this.classList.toggle("active");
        var panel = this.nextElementSibling;
        // Close all other panels
        for (var j = 0; j < acc.length; j++) {
            var otherPanel = acc[j].nextElementSibling;
            if (otherPanel !== panel) {
                otherPanel.style.display = "none";
                acc[j].classList.remove("active");
            }
        }
        // Toggle current panel
        if (panel.style.display === "block") {
            panel.style.display = "none";
        } else {
            panel.style.display = "block";
        }
    });
}
/* */