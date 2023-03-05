$('#submit').click(function () {
    if ($('#from').val() == '' ||
        $('#to').val() == '' ||
        $('#from').val() == '1970-January' ||
        $('#to').val() == '1970-January')
    {
        alert('Input can not be left blank');
        return false
    }
});

$('#reset').click(function() {
    $('#from').val('');
    $('#to').val('');
});
