<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายงานผู้สูงอายุที่อสม. ดูแล</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: normal;
            src: url("{{ public_path('fonts/THSARABUNNEW.ttf') }}") format('truetype');
        }

        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: bold;
            src: url("{{ public_path('fonts/THSARABUNNEW BOLD.ttf') }}") format('truetype');
        }

        @font-face {
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: normal;
            src: url("{{ public_path('fonts/THSARABUNNEW ITALIC.ttf') }}") format('truetype');
        }

        @font-face {
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: bold;
            src: url("{{ public_path('fonts/THSARABUNNEW BOLDITALIC.ttf') }}") format('truetype');
        }

        body {
            font-family: "THSarabunNew";
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <div class="container mt-5"></div>
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items mb-4">
            <h2>รายงานผู้สูงอายุที่ อสม. ดูแล</h2>
        </div>
        <div class="header text-start">
            @if(isset($chvselect) && $chvselect->isNotEmpty())
            <h3>ชื่อ อสม. : {{ $chvselect[0]->fullname }}</h3>
            <h4>ชื่อหมู่บ้าน : {{ $chvselect[0]->village_name }}</h4>
            @endif
        </div>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th style="width: 5%;">ที่</th>
                    <th style="width: 10%;">ชื่อผู้สูงอายุ</th>
                    <th style="width: 5%;">อายุ</th>
                    <th style="width: 10%;">เลขบัตรประชาชน</th>
                    <th style="width: 5%;">บ้านเลขที่</th>
                    <th style="width: 5%;">น้ำหนัก</th>
                    <th style="width: 5%;">ส่วนสูง</th>
                    <th style="width: 5%;">เบอร์ติดต่อ</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($elders as $elder)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ isset($elder->titlename) ? $elder->titlename . ' ' : '' }}{{ $elder->fullname }}</td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($elder->birth_date)->age }} ปี</td>
                    <td class="text-center">{{ $elder->elder_id_card }}</td>
                    <td class="text-center">{{ $elder->address }}</td>
                    <td class="text-center">{{ number_format($elder->weight, 0) }} กก.</td>
                    <td class="text-center">{{ number_format($elder->height, 0) }} ซม.</td>
                    <td class="text-center">{{ $elder->phone }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div style="text-align: right; margin-top: 20px;">
            <p>วันที่พิมพ์: {{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>
        </div>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>