$(document).ready(function() {
    $('.dataTable').hide();
    $('.btnSubmit').click(function() {
        $('.dataTable').show();
    }); 
});
$(document).ready(function() {
    // $('.entry').hide(); 
    $('.type').change(function() {
        if($('.type').val() == 'student') {
            $('.entryStudent').show();
            $('.entryLecturer').hide();
        } else if ($('.type').val() == 'lecturer') {
            $('.entryLecturer').show();
            $('.entryStudent').hide();
        } else {
            $('.entryLecturer').hide();
            $('.entryStudent').hide();
        }
    });

    $("#datepicker").datepicker();
    $("#datepicker1").datepicker();
    $("#datepicker2").datepicker();
    $("#datepicker3").datepicker();
    $("#datepicker4").datepicker();
    $("#datepicker5").datepicker();
    $("#datepicker6").datepicker();
    $("#datepicker7").datepicker();
    $("#datepicker8").datepicker();
});

window.onbeforeunload = function () {
    window.scrollTo(0, 0);
}

window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(".alert").remove(); 
    });
}, 2000);