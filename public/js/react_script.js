$(function () {
    if (localStorage.chkbox && localStorage.chkbox != '') {
        $('#rememberChkBox').attr('checked', 'checked');
        $('#voornaam').val(localStorage.voornaam);
        $('#achternaam').val(localStorage.achternaam);
        $('#adress').val(localStorage.adress);
        $('#gender').val(localStorage.gender);
        if(localStorage.gender == "man"){
            $('#man').attr('checked', 'checked');
        } else if (localStorage.gender == "vrouw"){
            $('#vrouw').attr('checked', 'checked');    
        }

        $('#email').val(localStorage.email);
        $('#tel').val(localStorage.tel);
    }

    $('#rememberChkBox').click(function () {

        if ($('#rememberChkBox').is(':checked')) {
            // save username and password
            localStorage.voornaam = $('#voornaam').val();
            localStorage.achternaam = $('#achternaam').val();
            if ($('#man').is(':checked')){
                localStorage.gender = 'man';
            }else if ($('#vrouw').is(':checked')){
                localStorage.gender = 'vrouw';
            }
            localStorage.adress = $('#adress').val();
            localStorage.email = $('#email').val();
            localStorage.achternaam = $('#achternaam').val();
            localStorage.tel = $('#tel').val();
            localStorage.chkbox = $('#rememberChkBox').val();
        } else {
            localStorage.clear();
        }
    });
});