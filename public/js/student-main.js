$( () => {
    'use strict'

    // Initialisation des éléments MaterializeCSS
    $(".button-collapse").sideNav()
    $('select').material_select()
    $('.modal').modal()

    $( document ).ready(function() {
        let formfinish = $('#formfinish');
        if($(formfinish)) {
            $(formfinish).modal('open');
        }

    });
    
})