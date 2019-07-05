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
            Perusahaan anda tidak lolos verifikasi penyedia PT XXX karena alasan berikut :
            <br />
            {{ $notes }}
            <br /><br />
            Perusahaan Anda dapat melakukan kembali proses pendaftaran setelah melengkapi alasan tidak lolos verifikasi di atas.
            <br /><br />
            Demikian yang dapat kami sampaikan, jika ada yang ingin ditanyakan,
            <br />
            dapat menghubungi kami di kantor PT. XXX atau melalui kontak berikut:
            <br />
            email: support@eproc-mercu.co.id
            <br />
            telepon:  +62 21 
        </div>
    </div>
</body>
