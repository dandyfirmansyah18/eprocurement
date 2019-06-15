$('#tabelhitam').DataTable( {
    "scrollY":        "300px",
    language: {
        emptyTable: "Belum ada data untuk ditampilkan",
        infoEmpty: "",
        info: "Menampilkan _PAGE_ dari _PAGES_ halaman",
        search: "Pencarian: _INPUT_",
        searchPlaceholder: "...",
        lengthMenu: "Tampilkan _MENU_ baris",
        paginate: {
            previous: "Sebelumnya",
            next: "Berikutnya"
        }
    },
    "scrollCollapse": false,
    processing: true,
    serverSide: true,
    responsive: true,
    ajax: '/vendor/blacklists',
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
        data: 'taxpayer_number', name: 'taxpayer_number'
    },
    {
        data: 'address', name: 'address'
    },
    {
        data: 'phone', name: 'phone'
    }
    ]

});
