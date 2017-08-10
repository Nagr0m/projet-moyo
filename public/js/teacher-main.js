$( () => {
    'use strict'

    // Initialisation des éléments MaterializeCSS
    $(".button-collapse").sideNav()
    $('select').material_select()
    $('.modal').modal()

    // Events
    $('a.destroy').click(modaleDestroy)

    // Modale de confirmation de suppression
    function modaleDestroy () {
        let modale   = $('#confirmMaterial')
        let form     = $(this).parent('form')
        let resource = $(this).data('resource')
        
        modale.find('.modalResource').html(resource)
        modale.modal('open')

        $('#confirmModal').click( () => {
            form.submit()
        })
    }
    
})