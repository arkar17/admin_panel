@extends('layouts.app')

@section('title', 'Edit Permission')

@section('content')
    <div>
        <!--main content start-->
        <div class="main-content-parent-container">
            <!-- create permission start-->
            <div class="create-permission-parent-container">
                <h1>Edit Permission</h1>
                <div class="create-permission-outer-container">
                    <div class="create-permission-inner-container">
                        <form action="{{ route('permission.update', $permission->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="create-permission-category-container">
                            <label for="permission-categories">Choose Permission:</label>
                            <select name="status" id="permission-categories">
                                @if ($permission->status =='1')
                                <option>2D</option>
                                @elseif ($permission->status =='2')
                                <option>3D</option>
                                @elseif ($permission->status =='3')
                                <option>Create</option>
                                @elseif ($permission->status =='4')
                                <option>View</option>
                                @elseif ($permission->status =='5')
                                <option>Edit</option>
                                @elseif ($permission->status =='6')
                                <option>Delete</option>
                                @elseif ($permission->status =='7')
                                <option>Other</option>
                                @endif

                                <option>2D</option>
                                <option>3D</option>
                                <option>Create</option>
                                <option>View</option>
                                <option>Edit</option>
                                <option>Delete</option>
                                <option>Other</option>
                            </select>
                        </div>
                        <p>Enter Permission Name:</p>
                        <input type="text" value="{{$permission->name}}" name="name"/>
                        <div class="create-permission-btn-container">
                            <button class="submit">Edit</button>
                            <button class="reset">Cancel</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- create permission end-->
        </div>
        <!--main content end-->
    </div>

@endsection
