<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $artikel->judul }}</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
            color: #0F172A;
            line-height: 1.6;
        }
        .badge {
            display: inline-block;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
            color: #2563EB;
            background-color: #EFF6FF;
            padding: 4px 10px;
            border-radius: 4px;
            margin-bottom: 10px;
        }
        h1 {
            font-size: 20px;
            margin-bottom: 4px;
        }
        .meta {
            color: #64748B;
            font-size: 10px;
            margin-bottom: 20px;
        }
        .konten {
            margin-top: 15px;
        }
        .konten p {
            margin-bottom: 10px;
        }
        hr {
            border: none;
            border-top: 1px solid #E2E8F0;
            margin: 20px 0;
        }
        .footer {
            font-size: 9px;
            color: #94A3B8;
            text-align: center;
        }
    </style>
</head>
<body>

    <span class="badge">{{ ucfirst($artikel->kategori) }}</span>
    <h1>{{ $artikel->judul }}</h1>
    <div class="meta">
        Diperbarui {{ $artikel->updated_at->translatedFormat('d F Y') }}
        @if ($artikel->waktu_baca)
            &middot; {{ $artikel->waktu_baca }}
        @endif
    </div>

    <hr>

    <div class="konten">
        {!! $artikel->konten !!}
    </div>

    <hr>

    <p class="footer">
        Dokumen ini dihasilkan otomatis dari Layanan Jamaah Haji &amp; Umroh.
    </p>

</body>
</html>
