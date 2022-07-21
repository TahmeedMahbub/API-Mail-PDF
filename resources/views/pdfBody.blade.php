<!DOCTYPE html>
<html>
<head>
    <title>PDF Using API</title>
    <style>
        #invoiceTable {
          font-family: Arial, Helvetica, sans-serif;
          border-collapse: collapse;
          width: 100%;
        }
        
        #invoiceTable td, #invoiceTable th {
          border: 1px solid #ddd;
          padding: 8px;
        }
        
        #invoiceTable tr:nth-child(even){background-color: #f2f2f2;}
        
        #invoiceTable tr:hover {background-color: #ddd;}
        
        #invoiceTable th {
          padding-top: 12px;
          padding-bottom: 12px;
          text-align: left;
          background-color: #560079;
          color: white;
        }

        h1{
            font-family: "Lucida Console", "Courier New", monospace;
            font-size: 45px;
        }

        th{
            font-family: "Lucida Console", "Courier New", monospace;
            font-size: 20px;
        }
        a{
            text-decoration: none;
        }

    </style>
</head>

<body>
    <center><h1>Invoice List</h1></center>
    <table id="invoiceTable">
        <tr>
            <th>Invoice No</th>
            <th>Customer Name</th>
            <th>Payment Method</th>
            <th>Date & Time</th>
        </tr>
        @foreach ($invoices as $invoice)
            <tr>
                <td>GNT{{ $invoice->invoice_number }}</td>
                <td>
                    @if($invoice->customer_name)
                        {{ ucfirst($invoice->customer_name) }}
                    @else
                        Not Given!
                    @endif
                </td>
                <td>{{ $invoice->payment_method }}</td>
                <td>{{ date_format(date_create($invoice->created_at), "d-M-Y, h:i:sa") }}</td>
                
            </tr>
        @endforeach
    </table>

</html>