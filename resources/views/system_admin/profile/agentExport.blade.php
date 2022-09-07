<table>
    <thead>
    <tr>
        <th>Customer Name</th>
        <th>Customer Phone No</th>
        <th>Number</th>
        <th>Sales Amount</th>
    </tr>
    </thead>
    <tbody>
    @foreach($twod_salelists as $twod_salelist)
        <tr>
            <td>{{$twod_salelist->id}}</td>
            <td>{{$twod_salelist->customer_name}}</td>
            <td>{{$twod_salelist->customer_phone}}</td>
            <td>{{$twod_salelist->sale_amount}}</td>
        </tr>
    @endforeach

    @foreach($threed_salelists as $threed_salelist)
    <tr>
        <td>{{$threed_salelist->id}}</td>
        <td>{{$threed_salelist->customer_name}}</td>
        <td>{{$threed_salelist->customer_phone}}</td>
        <td>{{$threed_salelist->sale_amount}}</td>
    </tr>
@endforeach
    </tbody>
</table>

