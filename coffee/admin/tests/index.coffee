index =
  init: ->
    do @detectElements
    do @bindEvents
    
  detectElements: ->    
    @table = $("table")
  
  bindEvents: ->
    do @initTable
  
  remove: (id, el) ->
    if confirm "Remove this test?"
      $.ajax
        url: SYS.baseUrl + "admin/tests/delete"
        type: "POST"
        dataType: "JSON"
        data: $.param
          id: id
        success: (res) =>  
          @oTable.fnDeleteRow $(el).parents('tr')[0]
          
  initTable: ->
    @oTable = @table.dataTable
#      sDom: "<'row'<'span6'l><'span6'f>r>t<'row'<'span6'i><'span6'p>>"
      sPaginationType: "bootstrap"
      bProcessing    : true
      bServerSide    : true
      iDisplayLength : 10
      bRetrieve      : true
      sAjaxSource    : SYS.baseUrl + "admin/tests/getAjaxData"
      oLanguage:
        sLengthMenu: "_MENU_ records per page"

$(document).ready ->
  do index.init