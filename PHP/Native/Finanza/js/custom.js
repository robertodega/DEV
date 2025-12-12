function deleteBck(bck) {
  if (window.confirm("Confirm to DELETE \n\n" + bck + "\n\n backup file?")) {
    const backupFilename = "../DB/" + bck;
    $.ajax({
      url: "inc/bck-man.php",
      type: "POST",
      data: {
        filename: backupFilename,
        method: "delete",
      },
      success: function (response) {
        document.location.href = "./backup";
      },
      error: function () {
        alert("Error has occured during file removal");
      },
    });
  }
}

function updateCellValue(year, month, table, column, value, formName) {
  if (!$("#updateYear").val()) {
    $("#updateYear").val(year);
  }
  if (!$("#updateMonth").val()) {
    $("#updateMonth").val(month);
  }
  if (!$("#updateTable").val()) {
    $("#updateTable").val(table);
  }
  if (!$("#updateColumn").val()) {
    $("#updateColumn").val(column);
  }
  if(!value){value = 0;}
  $("#updateValue").val(value);
  if (formName) {
    $("#opAct").val("update");
    $("#" + formName).submit();
  } else {
    alert("Form name not defined for this editable field.");
  }
}

$(".locSelector").on("change", function () {
  document.location.href =
    "./?y=" + $(this).val() + "&p=" + $(this).attr("pageRef") + "";
});

$(".locBtn").on("click", function () {
  document.location.href =
    "./?y=" + $(this).attr("refYear") + "&p=" + $(this).attr("pageRef") + "";
});

$(".bckBtn").on("click", function () {
  document.location.href = "backup";
});

$(".valueCell.editableField").each(function () {
  $(this).attr("contenteditable", "true");
  $(this).on("blur", function () {
    updateCellValue(
      $(this).attr("year"),
      $(this).attr("month"),
      $(this).attr("table"),
      $(this).attr("column"),
      $(this).text(),
      "updateForm"
    );
  });
  $(this).on("keypress", function (e) {
    if (e.which == 13) {
      // Enter key pressed
      e.preventDefault();
      $(this).blur();
    }
  });
});

$(".docViewerSpan").on("click", function () {
  $("#pageRef").val($(this).attr("pageRef"));
  $("#refYear").val($(this).attr("refYear"));
  $("#refMonth").val($(this).attr("refMonth"));
  $("#docFolder").val($(this).attr("docFolder"));
  $('#docViewerForm').submit();
});

$('.tdBollette').on('click', function(){
  document.location.href = "./?y="+$(this).attr("year")+"&p=bollette&m="+$(this).attr("month");
});
$('.tdMutuo').on('click', function(){
  document.location.href = "./?y="+$(this).attr("year")+"&p=mutuo&m="+$(this).attr("month");
});
$('.tdSpese_fisse').on('click', function(){
  document.location.href = "./?y="+$(this).attr("year")+"&p=overview&m="+$(this).attr("month");
});