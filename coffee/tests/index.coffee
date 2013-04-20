index =
  init: ->
    do @detectElements
    do @bindEvents
    
  detectElements: ->    
    @next_btn = $(".next")
    @prev_btn = $(".prev")
  
  bindEvents: ->
    do @next
    do @prev
  
  prev: ->
    @prev_btn.click (e) =>
      e.preventDefault()
      el = $(e.currentTarget)
      $("#atab" + (el.parents(".tab-pane").data("id") - 1)).click()
  
  next: ->
    @next_btn.click (e) =>
      e.preventDefault()
      el = $(e.currentTarget)
      $("#atab" + (el.parents(".tab-pane").data("id") + 1)).click()
  

$(document).ready ->
  do index.init