$('#tabelmonitoringpekerjaan').DataTable( {
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
    //processing: true,
    serverSide: true,
    responsive: true,
    ajax: '/monitor/list',
    columns: [
        {
            data: 'id',
            render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }
        },
        {
            data: 'title', name: 'title',
            render: function (data, type, row, meta) {
                var urlbro = "/monitor/detail/" + row.id;
                var content = "_content_";
                var send_title = "Detail Monitoring";
                return '<a href="javascript:void(0)" onclick="call(\''+urlbro+'\',\''+content+'\',\''+send_title+'\')">' + data + '</a>';
            }
        },
        {
            data: 'address', name: 'address'
        },
        {
            data: 'business', name: 'business'
        },
        {
            data: 'created_at', name: 'created_at'
        }
    ]
});