@extends('layouts.app')

@section('title', 'Edit Referee')

@section('content')
    <div>
        <!--Edit referee start-->
        <div class="create-referee-parent-container">
            <h1>Edit Referee</h1>
            <form action="{{ route('referee.update' , $referee->id) }}" method="POST" enctype="multipart/form-data" class="create-referee-container">
                @csrf
                @method('PUT')
                <div class="form-group">
                <!-- form-group -->
                <label class="label">
                    <i class="fa-solid fa-plus"></i>
                    <span class="title">Add Photo</span>
                    <input type="file" id="imgInp" name="profile_img"/>

                    <p>Profile Image</p>
                    <a href="{{ asset('storage/image/'. $referee->image) }}">{{ $referee->image }}</a>
                        <input type="file" class="form-control form-control-md" id="profile_img" name="profile_img">
                    @error('profile_img')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    <div class="preview_img mt-2"></div>
                </label>
                </div>

                <div class="create-referee-inputs-parent-container">
                <div class="create-referee-inputs-row">
                    <div class="create-referee-name-container">
                    <label for="referee-name">Name</label>
                    <input type="text" placeholder="Enter Your Name" name="name" id="name" value="{{ old('name', $referee->name) }}" autofocus>
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                    </div>
                    <div class="create-referee-phno-container">
                    <label for="referee-phno">Phone Number</label>
                    <input type="number" placeholder="Enter Your Phone Number" name="phone" id="phone" value="{{ old('phone', $referee->phone) }}">
                    @error('phone')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    </div>
                </div>

                <div class="create-referee-inputs-row">
                    <div class="create-referee-pw-container">
                    <label for="password">Password</label>
                    <input type="password" placeholder="Enter Password" name="password" id="password"  value="{{ old('password', $referee->password) }}">

                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

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
                            <input list="opid" name="operationstaff_id" placeholder="Enter Operation Staff ID" id="operationstaff_id">
                            <datalist id="opid" name="operationstaff_id">
                                <option>{{$referee->operationstaff_id}}</option>
                                @foreach ($referees as $referee)
                                <option>{{$referee->operationstaff_id}}</option>
                                @endforeach
                            </datalist>
                        </div>
                    </div>
                </div>

                <div class="create-refree-inputs-btns-container">
                    <button type="submit">Edit</button>
                    <button type="button">Cancel</button>
                </div>

                </div>

            </form>
        </div>

    </div>

@endsection


@push('script')
    <script>

    </script>
@endpush
