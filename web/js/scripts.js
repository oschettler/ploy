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
        function check()
        {
            $('.activity')
                .css({ color: '#777' })
                 .attr('title', 'No active jobs');
            $.ajax({ 
                url: "/jobs/count", 
                success: function(response)
                {
                    if (response.count > 0) {
                        $('.activity')
                            .css({ color: 'red' })
                            .attr('title', response.count + ' active jobs');
                    }
                }, 
                dataType: "json", 
                complete: jobs 
            });
        }

        check();
        setTimeout(check, 30000);
    })();
});
