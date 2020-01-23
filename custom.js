$(function() {

    // Hide all questions and show only single question

    $('.next-btn').click(function() {
        
        // get the custom attribute
        var _q = $(this).attr('q');
        
        // Assign the q hidden input the crrent value
        $('input[name="q"]').val(_q);
        
        // Submit the form
        $('#quiz_form').get(0).submit();
        
    });
    
    
    // Show results
    $('.show-result').click(function(){
        
        //var _s = $('input[name=options]:checked').val();
        
        // Add new hidden element so that script redirect to result page
        $('#quiz_form').append('<input type="hidden" name="show_result" value="true">');
        
        // Submit the form
        $('#quiz_form').get(0).submit();
        
    });
});



function windowpop(url, width, height) {
    var leftPosition, topPosition;
    //Allow for borders.
    leftPosition = (window.screen.width / 2) - ((width / 2) + 10);
    //Allow for title and status bars.
    topPosition = (window.screen.height / 2) - ((height / 2) + 50);
    //Open the window.
    window.open(url, "Solution", "status=no,height=" + height + ",width=" + width + ",resizable=yes,left=" + leftPosition + ",top=" + topPosition + ",screenX=" + leftPosition + ",screenY=" + topPosition + ",toolbar=no,menubar=no,scrollbars=no,location=no,directories=no");
}