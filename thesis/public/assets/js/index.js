$(document).ready(function() {
    $('.dataTable').hide();
    $('.btnSubmit').click(function() {
        $('.dataTable').show();
    }); 
});
$(document).ready(function() {
    $('.entry').hide(); 
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
});