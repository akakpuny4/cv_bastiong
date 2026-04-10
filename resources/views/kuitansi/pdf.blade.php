<!DOCTYPE html>
<html>
<head>
    <title>Kuitansi {{ $kuitansi->jenis_kuitansi }}</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            font-size: 14px; 
            margin: 0;
            padding: 20px;
        }
        .container {
            border: 2px solid #000;
            padding: 20px;
            position: relative;
        }
        /* Bagian Kop Surat (Header) */
        .kop-surat {
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .kop-nama-cv {
            font-size: 20px;
            font-weight: bold;
            margin: 0;
        }
        .kop-alamat {
            font-size: 12px;
            margin: 5px 0 0 0;
        }
        /* Judul Kuitansi */
        .judul-kuitansi {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            text-decoration: underline;
            margin-top: -10px;
            margin-bottom: 5px;
        }
        .nomor-tanggal {
            position: absolute;
            top: 20px;
            right: 20px;
            text-align: right;
            font-size: 12px;
        }
        .nomor-tanggal table {
            width: auto;
            border: none;
            margin: 0;
        }
        .nomor-tanggal td {
            padding: 2px 5px;
            border: none;
        }
        /* Tabel Isi Kuitansi */
        .isi-tabel { 
            width: 100%; 
            border-collapse: collapse;
            margin-bottom: 20px; 
        }
        .isi-tabel td { 
            padding: 8px; 
            vertical-align: top; 
        }
        .label-col { 
            width: 25%; 
            font-style: italic;
        }
        .titik-dua {
            width: 2%;
        }
        .value-col { 
            width: 73%; 
            border-bottom: 1px dotted #000; 
        }
        /* Kotak Terbilang (Uang Sejumlah) */
        .box-terbilang {
            background-color: #f9f9f9;
            border: 1px solid #ccc;
            padding: 10px;
            font-style: italic;
            font-weight: bold;
            min-height: 40px;
        }
        /* Bagian Footer (Tanda Tangan & Kotak Rp) */
        .footer { 
            width: 100%; 
            margin-top: 30px; 
            display: table; /* Menggunakan display table agar float lebih aman di DomPDF */
        }
        .kotak-rp { 
            display: table-cell;
            vertical-align: bottom;
            width: 40%;
        }
        .kotak-rp-inner {
            border: 2px solid #000; 
            padding: 10px 15px; 
            font-size: 20px; 
            font-weight: bold; 
            background-color: #e0e0e0;
            display: inline-block;
        }
        .ttd-area { 
            display: table-cell;
            width: 60%;
            text-align: right;
        }
        .ttd-box {
            display: inline-block;
            text-align: center;
            margin-left: 20px;
        }
    </style>
</head>
<body>

    <div class="container">
        
        <div class="nomor-tanggal">
            <table>
                <tr>
                    <td>Nomor</td>
                    <td>:</td>
                    <td>{{ $kuitansi->no_kuitansi }}</td>
                </tr>
                <tr>
                    <td>Tanggal</td>
                    <td>:</td>
                    <td>{{ \Carbon\Carbon::parse($kuitansi->tanggal)->format('d - m - Y') }}</td>
                </tr>
            </table>
        </div>

        <div class="kop-surat">
            <h1 class="kop-nama-cv">CV BASTIONG JAYA TRADE</h1>
            @if($kuitansi->jenis_kuitansi == 'Penerimaan')
                <p class="kop-alamat">
                    JUAL ASPAL DAN BAHAN BANGUNAN<br>
                    Jl. Rawasari No. 3, Bastiong Talangame, Ternate<br>
                    Telp/WA: 085240196399
                </p>
            @else
                <p class="kop-alamat">
                    Jl. Rawasari I No. 3, Bastiong Talangame, RT 09/RW 03, Ternate<br>
                    Telp: 085240196399
                </p>
            @endif
        </div>

        <div class="judul-kuitansi">
            @if($kuitansi->jenis_kuitansi == 'Penerimaan')
                KUITANSI
            @else
                KUITANSI PENGELUARAN CV BJT
            @endif
        </div>

        <br>

        <table class="isi-tabel">
            <tr>
                <td class="label-col">Sudah Terima Uang dari</td>
                <td class="titik-dua">:</td>
                <td class="value-col">
                    <strong>
                        @if($kuitansi->jenis_kuitansi == 'Penerimaan')
                            {{ strtoupper($kuitansi->terima_dari) }}
                        @else
                            CV BASTIONG JAYA TRADE
                        @endif
                    </strong>
                </td>
            </tr>
            
            <tr>
                <td class="label-col">Uang Sejumlah</td>
                <td class="titik-dua">:</td>
                <td style="padding-bottom: 15px;">
                    <div class="box-terbilang">
                        # {{ $kuitansi->terbilang }} #
                    </div>
                </td>
            </tr>

            <tr>
                <td class="label-col">Untuk Pembayaran</td>
                <td class="titik-dua">:</td>
                <td class="value-col">{{ $kuitansi->untuk_pembayaran }}</td>
            </tr>

            @if($kuitansi->jenis_kuitansi == 'Penerimaan')
            <tr>
                <td class="label-col">Penerimaan Barang</td>
                <td class="titik-dua">:</td>
                <td class="value-col">........................ Drum/Zak</td>
            </tr>
            <tr>
                <td class="label-col">Harga Satuan Rp</td>
                <td class="titik-dua">:</td>
                <td class="value-col">........................ Harga Total Rp ........................</td>
            </tr>
            @endif
            
            @if($kuitansi->jenis_kuitansi == 'Pengeluaran')
            <tr>
                <td class="label-col">Dibayarkan Kepada</td>
                <td class="titik-dua">:</td>
                <td class="value-col"><strong>{{ strtoupper($kuitansi->terima_dari) }}</strong></td>
            </tr>
            @endif
        </table>

        <div class="footer">
            <div class="kotak-rp">
                <div class="kotak-rp-inner">
                    Rp. {{ number_format($kuitansi->jumlah_uang, 0, ',', '.') }}
                </div>
            </div>
            
            <div class="ttd-area">
                @if($kuitansi->jenis_kuitansi == 'Pengeluaran')
                    <div class="ttd-box" style="margin-right: 50px;">
                        Setuju Dibayar,<br><br><br><br>
                        ( .......................... )
                    </div>
                    <div class="ttd-box">
                        Dibayar Oleh,<br><br><br><br>
                        ( .......................... )
                    </div>
                @endif

                <div class="ttd-box">
                    @if($kuitansi->jenis_kuitansi == 'Penerimaan')
                        Ternate, {{ \Carbon\Carbon::parse($kuitansi->tanggal)->format('d M Y') }}<br>
                    @endif
                    Penerima,<br><br><br><br>
                    ( .......................... )
                    @if($kuitansi->jenis_kuitansi == 'Penerimaan')
                        <br>CV BASTIONG JAYA TRADE
                    @endif
                </div>
            </div>
        </div>

    </div>

</body>
</html>