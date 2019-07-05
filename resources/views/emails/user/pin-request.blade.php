<body style='background: #E0E7F1; padding: 0px;'>
    <div style='width: 80%; margin-left: 10%; margin-right: 10%;'>
        <div style='padding: 30px 0px 20px 0px; text-align: center;'>
            <img src="{{ asset('img/logoeproc.png') }}" alt='Logo EPROC' width="60" style="vertical-align: middle;" />
            &nbsp;
            <span style='font-size: 1.4em; font-weight: bold; vertical-align: middle;'>
                PT. XXX
            </span>
        </div>
        <div style='background: #f77841; text-align: center; font-size: 1.2em; color: #ffffff; padding: 30px;'>
            Konfirmasi PIN
        </div>
        <div style='padding: 30px; margin-top: 5px; background: #ffffff; color: #000000;'>
            Yth. pimpinan perusahaan {{ $name }}
            <br />Terimakasih telah memulai pendaftaran sebagai penyedia barang dan jasa di PT XXX.
            <br /><br />
            Anda dapat melengkapi data pendaftaran dengan login menggunakan:
            <br />
            email terdaftar dan PIN : <b>{{ $pin }}</b>
            <br /><br />
            Setelah melengkapi pendaftaran, Anda dapat mengirimkan data tersebut untuk diverifikasi oleh admin.
            <br />
            Setelah itu, silahkan ikuti langkah berikutnya melalui petunjuk aplikasi dan/atau email
        </div>
    </div>
</body>
