$( () => {
    'use strict'

    // Fields validation
    let hasErrors      = false
    let fields         = $('.field')
    let form           = $('form.validate')
    let emailField     = form.find('input[type=email]')
    let requiredFields = form.find('input[required], textarea[required]')

    // Event
    form.on('submit', function (e) {
        e.preventDefault()

        if (formValidate())
            this.submit()
        else
            return false
    })

    // Validation
    function formValidate () {
        removeErrors()

        requiredFields.each( function (i) {
            if ($(this).val() === '')
                displayError($(this), 'Ce champ est requis')
        })

        if (emailField.length > 0 && emailField.val() !== '') {
            if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(emailField.val()))
                displayError(emailField, "Email invalide")
        }
 
        if (hasErrors) return false

        return true
    }

    function displayError (elem, message) {
        hasErrors = true
        let fieldContainer = elem.parent('.field')
        fieldContainer.addClass('invalid').attr('data-error', message)
    }

    function removeErrors () {
        hasErrors = false
        fields.removeClass('invalid').attr('data-error', '');
    }
})