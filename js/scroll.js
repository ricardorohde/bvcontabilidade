$(document).ready(function(){
    
    $("#fixo").scrollToFixed({
        preFixed: function() {
            $(this).css('background-color', 'black');
        },
    })
    
});