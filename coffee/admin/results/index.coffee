index =
  init: ->
    do @detectElements
    do @bindEvents
    
  detectElements: ->    
    @table = $("table")
  
  bindEvents: ->
    do @initTable
  
  remove: (id, el) ->
    if confirm "Remove this course?"
      $.ajax
        url: SYS.baseUrl + "admin/results/delete"
        type: "POST"
        dataType: "JSON"
        data: $.param
          id: id
        success: (res) =>  
          @oTable.fnDeleteRow $(el).parents('tr')[0]
          
  initTable: ->
    @oTable = @table.dataTable
      sPaginationType: "bootstrap"
      bProcessing    : true
      bServerSide    : true
      iDisplayLength : 10
      bRetrieve      : true
      sAjaxSource    : SYS.baseUrl + "admin/results/getAjaxData"
      oLanguage:
        sLengthMenu: "_MENU_ records per page"

$(document).ready ->
  do index.init