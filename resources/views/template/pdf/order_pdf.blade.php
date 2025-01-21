<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 30px;
        }

        header {
            margin-bottom: 20px;
        }

        .profile {
            width: 100%;
            text-align: right;
        }

        .profile .name-pt {
            font-size: 14px;
            font-weight: bold;
        }

        .profile .contact-pt {
            margin-top: 5px;
        }

        .contact-pt ul {
            list-style: none;
            padding: 0;
        }

        .line {
            width: 100%;
            height: 2px;
            background-color: black;
            margin: 10px 0;
        }

        .container {
            text-align: center;
            margin-bottom: 20px;
        }

        .detail-order {
            width: 100%;
            margin: auto;
        }

        .detail-order table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .detail-order table th,
        .detail-order table td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }

        .detail-order table th {
            background-color: #f2f2f2;
        }

        .total-row td {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <header>
        <div class="profile">
            <div class="name-pt">ETN</div>
            <div class="contact-pt">
                <ul>
                    <li>PT. Eash Track Nusantara</li>
                    <li>Alamat</li>
                    <li>Telp</li>
                </ul>
            </div>
        </div>
        <div class="line"></div>
    </header>
    <div class="container">
        <h2>DATA ORDER BARANG</h2>
    </div>
    <div class="detail-order">
        <table>
            <tr>
                <td style="width: 30%; text-align: left">No. Order</td>
                <td style="width: 70%; text-align: left">: {{ $orders->first()->id_order }}</td>
            </tr>
            <tr>
                <td style="width: 30%; text-align: left">Hari/Tanggal</td>
                <td style="width: 70%; text-align: left">: {{ \Carbon\Carbon::parse($orders->first()->created_at)->format('d-m-y') }}</td>
            </tr>
            <tr>
                <td style="width: 30%; text-align: left">Pemesan</td>
                <td style="width: 70%; text-align: left">: {{ $orders->first()->nama_customer }}</td>
            </tr>
            <tr>
                <td style="width: 30%; text-align: left">Deadline</td>
                <td style="width: 70%; text-align: left">: {{ \Carbon\Carbon::parse($orders->first()->deadline)->format('d-m-y') }}</td>
            </tr>
        </table>
        <table>
            <thead>
                <tr>
                    <th>NO</th>
                    <th>ID PRODUK</th>
                    <th>NAMA BARANG</th>
                    <th>QTY</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $index => $order)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $order->id_produk }}</td>
                        <td>{{ $order->nama }}</td>
                        <td>{{ $order->qty }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="total-row">
                    <td colspan="3">Total :</td>
                    <td>Value total</td>
                </tr>
            </tfoot>
        </table>
    </div>
</body>

</html>
