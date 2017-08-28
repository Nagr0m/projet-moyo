$( () => {
    'use strict'

    // Validation du login form
    let hasErrors      = false
    let form           = $('.loginForm')
    let requiredFields = form.find('input[required]')

    form.on('submit', function (e) {
        e.preventDefault()

        if (formValidate())
            this.submit()
        else
            return false
    })

    function formValidate () {
        removeErrors()

        requiredFields.each( function (i) {
            if ($(this).val() === '')
                displayError($(this), 'Ce champ est requis')
        })

        return !hasErrors
    }

    function displayError (elem, message) {
        hasErrors  = true
        let parent = elem.parents('.input-field')
        elem.addClass('invalid')
        parent.attr('data-error', message)
        parent.addClass('invalid')
    }

    function removeErrors () {
        hasErrors = false
        let errorFields = $('.input-field.invalid')
        
        errorFields.each(function (i) {
            $(this).find('input').removeClass('invalid')
            $(this).removeClass('invalid')
        })
    }


})