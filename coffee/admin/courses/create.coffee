create =
  init: ->
    do @detect_elements
    do @bind_events
    
  detect_elements: ->    
    @form  = $("form")
  
  bind_events: ->
    do @init_redactor
    do @form_validation
      
  init_redactor: ->
    $('.textarea').wysihtml5()
  
  form_validation: ->
    @form.validationEngine('attach');


$(document).ready ->
  do create.init