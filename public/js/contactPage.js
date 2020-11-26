var table = null;
$(document).ready( function () {
    table = $('#contact_page_table').DataTable({
        "dom": '<"d-flex justify-content-between"fp>rt<"mt-3"l><p>',
        "language": {
            "search": "Rechercher ",
            "paginate": {
                "first":      "Premier",
                "last":       "Dernier",
                "next":       "Suivant",
                "previous":   "Précédent"
            },
            "lengthMenu":     "Ligne par page _MENU_",
            "zeroRecords":    "Aucun enregistrements correspondants trouvés",
            "emptyTable":     "aucune donnée disponible"
        }
    });
    $( "#contact_date_naissance" ).datepicker();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

function updateContact(id){
    disableUi();
    $.ajax({
        url: '/contact/'+id,
        dataType : 'json',
        type: 'PUT',
        data: {
            'contact_civilite'      : $('input[name ="contact_civilite"]:checked').val().trim(),
            'contact_prenom'        : $('input[name ="contact_prenom"]').val().trim(),
            'contact_nom'           : $('input[name ="contact_nom"]').val().trim(),
            'societe_id'            : $('select[name ="societe_id"] option:selected').val().trim(),
            'contact_fonction'      : $('input[name ="contact_fonction"]').val().trim(),
            'contact_service'       : $('input[name ="contact_service"]').val().trim(),
            'contact_e_mail'        : $('input[name ="contact_e_mail"]').val().trim(),
            'contact_telephone'     : $('input[name ="contact_telephone"]').val().trim(),
            'contact_date_naissance': $('input[name ="contact_date_naissance"]').val().trim()
        },
        success:function(response) {
            // clear all errors
            $('.readable').each(function(index, value) {
                $(value).removeClass("is-invalid");
            });
            $('.contact_alert').addClass('d-none');

            // set new errors
            if(response.code === 400){
                $.each(response.messages, function(index, value) {
                    $('#'+ index).addClass('is-invalid');
                    $('.'+ index + "_feedback").text(value);
                });
            }else {
                $('.contact_alert').removeClass('alert-success');
                $('.contact_alert').removeClass('alert-danger');
                if(response.code === 404 || response.code === 500) $('.contact_alert').addClass('alert-danger');
                else if(response.code === 200)                     $('.contact_alert').addClass('alert-success');
                $('.contact_alert').removeClass('d-none');
                $('.contact_alert_text').text(response.messages);
                $('html, body').animate({
                    scrollTop: ($('#alert_scroll_dest').offset().top) - 50
                },500);
            }
            enableUi();
        },
        error:function(jqXHR, exception){
            erreurAlert(jqXHR.code, 'Le contact n\'a pas été modifier.');
            enableUi();
        }
    });
}

function addContact(){
    disableUi();
    $.ajax({
        url: '/contact',
        dataType : 'json',
        type: 'POST',
        data: {
            'contact_civilite'      : $('input[name ="contact_civilite"]:checked').val().trim(),
            'contact_prenom'        : $('input[name ="contact_prenom"]').val().trim(),
            'contact_nom'           : $('input[name ="contact_nom"]').val().trim(),
            'societe_id'            : $('select[name ="societe_id"] option:selected').val().trim(),
            'contact_fonction'      : $('input[name ="contact_fonction"]').val().trim(),
            'contact_service'       : $('input[name ="contact_service"]').val().trim(),
            'contact_e_mail'        : $('input[name ="contact_e_mail"]').val().trim(),
            'contact_telephone'     : $('input[name ="contact_telephone"]').val().trim(),
            'contact_date_naissance': $('input[name ="contact_date_naissance"]').val().trim()
        },
        success:function(response) {
            // clear all errors
            $('.readable').each(function(index, value) {
                $(value).removeClass("is-invalid");
            });
            $('.contact_alert').addClass('d-none');

            // set new errors
            if(response.code === 400){
                $.each(response.messages, function(index, value) {
                    $('#'+ index).addClass('is-invalid');
                    $('.'+ index + "_feedback").text(value);
                });
            }else {
                $('.contact_alert').removeClass('alert-success');
                $('.contact_alert').removeClass('alert-danger');
                if(response.code === 404 || response.code === 500) $('.contact_alert').addClass('alert-danger');
                else if(response.code === 200) {
                    $('.contact_alert').addClass('alert-success');
                    $('.readable').each(function(){
                        $(this).val('');
                    });
                }
                $('.contact_alert').removeClass('d-none');
                $('.contact_alert_text').text(response.messages);
                $('html, body').animate({
                    scrollTop: ($('#alert_scroll_dest').offset().top) - 50
                },500);
            }
            enableUi();
        },
        error:function(jqXHR, exception){
            erreurAlert(jqXHR.code, 'Le contact n\'a pas été ajouter.');
            enableUi();
        }
    });
}



function deleteContact(element, id){
    $.confirm({
        title: 'Confirmation !',
        content: 'Vous êtes sûre de vouloir supprimer ce contact ?',
        type: 'red',
        typeAnimated: true,
        buttons: {
            confirmation: {
                text: 'Oui',
                btnClass: 'btn-red',
                action: function(){
                    $.ajax({
                        url: '/contact/'+id,
                        dataType : 'json',
                        type: 'DELETE',
                        success :function(response) {
                            if(response.code === 200){
                                $(element).parents('tr').animate({
                                    opacity: 0
                                },1000, function(){
                                    if(table != null){
                                        table.row($(element).parents('tr')).remove().draw();
                                    }
                                });
                            }else erreurAlert(response.code, response.messages);
                        },
                        error:function(jqXHR, exception) {
                            erreurAlert(jqXHR.code, 'Le contact n\'a pas été supprimer.');
                        }
                    })
                }
            },
            close: {
                text: 'Non',
                btnClass: 'btn-green',
                action: function(){}
            }
        }
    });
}

function erreurAlert(code, message){
    $.confirm({
        title: 'Erreur Code ' + code,
        content: message,
        type: 'red',
        typeAnimated: true,
        buttons: {
            close: {
                text: 'fermer',
                btnClass: 'btn-red',
                action: function(){}
            }
        }
    });
}

function disableUi(){
    $('.readable').each(function(index, value) {
        $(value).attr('disabled', 'disabled');
    });
}

function enableUi(){
    $('.readable').each(function(index, value) {
        $(value).removeAttr('disabled');
    });
}