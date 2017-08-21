$( () => {
    'use strict'

    // Variables checkboxes
    let checkToggle = $('#checkToggle')
    let checkboxes  = $('input[type=checkbox]:not(#checkToggle)')

    // Variables validation
    let operation
    let checkFlag   = 0
    let hasErrors   = false
    let form        = $('#massForm')
    let errorPanel  = $('.frontErrors')
    let modale      = $('#confirmMaterial')
    let resource    = $('input[name=resource]').val()

    // Events
    checkToggle.click(checkboxesToggle)
    checkboxes.click( function () {
        if ($(this).is(':checked')) checkFlag++
        else checkFlag--
    })
    form.on('submit', function (e) {
        e.preventDefault()
        let thatForm = this

        if (checkMassAssignment()) {
            if (operation === 'delete') {
                modale.find('.modalResource').html(resource)
                modale.modal('open')

                $('#confirmModal').click( () => { thatForm.submit() } )
            } else {
                this.submit()
            }
        } else {
            return false
        } 
    })

    // All checked/unchecked
    function checkboxesToggle () {
        if ($(this).is(':checked')) {
            checkboxes.prop('checked', true)
            checkFlag = checkboxes.length
        } else {
            checkboxes.prop('checked', false)
            checkFlag = 0
        }
    }

    // Validation
    function checkMassAssignment () {
        hideError()
        operation = $('select[name=operation]').val()

        if (checkFlag === 0)
            showError('Vous devez sélectionner au moins un élément')

        if (operation === null)
            showError('Vous devez sélectionner une action groupée')

        return !hasErrors
    }

    // Error handle
    function showError (message) {
        hasErrors = true
        errorPanel.show().find('.panel-content').html(message)
    }

    function hideError () {
        hasErrors = false
        errorPanel.hide()
    }

})