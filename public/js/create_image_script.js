change_input();
    function change_input() {
        $('input[type="file"]').each(function(){

        var $file = $(this),
            $label = $file.next('label'),
            $labelText = $label.find('span'),
            labelDefault = $labelText.text();

        $file.on('change', function(event){
            if ($file[0].files[0].size > 7244183) {
                alert('De afbeelding is te groot.');
                console.log($file[0].files[0].size);
               // $(file).val(''); //for clearing with Jquery
            } else {
                var fileName = $file.val().split( '\\' ).pop(),
                    tmppath = URL.createObjectURL(event.target.files[0]);
                if( fileName ){
                $label
                    .addClass('file-ok')
                    .css('background-image', 'url(' + tmppath + ')');
                $labelText.text(fileName);
                }else{
                $label.removeClass('file-ok');
                $labelText.text(labelDefault);
                }
            }
        });

    });
    }
    

    $('#meer_images').click(function() {
        duplicate();
    });
    $('#minder_images').click(function() {
        removeDuplicate();
        console.log("OKEY");
    });
    i = 0;
    function duplicate() {
        i++;
        var original = document.getElementById('duplicater');
        var clone = original.cloneNode(true); // "deep" clone
        // $(clone).find('#file_text').attr('text', 'hoi');
        
        clone.id = "newDiv" + i;
        original.parentNode.appendChild(clone);
        $(clone).find('#file_text').attr('id', 'file_text' + i); 
        $(clone).find('#image').attr('name', 'image[]');
        $(clone).find('#image').attr('id', 'image' + i);
        $(clone).find('label').attr('for', 'image' + i);
        $(clone).find('label').css('background-image', 'none');
        $(clone).find('label').removeClass('file-ok')
        $('#file_text'+i).text("Plaatje " + (i + 1));
        change_input();
        
        
    }
    function removeDuplicate(){
        var original = document.getElementById('duplicater');
        var toDelete = document.getElementById('newDiv' + i); 
        toDelete.remove();
        i--;
    }

    CKEDITOR.replace( 'beschrijving', {
        height:"300",
        resize: true,
        
    });

    $(function () {

    if (localStorage.chkbox && localStorage.chkbox != '') {
        $('#rememberChkBox').attr('checked', 'checked');
        $('#voornaam').val(localStorage.voornaam);
        $('#achternaam').val(localStorage.achternaam);
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
            
            localStorage.email = $('#email').val();
            localStorage.achternaam = $('#achternaam').val();
            localStorage.tel = $('#tel').val();
            localStorage.chkbox = $('#rememberChkBox').val();
        } else {
            localStorage.clear();
        }
    });
});
    