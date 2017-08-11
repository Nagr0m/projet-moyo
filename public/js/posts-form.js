$( () => {
    'use strict'

    // Variables pour image preview
    let imageContainer = $('#thumbnailUpload')
    let imageClear     = imageContainer.find('#imageClear')
    let imagePreview   = imageContainer.find('.materialboxed')
    let imageName      = imageContainer.find('input.file-path')
    let imageField     = imageContainer.find('input[type=file]')
    // Variables pour validation
    let hasErrors    = false
    let form         = $('#postForm')
    let errorPanel   = $('.frontErrors')
    let titleField   = $('input[name=title]')
    let contentField = $('textarea[name=content]')


    // Events
    imageField.on('change', liveImgPreview)
    imageClear.click(clearImg)
    form.on('submit', function (e) {
        e.preventDefault()

        if (formValidate())
            this.submit()
        else
            return false
    })

    // Aperçu d'image en direct
    function liveImgPreview () {
        let files = $(this)[0].files

        if (files.length > 0) {
            let file = files[0]
            imagePreview.attr('src', window.URL.createObjectURL(file))
            imageClear.show()
        }
    }
    // Suppression de l'image
    function clearImg () {
        imagePreview.attr('src', '')
        imageField.val('')
        imageName.val('')
        $(this).hide()
    }

    // Validation du formulaire
    function formValidate () {
        hideAllErrors()

        if (titleField.val() === '')
            displayError(titleField, 'Ce champ ne peut pas être vide')
        if (contentField.val() === '')
            displayError(contentField, 'Ce champ ne peut pas être vide')

        if (hasErrors) return false
        
        return true
    }

    // Affichage des erreurs
    function displayError (element, message) {
        hasErrors = true
        errorPanel.fadeIn(100)
        let parent = element.parents('.input-field')
        
        element.addClass('invalid')
        parent.attr('data-error', message)
        parent.addClass('invalid')
        // Ajout pour le champ select MaterializeCSS
        element.parent('.select-wrapper').addClass('invalid')
    }

    // Retrait des erreurs
    function hideAllErrors () {
        hasErrors = false
        errorPanel.hide().find('.panel-content').html('Certains champs comportent des erreurs')
        let errorFields = $('.input-field.invalid')

        errorFields.each(function (i) {
            $(this).find('textarea').removeClass('invalid')
            $(this).find('.select-wrapper').removeClass('invalid')
            $(this).removeClass('invalid')
        })
    }
})