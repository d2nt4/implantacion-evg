$(document).ready(function ()
{
    $('#sidebarCollapse').on('click', function ()
    {
        $('#sidebar').toggleClass('active');
        $('aside').toggleClass('show');
    });
});
