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
                <form action="{{ route('winningstatus') }}" method="POST" enctype="multipart/form-data" class="create-user-container">
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
