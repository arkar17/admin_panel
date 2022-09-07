   <html>
    <head>
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            body{
                font-family: Arial, Helvetica, sans-serif;
            }
            th, td {
                    padding: 15px;
                    text-align: left;
                    }
            th{
                    color: #0b0bbb;
                    font-size: 1em;
            }
            table {
                    width: 100%;
                    border-collapse: collapse;
                    }
        </style>
    </head>
    <body>
        <div class="role-view-detail-parent-container">
            <h2>Customers' Data</h2>
            <div>
                <center>
                <table>
                    <th>ID</th>
                    <th>Agent Name</th>
                    <th>Number</th>
                    <th>Customer Name</th>
                    <th>Customer Phone</th>
                    <th>Sale Amount</th>
                    <th>Date</th>

                @foreach ($twodsalelists as $twodsalelist)
                    <tr>
                        <td>{{$twodsalelist->id}}</td>
                        <td>{{$agent->user->name}}</td>
                        <td>{{$twodsalelist->twod->number}}</td>
                        <td>{{$twodsalelist->customer_name}}</td>
                        <td>{{$twodsalelist->customer_phone}}</td>
                        <td>{{$twodsalelist->sale_amount}}</td>
                        <td>{{$twodsalelist->datetime}}</td>

                    </tr>
                @endforeach
                @foreach ($threedsalelists as $threedsalelist)
                    <tr>
                        <td>{{$threedsalelist->id}}</td>
                        <td>{{$agent->user->name}}</td>
                        <td>{{$threedsalelist->threed->number}}</td>
                        <td>{{$threedsalelist->customer_name}}</td>
                        <td>{{$threedsalelist->customer_phone}}</td>
                        <td>{{$threedsalelist->sale_amount}}</td>
                        <td>{{$threedsalelist->datetime}}</td>

                    </tr>
                @endforeach
                @foreach ($lonepyinesalelists as $lonepyinesalelist)
                    <tr>
                        <td>{{$lonepyinesalelist->id}}</td>
                        <td>{{$agent->user->name}}</td>
                        <td>{{$lonepyinesalelist->lonepyine->number}}</td>
                        <td>{{$lonepyinesalelist->customer_name}}</td>
                        <td>{{$lonepyinesalelist->customer_phone}}</td>
                        <td>{{$lonepyinesalelist->sale_amount}}</td>
                        <td>{{$lonepyinesalelist->datetime}}</td>

                    </tr>
                @endforeach
                </table>
                </center>
            </div>
        </div>
    </body>
    <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
   </html>
