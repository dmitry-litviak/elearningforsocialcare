create =
  q_template : JST["question"]
  init: ->
    do @detect_elements
    do @bind_events
    
  detect_elements: ->    
    @new_q = $("#new-question") 
    @form  = $("form")
  
  bind_events: ->
    do @init_redactor
    do @new_click
    do @form_validation
    
  new_click: ->
    @new_q.click (e) =>
      el = $(e.currentTarget)
      @form.validationEngine('detach');
      questions = $('.question')
      questions.last().after(@q_template({number : questions.size() + 1}))
      do @init_redactor
      do @form_validation
  
  remove_question: (element) ->
    $(element).parents('.question').remove()
  
  init_redactor: ->
    $('.textarea').last().wysihtml5()
  
  form_validation: ->
    @form.validationEngine('attach');


$(document).ready ->
  do create.init