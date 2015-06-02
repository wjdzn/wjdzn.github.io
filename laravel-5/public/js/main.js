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
<<<<<<< HEAD
    $('#link_forum').click(function(e){
        e.stopPropagation();
        e.preventDefault();
    });
=======
>>>>>>> f9eb8f2935e210dc911e20d1ac3f5a5339b5f8e8
});
