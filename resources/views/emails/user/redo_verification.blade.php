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
            Verifikasi Penyedia
        </div>
        <div style='padding: 30px; margin-top: 5px; background: #ffffff; color: #000000;'>
            Yth. Pimpinan perusahaan {{ $name }}
            <br /><br />
            Data pendaftaran anda memiliki kekurangan sebagai berikut:
            <br /><br />
            {{ $notes }}
            <br /><br />
            Mohon melengkapi kekurangan tersebut dan kirimkan kembali pendaftaran Anda segera.<br>
            Anda dapat melengkapi data pendaftaran dengan akses ke aplikasi e-Procurement XXX menggunakan link berikut:
            <br />
            <a href="{{ URL::to('daftar/'.$paramsend) }}" target="_blank"><b>{{ URL::to('daftar/'.$paramsend) }}</b></a>
            <br /><br />
            Setelah melengkapi data pendaftaran, Anda dapat mengirimkan data tersebut untuk diverifikasi oleh admin.
            <br />
            Setelah itu, silahkan ikuti langkah berikutnya melalui petunjuk aplikasi dan/atau email
            <br /><br />
            Terimakasih.
        </div>
    </div>
</body>
