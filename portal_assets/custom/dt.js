$(document).ready( function () {
var table = $('.custom_dt').DataTable({

  select: {
    style: 'single'
  },
  order: [
    [2, 'asc']
  ],

  dom: 'Bfrtip',
  "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
    //debugger;
    var index = iDisplayIndexFull + 1;
    $("td:first", nRow).html(index);
    return nRow;
  },

  "pageLength": 20,
  "lengthMenu": [
    [20, 30, 50, -1],
    [20, 30, 50, "All"]
  ],
  columnDefs: [{
  	targets: 0,
    render: function(data, type, row, meta) {
    console.log(meta.row);
    console.log(type == 'export'? meta.row : data);
    	return type == 'export'? meta.row : data;
    }
  }],
  buttons: ['pageLength',
    {
      extend: 'print',
      text: 'Print All',
      autoPrint: true,
      exportOptions: {
        columns: [':not(.hidden-print)'],
        orthogonal: 'export',
        modifier: {
          page: 'all'
        },
      },
      messageTop: function() {
        return '<h2 class="text-center"></h2>'
      },
      messageBottom: 'Print: 01-May-2019',
      customize: function(win) {

        $(win.document.body).find('h1').css('text-align', 'center');
        $(win.document.body).find('table')
          .removeClass('table-striped table-responsive-sm table-responsive-lg dataTable')
          .addClass('compact')
          .css('font-size', 'inherit', 'color', '#000');

      },
      footer: true
    },

  ]
})
} );
