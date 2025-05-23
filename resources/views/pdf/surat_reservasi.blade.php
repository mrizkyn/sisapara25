<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Pengajuan Permohonan Penggunaan Sarana/Prasarana</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 40px;
            line-height: 1.6;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 18px;
            font-weight: bold;
            margin: 0;
        }

        .header p {
            font-size: 12px;
            margin: 2px 0;
        }

        .content {
            margin-top: 20px;
        }

        .content p {
            margin: 5px 0;
        }

        .content .label {
            font-weight: bold;
            text-decoration: underline;
        }

        .content .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .content .table td,
        .content .table th {
            padding: 10px;
            border: 1px solid #333;
            text-align: left;
        }

        .content .table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
        }

        .footer p {
            font-size: 12px;
            margin: 0;
        }
    </style>
</head>

<body>

    <!-- Header -->
    <div class="header">
        <h1>Surat Pengajuan Permohonan Penggunaan Sarana/Prasarana</h1>
        <p>Nomor: {{ $reservation->id }}</p>
        <p>Dispora bandung - Tahun {{ date('Y') }}</p>
    </div>

    <!-- Content -->
    <div class="content">
        <p>Dengan hormat,</p>
        <p>Yang bertanda tangan di bawah ini, Admin Disporapar Kota Bandung, mengajukan permohonan penggunaan
            fasilitas yang diajukan oleh:</p>

        <p class="label">Data Pengaju:</p>
        <p>Nama Pengaju: <strong>{{ $reservation->user->name }}</strong></p>

        <p class="label">Data Admin yang Mengajukan:</p>

        <p>Nama Admin: <strong>{{ $reservation->approvedBy->id ?? '-' }}</strong></p>

        <p class="label">Data Kegiatan:</p>

        <table class="table">
            <tr>
                <th>Nama Kegiatan</th>
                <td>{{ $reservation->purpose }}</td>
            </tr>
            <tr>
                <th>Waktu Pelaksanaan</th>
                <td>{{ \Carbon\Carbon::parse($reservation->time_start)->format('d M Y H:i') }} -
                    {{ \Carbon\Carbon::parse($reservation->time_end)->format('H:i') }}</td>
            </tr>
            <tr>
                <th>Tempat / Fasilitas</th>
                <td>{{ $reservation->facility->name ?? '-' }}</td>
            </tr>
        </table>

        <p class="label">Keterangan Tambahan:</p>
        <p>{{ $reservation->additional_info ?? 'Tidak ada' }}</p>

        <p>Dengan ini kami mengajukan permohonan penggunaan fasilitas tersebut untuk kegiatan di atas kepada
            Disporapar
            Kota [Nama Kota], dan mohon untuk mendapatkan persetujuan.</p>

        <p>Demikian surat permohonan ini kami buat dengan sebenar-benarnya untuk digunakan sebagaimana mestinya.</p>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>Hormat kami,</p>
        <p>Admin Disporapar Kota Bandung</p>
    </div>


</body>

</html>
