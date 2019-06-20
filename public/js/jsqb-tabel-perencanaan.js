$('#tabelperencanaan').DataTable( {
    /*serverSide: true,
    ajax: {
        url: '/perencanaan/daftar',
        type: 'GET'
    },*/
    initComplete: function () {
        this.api().columns([3]).every( function () {
            var column = this;
            var filter  = '<select class="form-control">'
                          + '<option value="">Jenis Pengadaan</option>'
                          + '<option value="1">Pelelangan/Seleksi Umum</option>'
                          + '<option value="2">Pelelangan Selektif/Seleksi Terbatas</option>'
                          + '<option value="3">Pemilihan Langsung/Seleksi Langsung</option>'
                          + '<option value="4">Penunjukan Langsung</option>'
                          + '<option value="5">Pengadaan Langsung</option>'
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
        } );
    },
    //"scrollY":        "300px",
    "columnDefs": [
        { "orderable": false, "targets": [3, 5, 8] }
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
}).draw();
