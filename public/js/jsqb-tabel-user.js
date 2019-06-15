$('#tabeluser').DataTable( {

    initComplete: function () {
        this.api().columns([4]).every( function () {
            var column = this;
            var filter  = '<select class="form-control">'
                          + '<option value="">-Pilih Role-</option>'
                          + '<option value="Admin">Perseorangan</option>'
                          + '<option value="Penyedia">Penyedia</option>'
                          + '<option value="Perencana">Perencana</option>'
                          + '<option value="Pengada">Pengada</option>'
                          + '<option value="Manajer">Manajer</option>'
                          + '<option value="Kadiv">Kadiv</option>'
                          + '<option value="Direksi">Direksi</option>'
                          + '</select>';
            var select  = $(filter)
                          .appendTo( $(column.header()).empty() )
                          .on( 'change', function () {
                              var val = $.fn.dataTable.util.escapeRegex(
                                  $(this).val()
                                  );

                              column
                              .search( val ? '^'+val+'$' : '', true, false )
                              .draw();
                          });
        });

        // this.api().columns([4]).every( function () {
        //     var column = this;
        //     var filter  = '<select class="form-control">'
        //                   + '<option value="">Bidang Usaha</option>'
        //                   + '<option value="it">IT</option>'
        //                   + '<option value="konstruksi">Konstruksi</option>'
        //                   + '<option value="lainnya">Lainnya</option>'
        //                   + '</select>';
        //     var select  = $(filter)
        //                   .appendTo( $(column.header()).empty() )
        //                   .on( 'change', function () {
        //                       var val = $.fn.dataTable.util.escapeRegex(
        //                           $(this).val()
        //                           );

        //                       column
        //                       .search( val )
        //                       .draw();
        //                   });
        // });
    },
    //"scrollY":        "300px",
    "columnDefs": [
        { "orderable": false, "targets": [3, 4] }
    ],
    language: {
        emptyTable: "Belum ada data untuk ditampilkan",
        info: "Menampilkan _PAGE_ dari _PAGES_ halaman",
        search: "Pencarian: _INPUT_",
        searchPlaceholder: "...",
        lengthMenu: "Tampilkan _MENU_ baris",
        paginate: {
          previous: "Sebelumnya",
          next: "Berikutnya"
      }
  },
  scrollCollapse: false,
  dom: 'lfrtip',
  processing: true,
  serverSide: true,
  responsive: true,
  ajax: '/user/data',
  columns: [
        {
            data: 'id',
            render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }
        },
        {
            data: 'name', name: 'name'
        },
        {
            data: 'email', name: 'email'
        },
        {
            data: 'nip', name: 'nip'
        },
        {
            data: 'role_ket', name: 'role_ket'
        },
        {
            data: 'unit_name', name: 'unit_name'
        },
        {
            data: 'created_at', name: 'created_at'
        }
    ]

});
