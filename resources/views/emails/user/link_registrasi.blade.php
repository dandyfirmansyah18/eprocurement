<body style='background: #E0E7F1; padding: 0px;'>
    <div style='width: 80%; margin-left: 10%; margin-right: 10%;'>
        <div style='padding: 30px 0px 20px 0px; text-align: center;'>
            <img src="https://equnix.asia/img/equnix-edii.png" alt='Logo EDII' width="60" style="vertical-align: middle;" />
            &nbsp;
            <span style='font-size: 1.4em; font-weight: bold; vertical-align: middle;'>
                PT. EDI Indonesia
            </span>
        </div>
        <div style='background: #f77841; text-align: center; font-size: 1.2em; color: #ffffff; padding: 30px;'>
            Link Registrasi
        </div>
        <div style='padding: 30px; margin-top: 5px; background: #ffffff; color: #000000;'>
            Yth. Pimpinan Perusahaan {{ $name }}
            <br />Terimakasih telah memulai pendaftaran sebagai penyedia barang dan jasa di PT EDI Indonesia.
            <br /><br />
            Anda dapat melengkapi data pendaftaran dengan akses ke aplikasi e-Procurement EDII menggunakan link berikut:
            <br />
            <a href="{{ URL::to('daftar/'.$paramsend) }}" target="_blank"><b>{{ URL::to('daftar/'.$paramsend) }}</b></a>
            <br /><br />
            Setelah melengkapi pendaftaran, Anda dapat mengirimkan data tersebut untuk diverifikasi oleh admin.
            <br />
            Setelah itu, silahkan ikuti langkah berikutnya melalui petunjuk aplikasi dan/atau email
        </div>
    </div>
</body>
