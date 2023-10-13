$(document).ready(function () {
    var name = 'person';
    var url = '';

    $('input[name="btnradio"]').change(function () {

        if ($(this).is(':checked') && $(this).attr('id') === 'btnUser') {
            name = 'person';
        } else {
            name = 'establishment';
        }

        url = '/StarListMaker/assets/pages/' + name + '/register.php';
        console.log('Url:' + url);

        $('a#btnNext').attr('href', url);
    });

});