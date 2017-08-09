$( () => {
    'use strict'

    // Variables pour ajout de question
    let index = 0
    let questionContainer = $('#questionsContainer')
    let addQuestion       = $('.addQuestion')
    let delQuestion       = $('#delQuestion')

    // Variables pour validation
    let form            = $('#questionForm')
    let hasErrors       = false
    let contentField    = $('textarea[name=content]')
    let classSelect     = $('select[name=class_level]')
    let errorPanel      = $('.frontErrors')

    // Initialisation première question
    createQuestion()

    // Events
    addQuestion.click(createQuestion)
    delQuestion.click(destroyQuestion)
    form.on('submit', function (e) {
        e.preventDefault()

        if (formValidate())
            this.submit()
        else
            return false
    })

    // Ajout de question
    function createQuestion () {
        let toIncrement = {
            id: index,
            textlabel: 'Question ' + (index + 1)
        }

        let template = '\
        <div class="questionGroup" data-questionid="' + toIncrement.id + '">\
            <div class="input-field col s12">\
                <textarea id="question-' + toIncrement.id + '" name="questions[]" class="materialize-textarea"></textarea>\
                <label for="question-' + toIncrement.id + '">' + toIncrement.textlabel + '</label>\
            </div>\
            <div class="switch col s12">\
                <label>\
                    Faux\
                    <input type="checkbox" name="answer_' + toIncrement.id + '">\
                    <span class="lever"></span>\
                    Vrai\
                </label>\
            </div>\
        </div>'

        questionContainer.append(template)

        index++;
    }

    // Suppression de question
    function destroyQuestion () {
        index--
        if (index < 0) index = 0
        $( '.questionGroup[data-questionid='+ index +']' ).remove()
    }

    // Validation de formulaire
    function formValidate () {
        hideAllErrors()
        let questionsFields = $('.questionGroup .input-field > textarea')
        
        if (contentField.val() === '')
            displayError(contentField, 'Ce champ ne peut pas être vide')

        if (!classSelect.val())
            displayError(classSelect, 'Vous devez choisir un niveau')

        if (questionsFields.length === 0) {
            errorPanel.find('.panel-content')
                        .html('Le questionnaire doit au moins comporter une question')
            hasErrors = true
        }

        questionsFields.each(function (i) {
            if ($(this).val() === '')
                displayError($(this), 'Ce champ ne peut pas être vide')
        })

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