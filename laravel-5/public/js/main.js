$(document).ready(function() {
    $('.a_join').click(function(e){
        $('#LoginModal').modal('show');
    });
    if($('#errors').length && $('#errors').val().length>0)
    {
        $('#MSGModalTitle').html("Whoops! There were some problems with your input.");
        $('#h4MSG').html($('#errors').val());
        $('#MSGModal').modal('show');
    }
});
