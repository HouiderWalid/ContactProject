var table = null;
$(document).ready( function () {
    $('#menu-toggler').on('click', function(){
        $('.expandable').removeClass('expand-effect').addClass('shrink-effect');
        $('#dash-menu').toggleClass('dash-menu-expend dash-menu-shrink');
    });
    $('.expandable-trigger').on('click', function(){
        dashSideFocusEffect(this);
    });
    table = $('#contact_page_table').DataTable({
        destroy: true,
        "dom": '<"d-flex justify-content-between"fp>rt<"mt-3"l><p>',
        "language": {
            "search"      : "Rechercher ",
            "paginate"    : {
                "first"   : "Premier",
                "last"    : "Dernier",
                "next"    : "Suivant",
                "previous": "Précédent"
            },
            "lengthMenu"  : "Ligne par page _MENU_",
            "zeroRecords" : "Aucun enregistrements correspondants trouvés",
            "emptyTable"  : "aucune donnée disponible"
        }
    });
    $( "#contact_date_naissance" ).datepicker();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.prevent-reload').click(function (e) {
        // Avoid the link click from loading a new page
        e.preventDefault();

        // Load the content from the link's href attribute
        $('#content-container').load($(this).attr('href'));
    });

    $('.anchor-li').click(function () {
        $('.anchor-li').each(function () {
            $(this).removeClass('op-1').addClass('op-05');
        });
        $(this).removeClass('op-05').addClass('op-1');
    })
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
                $('#body-container').animate({
                    scrollTop: ($('#alert_scroll_dest').offset().top)
                },"slow");
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

function dashSideFocusEffect(clickedElement){
    $(".main-nav li a").click(function(e) {
        e.preventDefault();
        var href = $(this).attr("href");
        $(".content-container").load(href);
    });
    var theElement = $(clickedElement).parent().children('.expandable');
    var expandable = $('.expandable').parent().children('.expandable');
    $('.expandable-trigger').removeClass('link-hover-hover');
    $(clickedElement).addClass('link-hover-hover');
    if($('#dash-menu').hasClass('dash-menu-expend')){
        expandable.each(function(){
            if($(this)[0] !== theElement[0]) $(this).removeClass('expand-effect').addClass('shrink-effect');
        })
        theElement.toggleClass('expand-effect shrink-effect');
    }
}

function activeAnchor(){
    $('.anchor-active').css('opacity', '1');
}

function deactivateAnchor(){
    $('.anchor-deactivate').css('opacity', '0.3');
}

/* function preventLoadEvent(e){
    e.preventDefault();
    var href = $(this).attr("href");
    $(".content-container").load(href);
} */