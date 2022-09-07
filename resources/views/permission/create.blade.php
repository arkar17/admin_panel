@extends('layouts.app')

@section('title', 'Create Permission')

@section('content')
    <div>
        <!--main content start-->
      <div class="main-content-parent-container">
        <!-- create permission start-->
        <div class="create-permission-parent-container">
            <h1>Create Permission</h1>
            <div class="create-permission-outer-container">
                <div class="create-permission-inner-container">
                    <form action="{{ route('permission.store') }}" method="POST">
                        @csrf
                        <div class="create-permission-category-container">
                            <label for="permission-categories">Choose Permission:</label>
                            <select name="status" id="permission-categories">
                                <option></option>
                                <option>2D</option>
                                <option >3D</option>
                                <option>Create</option>
                                <option>View</option>
                                <option>Edit</option>
                                <option>Delete</option>
                                <option>Other</option>
                            </select>
                        </div>
                    <p>Enter Permission Name:</p>
                    <input type="text" name="name"/>
                    <div class="create-permission-btn-container">
                        <button type="submit">Create</button>
                        <button type="reset">Cancel</button>
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
