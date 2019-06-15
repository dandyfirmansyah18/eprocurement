$('#tabelvendor').DataTable( {
    initComplete: function () {
        this.api().columns([3]).every( function () {
            var column = this;
            var filter  = '<select class="form-control">'
                        + '<option value="">Tipe Penyedia</option>'
                        + '<option value="0">Perseorangan</option>'
                        + '<option value="1">PT</option>'
                        + '<option value="2">CV</option>'
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

        this.api().columns([4]).every( function () {
            var column = this;
            var filter  = '<select class="form-control">'
                        + '<option value="">Bidang Usaha</option>'
                        + '<option value="it">IT</option>'
                        + '<option value="konstruksi">Konstruksi</option>'
                        + '<option value="lainnya">Lainnya</option>'
                        + '</select>';
            var select  = $(filter)
                        .appendTo( $(column.header()).empty() )
                        .on( 'change', function () {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                                );

                            column
                            .search( val )
                            .draw();
                        });
        });
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
    ajax: '/vendor/members',
    columns: [
        {
            data: 'id',
            render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }
        },
        {
            data: 'name', name: 'name',
            render: function (data, type, row, meta) {
                return "<a href='/vendor/detail/" + row.id + "'>" + data + "</a>";
            }
        },
        {
            data: 'address', name: 'address'
        },
        {
            data: 'type_id',
            render: function ( data, type, row ) {
                if (data == 1) {
                    return "PT";
                } else if (data == 2) {
                    return "CV";
                } else {
                    return "Perseorangan";
                }
            }
        },
        {
            data: 'business', name: 'business'
        },
        {
            data: 'created_at', name: 'created_at'
        }
    ]
});