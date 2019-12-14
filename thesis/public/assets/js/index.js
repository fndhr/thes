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
            $('.entryLecturer form').get(0).reset();
        } else if ($('.type').val() == 'lecturer') {
            $('.entryLecturer').show();
            $('.entryStudent').hide();
            $('.entryStudent form').get(0).reset();
        } else {
            $('.entryLecturer').hide();
            $('.entryStudent').hide();
            $('.entry input').val('');
            $('.entryLecturer form').get(0).reset();
            $('.entryStudent form').get(0).reset();
        }
    });
});