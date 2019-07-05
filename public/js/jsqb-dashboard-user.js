$('#tabelpengadaan').DataTable( {
    initComplete: function () {
        this.api().columns([2]).every( function () {
            var column = this;
            var filter  = '<select class="form-control">'
                          + '<option value="">Jenis Pengadaan</option>'
                          + '<option value="1">Pelelangan/Seleksi Umum</option>'
                          + '<option value="2">Pelelangan Selektif/Seleksi Terbatas</option>'
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
        this.api().columns([3]).every( function () {
            var column = this;
            var filter  = '<select class="form-control">'
                          + '<option value="">Tahapan</option>'
                          + '<option value="0">-</option>'
                          + '<option value="2">Pengumuman</option>'
                          + '<option value="3">Pengumuman Pemenang Pengadaan</option>'
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
    //"scrollY":        "300px",
    language: {
        emptyTable: "Belum ada data untuk ditampilkan",
        info: "Menampilkan _PAGE_ dari _PAGES_ halaman",
        search: "Pencarian: _INPUT_",
        searchPlaceholder: "...",
        paginate: {
            previous: "Sebelumnya",
            next: "Berikutnya"
        }
    },
    scrollCollapse: false,
    "bLengthChange": false,
    "bInfo": false,
    "bFilter": false,
    processing: true,
    serverSide: true,
    responsive: true,
    ajax: '/public/procurements',
    order: [],
    columnDefs: [ { orderable: false, targets: [0, 2, 3, 5] } ],
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
            var urlbro = "/penyedia/pengadaan/" + row.id;
            var content = "_content_";
            var send_title = "Vendor Detail";
            return '<a href="javascript:void(0)" onclick="call(\''+urlbro+'\',\''+content+'\',\''+send_title+'\')">' + data + '</a>';
          }
      },
      {
          data: 'method',
          render: function ( data, type, row ) {
              if (data == 1) {
                  return "Pelelangan/Seleksi Umum";
              } else if (data == 2) {
                  return "Pelelangan Selektif/Seleksi Terbatas";
              } else {
                  return "";
              }
          }
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
      {
          data: 'schedule', name: 'schedule'
      },
      {
            data: 'id', name: 'action',
            render: function (data, type, row, meta) {
                return "<a href='/penyedia/pengadaan/" + row.id + "'><button type='button' style='margin-top: 0 !important' class='btn btn-info btn-sm'>Detail</button></a>";
            }
        }
    ]
});

$('#tabelsaya').DataTable( {
    initComplete: function () {
        this.api().columns([2]).every( function () {
            var column = this;
            var filter  = '<select class="form-control">'
                          + '<option value="">Jenis Pengadaan</option>'
                          + '<option value="1">Pelelangan/Seleksi Umum</option>'
                          + '<option value="2">Pelelangan Selektif/Seleksi Terbatas</option>'
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
        this.api().columns([3]).every( function () {
            var column = this;
            var filter  = '<select class="form-control">'
                          + '<option value="">Tahapan</option>'
                          + '<option value="0">-</option>'
                          + '<option value="2">Pengumuman</option>'
                          + '<option value="3">Pengumuman Pemenang Pengadaan</option>'
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
    //"scrollY":        "300px",
    language: {
        emptyTable: "Belum ada data untuk ditampilkan",
        info: "Menampilkan _PAGE_ dari _PAGES_ halaman",
        search: "Pencarian: _INPUT_",
        searchPlaceholder: "...",
        paginate: {
            previous: "Sebelumnya",
            next: "Berikutnya"
        }
    },
    scrollCollapse: false,
    "bLengthChange": false,
    "bInfo": false,
    "bFilter": false,
    processing: true,
    serverSide: true,
    responsive: true,
    ajax: '/dashboard/my_procurements',
    order: [],
    columnDefs: [ { orderable: false, targets: [0, 2, 3, 5] } ],
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
              return "<a href='/penyedia/pengadaan/"+ row.id +"''>"+ data +"</a>";
          }
      },
      {
          data: 'method',
          render: function ( data, type, row ) {
              if (data == 1) {
                  return "Pelelangan/Seleksi Umum";
              } else if (data == 2) {
                  return "Pelelangan Selektif/Seleksi Terbatas";
              } else {
                  return "";
              }
          }
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
      {
          data: 'schedule', name: 'schedule'
      },
      {
            data: 'id', name: 'action',
            render: function (data, type, row, meta) {
                return "<a href='/penyedia/pengadaan/" + row.id + "'><button type='button' style='margin-top: 0 !important' class='btn btn-info btn-sm'>Detail</button></a>";
            }
       }
    ]
});
