
$('#tabeldaftardash').DataTable( {

    initComplete: function () {
            this.api().columns([4]).every( function () {
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
        // "scrollY":        "300px",
      "columnDefs": [
          { "orderable": false, "targets": [4] }
      ],
      language: {
            infoEmpty: "Belum ada data untuk ditampilkan",
            info: "Menampilkan _PAGE_ dari _PAGES_ halaman",
            search: "Pencarian: _INPUT_",
            searchPlaceholder: "Masukkan kata kunci pencarian",
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
      ajax: '/dashboard/procurements',
      columns: [
        {
            data: 'id',
            render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }
        },
        {
            data: 'procurement_id', name: 'procurement_id'
        },
        {
            data: 'title',
            name: 'title'
            /* render: function(data, type, row) {
                 return "<a href='/penyedia/pengadaan/"+ row.id +"''>"+ data +"</a>";
             } */
        },
        {
            data: 'status',
            name: 'status'
            /*render: function ( data, type, row ) {
              var data = data.split('|');
                if (data[0] == 0) {
                    return "Perencanaan Pengadaan "+ data[1];
                } else if (data[0] == 1) {
                    return "Pengadaan Aktif "+ data[1];
                } else {
                    return "Pengadaan Selesai "+ data[1];
                }
            }*/
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
