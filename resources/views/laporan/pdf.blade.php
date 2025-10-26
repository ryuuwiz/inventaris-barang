<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Barang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #333;
            padding-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #333;
        }
        .header p {
            margin: 5px 0;
            color: #666;
        }
        .info-box {
            background-color: #f5f5f5;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .info-box h3 {
            margin: 0 0 10px 0;
            font-size: 14px;
            color: #333;
        }
        .stats {
            display: table;
            width: 100%;
            margin-bottom: 20px;
        }
        .stat-item {
            display: table-cell;
            width: 33.33%;
            text-align: center;
            padding: 15px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
        }
        .stat-label {
            font-size: 10px;
            color: #666;
            text-transform: uppercase;
            margin-bottom: 5px;
        }
        .stat-value {
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th {
            background-color: #333;
            color: white;
            padding: 10px;
            text-align: left;
            font-size: 11px;
            text-transform: uppercase;
        }
        td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 10px;
            font-weight: bold;
        }
        .badge-blue {
            background-color: #e3f2fd;
            color: #1976d2;
        }
        .badge-green {
            background-color: #e8f5e9;
            color: #388e3c;
        }
        .badge-red {
            background-color: #ffebee;
            color: #d32f2f;
        }
        .footer {
            margin-top: 30px;
            padding-top: 10px;
            border-top: 2px solid #333;
            text-align: center;
            font-size: 10px;
            color: #666;
        }
        tfoot {
            background-color: #f5f5f5;
            font-weight: bold;
        }
        tfoot td {
            padding: 12px 8px;
            border-top: 2px solid #333;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN DATA BARANG</h1>
        <p>Dicetak pada: {{ date('d F Y, H:i') }} WIB</p>
        @if($request->filled('tanggal_mulai') || $request->filled('tanggal_akhir'))
            <p>
                Periode: 
                {{ $request->tanggal_mulai ? \Carbon\Carbon::parse($request->tanggal_mulai)->format('d/m/Y') : '-' }}
                s/d
                {{ $request->tanggal_akhir ? \Carbon\Carbon::parse($request->tanggal_akhir)->format('d/m/Y') : '-' }}
            </p>
        @endif
    </div>

    <div class="stats">
        <div class="stat-item">
            <div class="stat-label">Total Barang</div>
            <div class="stat-value">{{ $statistics['total_barang'] }}</div>
        </div>
        <div class="stat-item">
            <div class="stat-label">Total Stok</div>
            <div class="stat-value">{{ number_format($statistics['total_stok'], 0, ',', '.') }}</div>
        </div>
        <div class="stat-item">
            <div class="stat-label">Total Nilai</div>
            <div class="stat-value">Rp {{ number_format($statistics['total_value'], 0, ',', '.') }}</div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 25%;">Nama Barang</th>
                <th style="width: 15%;">Kategori</th>
                <th style="width: 10%;" class="text-center">Stok</th>
                <th style="width: 15%;" class="text-right">Harga</th>
                <th style="width: 15%;" class="text-right">Total Nilai</th>
                <th style="width: 15%;">Tanggal Masuk</th>
            </tr>
        </thead>
        <tbody>
            @foreach($barang as $index => $b)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $b->nama_barang }}</td>
                <td>
                    <span class="badge badge-blue">{{ $b->kategori->nama_kategori ?? '-' }}</span>
                </td>
                <td class="text-center">
                    @if($b->stok <= 10)
                        <span class="badge badge-red">{{ $b->stok }}</span>
                    @else
                        {{ $b->stok }}
                    @endif
                </td>
                <td class="text-right">Rp {{ number_format($b->harga, 0, ',', '.') }}</td>
                <td class="text-right">Rp {{ number_format($b->stok * $b->harga, 0, ',', '.') }}</td>
                <td>{{ \Carbon\Carbon::parse($b->tanggal_masuk)->format('d/m/Y') }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" class="text-right">TOTAL</td>
                <td class="text-center">{{ number_format($barang->sum('stok'), 0, ',', '.') }}</td>
                <td></td>
                <td class="text-right">Rp {{ number_format($barang->sum(function($b) { return $b->stok * $b->harga; }), 0, ',', '.') }}</td>
                <td></td>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        <p>Dokumen ini dicetak secara otomatis oleh Sistem Inventaris Barang</p>
        <p>&copy; {{ date('Y') }} - Sistem Inventaris Barang</p>
    </div>
</body>
</html>