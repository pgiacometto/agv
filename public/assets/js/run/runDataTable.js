 var oTable1 = $('#sample-table-2').dataTable( {
        "aoColumns": [
        { "bSortable": true },
         null, null, null,null, null, null,
          { "bSortable": false }
    ] } );

    var oTable2 = $('#listapedidos').dataTable( {
        "aoColumns": [
        { "bSortable": true },
         null, null, null,null,
          { "bSortable": false }
    ] } );

$('table th input:checkbox').on('click' , function(){
            var that = this;
            $(this).closest('table').find('tr > td:first-child input:checkbox')
            .each(function(){
                    this.checked = that.checked;
                    $(this).closest('tr').toggleClass('selected');
            });

    });


