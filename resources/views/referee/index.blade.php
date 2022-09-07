@extends('layouts.app')

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

        <!--Create referee start-->

        <div class="create-referee-parent-container">
            <h1>Create Referee</h1>
            <form action="{{ route('referee.store') }}" method="POST" enctype="multipart/form-data" class="create-referee-container">
                @csrf
                <div class="form-group">
                <!-- form-group -->
                <label class="label">
                    <i class="fa-solid fa-plus"></i>
                    <span class="title">Add Photo</span>
                    <input type="file" id="imgInp" name="profile_img"/>
                </label>
                </div>

                <div class="create-referee-inputs-parent-container">
                <div class="create-referee-inputs-row">
                    <div class="create-referee-name-container">
                    <label for="referee-name">Name</label>
                    <input type="text" id="name" name="name" placeholder="Enter Your Name"/>
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    </div>
                    <div class="create-referee-phno-container">
                    <label for="referee-phno">Phone Number</label>
                    <input type="text" id="phone" name="phone" placeholder="Enter Your Phone Number"/>
                    @error('phone')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    </div>
                </div>

                <div class="create-referee-inputs-row">
                    <div class="create-referee-pw-container">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter Password"/>
                    </div>
                    <div class="create-referee-confirmpw-container">
                    <label for="referee-confirmpw">Confirm Password</label>
                    <input type="password" id="referee-confirmpw" name="confirmpasword" placeholder="Re-enter Password"/>
                    </div>
                </div>

                <div class="create-referee-inputs-row">
                    <div class="create-referee-name-container">
                        <div class="create-referee-pw-container">
                            <label for="referee-pw">Operation Staff ID</label>
                            <input list="opid" name="parent_id" placeholder="Enter Operation Staff ID" id="operationstaff_id">
                            <datalist id="opid" name="parent_id">
                                @foreach ($referees as $referee)
                                <option>{{$referee->operationstaff_id}}</option>
                                @endforeach
                            </datalist>
                        </div>
                    </div>
                </div>

                <div class="create-refree-inputs-btns-container">
                    <button type="submit">Create Referee</button>
                    <button type="button">Cancel</button>
                </div>

                </div>

            </form>
        </div>

        <!--create referee end-->

        <div class="section-line"></div>

        <!--referee list start-->
        <div class="referee-list-parent-container">
            <h1>Referee List</h1>
            <div class="referee-list-container">
            <div class="referee-list-labels-container">
                <h2>ID</h2>
                <h2>Name</h2>
                <h2>Phone Number</h2>
                <h2>Image</h2>
                <h2>Action</h2>

            </div>

            <div class="referee-list-rows-container">
                @foreach ($referees as $referee)
                    <div class="referee-list-row">
                        <p>{{$referee->id}}</p>
                        <p>{{$referee->name}}</p>
                        <p>{{$referee->phone}}</p>
                        <p>
                            <img src="{{asset('storage/referee/'.$referee->image)}}">
                        </p>
                        <div class="referee-list-row-actions-container">
                            <a href="{{route('refreeprofile',$referee->id)}}">
                                <iconify-icon icon="ant-design:exclamation-circle-outlined" class="referee-list-row-icon"></iconify-icon>
                            </a>
                            <a href="{{route('referee.edit',$referee->id)}}">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </a>
                            <a href="{{route('referee.destroy',$referee->id)}}">
                                <i class="fa-regular fa-trash-can"></i>
                            </a>
                        </div>
                    </div>
                @endforeach

            </div>
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
