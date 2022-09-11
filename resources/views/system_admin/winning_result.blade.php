@extends('system_admin.layouts.app')

@section('title', 'Referees')

@section('custom_css')
    <style>
        .client_img {
            width: 60px;
            height: 60px;
            border: 2px solid #ddd;
            border-radius: 10px !important;
            padding: 3px;
        }

    </style>
@endsection

@section('content')
    <div>
        @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade in">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
                <strong>{{ Session::get('success') }}</strong>
            </div>
        @endif
        <div class="section-line"></div>

        <!--referee list start-->
        <div class="referee-list-parent-container">
            <h1>Winning Result</h1>
            <div class="referee-list-container">
                <form action="{{ route('add_winningstatus') }}" method="POST" enctype="multipart/form-data" class="create-user-container">
                    @csrf
                    <select name="type">
                        <option value="">Select Type</option>
                        <option value="2d">2D</option>
                        <option value="3d">3D</option>
                    </select>
                    <input type="number" name="number">
                    <button type="submit">Submit</button>
                </form>
            </div>

        </div>
    </div>

    <div>
        <h3>Winning 2D/Lonepyine Number Lists</h3>
        <table style=" border: 1px solid black;">
            <tr>
                <th>id</th>
                <th>Agent Name</th>
                <th>Number</th>
                <th>Customer Name</th>
                <th>Customer Phone</th>
                <th>Round</th>
                <th>Date Time</th>
            </tr>

            @foreach ($twodnumbers as $twodnumber)
            <tr>
                <td>2D-{{$twodnumber->id}}</td>
                <td>{{$twodnumber->name}}</td>
                <td>{{$twodnumber->number}}</td>
                <td>{{$twodnumber->customer_name}}</td>
                <td>{{$twodnumber->customer_phone}}</td>
                <td>{{$twodnumber->round}}</td>
                <td>{{$twodnumber->date}}</td>
            </tr>
            @endforeach
            @foreach ($lonepyinenumbers as $lonepyinenumber)
            <tr>
                <td>LP-{{$lonepyinenumber->id}}</td>
                <td>{{$lonepyinenumber->name}}</td>
                <td>{{$lonepyinenumber->number}}</td>
                <td>{{$lonepyinenumber->customer_name}}</td>
                <td>{{$lonepyinenumber->customer_phone}}</td>
                <td>{{$lonepyinenumber->round}}</td>
                <td>{{$lonepyinenumber->date}}</td>
            </tr>
            @endforeach
        </table>
        <h3>Winning 3D Number Lists</h3>
        <table style=" border: 1px solid black;">
            <tr>
                <th>id</th>
                <th>Agent Name</th>
                <th>Number</th>
                <th>Customer Name</th>
                <th>Customer Phone</th>
                <th>Date Time</th>
            </tr>

            @foreach ($threednumbers as $threednumber)
            <tr>
                <td>2D-{{$threednumber->id}}</td>
                <td>{{$threednumber->name}}</td>
                <td>{{$threednumber->number}}</td>
                <td>{{$threednumber->customer_name}}</td>
                <td>{{$threednumber->customer_phone}}</td>
                <td>{{$threednumber->date}}</td>
            </tr>
            @endforeach
        </table>
    </div>

    <script>
    $('#operationstaff-id').on('click',function() {

        var sel=document.getElementById('operationstaff-id');
        console.log(sel.value);

    });

        </script>
@endsection

@push('script')
    <script>

        $(document).ready(function() {
            var table = $('.table');
            $(document).on('click', '.delete-btn', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                swal({
                        text: "Are you sure you want to delete?",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            $.ajax({
                                method: "DELETE",
                                url: `/referee/${id}`
                            }).done(function(res) {
                                location.reload();
                                console.log("deleted");
                            })
                        } else {
                            swal("Your imaginary file is safe!");
                        }
                    });
            })
        })
    </script>
@endpush
