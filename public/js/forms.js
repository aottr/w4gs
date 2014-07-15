$(document).ready(function() {
    var max = 0;
    $("label").each(function(){
        if ($(this).width() > max)
            max = $(this).width();   
    });
    $("label").width(max);
    
    $("select").width($( "select" ).parent().width() - max - 26);
    
    $("input:text").width($( "input:text" ).parent().width() - max - 26);
    $("input:password").width($( "input:text" ).parent().width() - max - 26);
});