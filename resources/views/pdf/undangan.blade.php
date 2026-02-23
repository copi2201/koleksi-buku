<!DOCTYPE html>
<html>
<head>
    <title>Undangan Resmi</title>
    <style>
        @page { size: a4 portrait; margin: 1.5cm 2cm; }
        body { font-family: 'Times New Roman', Times, serif; font-size: 12pt; line-height: 1.5; color: black; }
        
        /* Header / Kop Surat */
        .header { text-align: center; border-bottom: 3px solid black; padding-bottom: 5px; margin-bottom: 20px; }
        .header h2 { margin: 0; font-size: 16pt; text-transform: uppercase; }
        .header h3 { margin: 0; font-size: 14pt; text-transform: uppercase; }
        .header p { margin: 0; font-size: 10pt; font-style: italic; }

        /* Isi Surat */
        .isi-surat { margin-top: 10px; }
        .info-surat { margin-bottom: 20px; }
        .info-surat table { width: 100%; border: none; }
        .content { text-align: justify; }
        
        /* Tanda Tangan */
        .footer-sign { margin-top: 50px; float: right; width: 250px; text-align: left; }
        .space { height: 70px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>UNIVERSITAS AIRLANGGA</h2>
        <h3>FAKULTAS VOKASI</h3>
        <p>Kampus B Jl. Dharmawangsa Dalam Surabaya - Telp. (031) 5033869</p>
    </div>

    <div class="isi-surat">
        <div class="info-surat">
            <table>
                <tr><td width="80">Nomor</td><td>: 556/B/DST/UN3.FV/TU.01.00/2026</td></tr>
                <tr><td>Lampiran</td><td>: 1 (Satu) Berkas</td></tr>
                <tr><td>Perihal</td><td>: <strong>Undangan Koordinasi</strong></td></tr>
            </table>
        </div>

        <p>Yth. <strong>{{ Auth::user()->name }}</strong></p>
        <p>Fakultas Vokasi Universitas Airlangga</p>
        <p>Surabaya</p>

        <div class="content">
            <p>Dengan hormat,</p>
            <p>Sehubungan dengan pelaksanaan program kerja tahun 2026, kami mengharapkan kehadiran Bapak/Ibu pada rapat koordinasi yang akan diselenggarakan pada:</p>
            
            <table style="margin-left: 30px;">
                <tr><td width="100">Hari, Tanggal</td><td>: Selasa, 20 Januari 2026</td></tr>
                <tr><td>Waktu</td><td>: 10.00 – 13.00 WIB</td></tr>
                <tr><td>Tempat</td><td>: Ruang Sidang Dekanat Lt. 2, Gedung Vokasi</td></tr>
                <tr><td>Agenda</td><td>: Pembahasan Workshop Web 2026</td></tr>
            </table>

            <p>Mengingat pentingnya acara ini, dimohon kehadiran Bapak/Ibu tepat pada waktunya. Demikian undangan ini kami sampaikan, atas perhatian dan kerjasamanya kami ucapkan terima kasih.</p>
        </div>

        <div class="footer-sign">
            <p>23 Februari 2026</p>
            <p>Dekan,</p>
            <div class="space"></div>
            <p><strong>Prof. Dr. Anwar Sanusi</strong><br>NIP. 197607071999032001</p>
        </div>
    </div>
</body>
</html>