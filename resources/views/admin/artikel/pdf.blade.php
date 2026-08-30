<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>{{ $artikel->judul }}</title>
    <style>
        @page {
            margin: 90px 50px 70px 50px;
        }

        body {
            font-family: "DejaVu Sans", sans-serif;
            font-size: 11px;
            color: #0F172A;
            line-height: 1.6;
        }

        header {
            position: fixed;
            top: -70px;
            left: 0;
            right: 0;
            height: 60px;
            border-bottom: 1px solid #E2E8F0;
            padding-bottom: 10px;
        }

        footer {
            position: fixed;
            bottom: -50px;
            left: 0;
            right: 0;
            height: 40px;
            border-top: 1px solid #E2E8F0;
            padding-top: 8px;
            font-size: 9px;
            color: #94A3B8;
            text-align: center;
        }

        .header-brand {
            font-size: 12px;
            font-weight: bold;
            color: #2563EB;
        }

        .header-sub {
            font-size: 9px;
            color: #64748B;
        }

        .badge {
            display: inline-block;
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
            color: #2563EB;
            background-color: #EFF6FF;
            padding: 4px 10px;
            border-radius: 4px;
            margin-bottom: 10px;
        }

        h1.judul {
            font-size: 20px;
            margin: 0 0 6px 0;
            color: #0F172A;
        }

        .meta {
            color: #64748B;
            font-size: 9px;
            margin-bottom: 18px;
        }

        hr {
            border: none;
            border-top: 1px solid #E2E8F0;
            margin: 16px 0;
        }

        .thumbnail {
            width: 100%;
            max-height: 260px;
            margin-bottom: 16px;
        }

        /* ==================== Konten dari Quill ==================== */
        .konten h1,
        .konten h2,
        .konten h3,
        .konten h4,
        .konten h5,
        .konten h6 {
            color: #0F172A;
            margin-top: 16px;
            margin-bottom: 8px;
        }

        .konten h1 {
            font-size: 18px;
        }

        .konten h2 {
            font-size: 16px;
        }

        .konten h3 {
            font-size: 14px;
        }

        .konten h4,
        .konten h5,
        .konten h6 {
            font-size: 12px;
        }

        .konten p {
            margin: 0 0 10px 0;
            text-align: justify;
        }

        .konten strong {
            font-weight: bold;
        }

        .konten em {
            font-style: italic;
        }

        .konten u {
            text-decoration: underline;
        }

        .konten s {
            text-decoration: line-through;
        }

        .konten ul,
        .konten ol {
            margin: 0 0 10px 0;
            padding-left: 20px;
        }

        .konten li {
            margin-bottom: 4px;
        }

        .konten blockquote {
            border-left: 3px solid #2563EB;
            background-color: #EFF6FF;
            margin: 0 0 10px 0;
            padding: 8px 14px;
            color: #334155;
            font-style: italic;
        }

        .konten pre,
        .konten .ql-code-block-container {
            background-color: #0F172A;
            color: #E2E8F0;
            padding: 10px 14px;
            border-radius: 4px;
            font-family: "DejaVu Sans Mono", monospace;
            font-size: 10px;
            margin-bottom: 10px;
            white-space: pre-wrap;
        }

        .konten a {
            color: #2563EB;
            text-decoration: underline;
        }

        .konten img {
            max-width: 100%;
            margin: 10px 0;
        }

        /* Alignment dari Quill */
        .konten .ql-align-center {
            text-align: center;
        }

        .konten .ql-align-right {
            text-align: right;
        }

        .konten .ql-align-justify {
            text-align: justify;
        }

        /* Indent dari Quill */
        .konten .ql-indent-1 {
            padding-left: 20px;
        }

        .konten .ql-indent-2 {
            padding-left: 40px;
        }

        .konten .ql-indent-3 {
            padding-left: 60px;
        }

        /* ==================== Tabel dari quill-table-better ==================== */
        .konten table {
            width: 100%;
            border-collapse: collapse;
            margin: 12px 0 16px 0;
            font-size: 10px;
        }

        .konten table td,
        .konten table th {
            border: 1px solid #CBD5E1;
            padding: 6px 8px;
            text-align: left;
            vertical-align: top;
        }

        .konten table th {
            background-color: #F1F5F9;
            font-weight: bold;
        }

        .konten table tr:nth-child(even) td {
            background-color: #F8FAFC;
        }

        .footer-note {
            font-size: 9px;
            color: #94A3B8;
        }
    </style>
</head>

<body>

    <header>
        <span class="header-brand">Layanan Jamaah Haji &amp; Umroh</span><br>
        <span class="header-sub">Dokumen Panduan &amp; Pencegahan</span>
    </header>

    <footer>
        Dokumen ini dihasilkan otomatis dari Layanan Jamaah Haji &amp; Umroh
        &middot; {{ now()->translatedFormat('d F Y') }}
    </footer>

    <span class="badge">{{ ucfirst($artikel->kategori) }}</span>
    <h1 class="judul">{{ $artikel->judul }}</h1>
    <div class="meta">
        Diperbarui {{ $artikel->updated_at->translatedFormat('d F Y') }}
        @if ($artikel->waktu_baca)
            &middot; {{ $artikel->waktu_baca }}
        @endif
    </div>

    @if ($artikel->thumbnail)
        <img class="thumbnail" src="{{ public_path('uploads/artikel-thumbnail/' . $artikel->thumbnail) }}">
    @endif

    <hr>

    <div class="konten">
        {!! $artikel->konten !!}
    </div>

</body>

</html>
