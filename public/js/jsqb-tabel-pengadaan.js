$('#tabelpengadaan').DataTable( {

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
        });
    },
    "columnDefs": [
        { "orderable": false, "targets": 3 }
    ],
    //"scrollY":        "300px",
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
    ajax: '/pengadaan/listed',
    columns: [
        {
            data: 'id',
            render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }
        },
        {
            data: 'title',
            name: 'title',
            render: function(data, type, row) {
                return "<a href='/pengadaan/detail/" + row.id + "'>" + data + "</a>";
                // return "<a href=\"\\javascript:void(0)\"\\ onclick=\"\\call('<?= url('pengadaan/detail/"+ row.id +"'); ?>\"\\,'_content_','Daftar Aktif')>"+ data +"</a>";
            }
        },
        {
            data: 'work_unit', name: 'work_unit'
        },
        {
            data: 'procurement_method',
            render: function ( data, type, row ) {
                if (data == 1) {
                    return "Pelelangan/Seleksi Umum";
                } else if (data == 2) {
                    return "Pelelangan Selektif/Seleksi Terbatas";
                } else if (data == 3) {
                    return "Pemilihan Langsung/Seleksi Langsung";
                } else if (data == 4) {
                    return "Penunjukan Langsung";
                } else if (data == 5) {
                    return "Pengadaan Langsung";
                } else {
                    return "";
                }
            }
        },
        {
            data: 'amount', name: 'amount'
        },
        {
            data: 'stage',
            render: function ( data, type, row ) {
                if (data == 0) {
                    return "-";
                } else if (data == 1) {
                    return "Pengumuman";
                } else {
                    return "Pengumuman Pemenang Pengadaan";
                }
            }
        },
    ]


} );
