/**
 */

jQuery(function ($) {
    $('a.edit-script').on('click', function (e) 
    {
        var id = $(this).data('id'),
            script_id = '#script-' +  id,
            script = $(script_id).text();

        e.preventDefault();

        $('#script-text').text(script);
        
        $('#edit-script form').attr('action', '/repos/update/' + id);
    });
    
    $('#edit-script').on('shown.bs.modal', function () 
    {
        $('#script-text').focus();
    });

    $('form a.submit').click(function (e)
    {
        e.preventDefault();

        $(this).parents('form').submit();
    });

    (function jobs() 
    {
        setTimeout(function() 
        {
            $('.activity').css({ color: '#777' });
            $.ajax({ 
                url: "/jobs", 
                success: function(data)
                {
                    $('.activity').css({ color: 'red' });
                }, 
                dataType: "json", 
                complete: jobs 
            });
        }, 30000);
    })();
});
