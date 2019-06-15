$('#tabelcalonvendor').DataTable( {
    initComplete: function () {
        this.api().columns([3]).every( function () {
            var column  = this;
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
                            + '<option value="">Status</option>'
                            + '<option value="0">Pendaftar baru</option>'
                            + '<option value="2">Proses verifikasi oleh admin</option>'
                            + '<option value="3">Butuh verifikasi ulang</option>'
                            + '<option value="5">Dibekukan</option>'
                            + '<option value="6">Blacklist</option>'
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

        this.api().columns([5]).every( function () {
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
        info: "Menampilkan _PAGE_ dari _PAGES_ halamans",
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
    ajax: '/vendor/candidates',
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
            data: 'state',
            render: function ( data, type, row ) {
                if (data == 0) {
                    var created_date        = row.created_time.split(' ')[0];
                    if (created_date != '') {
                        created_date        = render_datepicker_format(created_date);
                    }
                    return "<i class='fa fa-exclamation-triangle fa-lg text-warning'></i> Pendaftar baru (" + created_date + ")";
                } else if (data == 2) {
                    var registration_date   = row.registration_time.split(' ')[0];
                    if (registration_date != '') {
                        registration_date   = render_datepicker_format(registration_date);
                    }
                    return "<i class='fa fa-edit fa-lg text-success'></i> Proses verifikasi oleh admin (" + registration_date + ")";
                } else if (data == 3) {
                    var updated_date        = row.updated_time.split(' ')[0];
                    if (updated_date != '') {
                        updated_date        = render_datepicker_format(updated_date);
                    }
                    return "<i class='fa fa-exclamation-triangle fa-lg text-warning'></i> Butuh verifikasi ulang (" + updated_date + ")";
                } else if (data == 5) {
                    var penalty_start_date  = row.penalty_start.split(' ')[0];
                    var penalty_end_date    = row.penalty_end.split(' ')[0];
                    if (penalty_start_date != '') {
                        penalty_start_date  = render_datepicker_format(penalty_start_date);
                    }
                    var penalty_time        = penalty_start_date + ' s/d ';
                    if (penalty_end_date != '') {
                        penalty_end_date  = render_datepicker_format(penalty_end_date);
                        penalty_time        = penalty_time + penalty_end_date;
                    } else {
                        penalty_time        = penalty_time + 'n/a';
                    }

                    return "<i class='fa fa-ban fa-lg text-warning'></i> Dibekukan (" + penalty_time + ")";
                } else if (data == 6) {
                    var penalty_start_date  = row.penalty_start.split(' ')[0];
                    var penalty_end_date    = row.penalty_end.split(' ')[0];
                    if (penalty_start_date != '') {
                        penalty_start_date  = render_datepicker_format(penalty_start_date);
                    }
                    var penalty_time        = penalty_start_date + ' s/d ';
                    if (penalty_end_date != '') {
                        penalty_end_date  = render_datepicker_format(penalty_end_date);
                        penalty_time        = penalty_time + penalty_end_date;
                    } else {
                        penalty_time        = penalty_time + 'n/a';
                    }
                    return "<i class='fa fa-ban fa-lg text-danger'></i> Blacklist (" + penalty_time + ")";
                } else {
                    return "Lainnya";
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