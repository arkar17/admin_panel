@extends('layouts.app')

@section('title', 'Create Role')

@section('content')
    <div>
        <!--main content- start-->
            <!--Create role start-->
            <div class="create-role-parent-container">
                <h1>Create Role</h1>

                <div class="create-role-container">
                    <form action="{{ route('role.store') }}" method="POST">
                        @csrf
                    <div class="create-role-name-container">
                        <p>Enter Role Name:</p>
                        <input type="text" placeholder="Role Name" name="name"/>
                    </div>

                    <div class="create-role-permission-parent-container">
                        <p class="create-role-permission-label">
                            Choose Permission for this role:
                        </p>

                        <div class="create-role-permission-list-container">
                            <div class="create-role-permission-list-row">
                                <p>2D</p>

                                <div class="create-role-permission-checkboxes-container">
                                @foreach ($permissions2ds as $permissions2d)
                                    <div class="create-role-permission-list-row-checkbox-container ">
                                        <input type="checkbox" name="permissions2d[]" id="{{$permissions2d->name}}" value="{{$permissions2d->name}}"/>
                                        <label for="{{$permissions2d->name}}">{{$permissions2d->name}}</label>
                                    </div>
                                @endforeach
                                </div>

                            </div>
                            <div class="create-role-permission-list-row">
                                <p>3D</p>

                                <div class="create-role-permission-checkboxes-container">
                                    @foreach ($permissions3ds as $permissions3d)
                                    <div class="create-role-permission-list-row-checkbox-container ">
                                        <input type="checkbox" name="permissions3d[]" id="{{$permissions3d->name}}" value="{{$permissions3d->name}}"/>
                                        <label for="{{$permissions3d->name}}">{{$permissions3d->name}}</label>
                                    </div>
                                    @endforeach
                                </div>


                            </div>
                            <div class="create-role-permission-list-row">
                                <p>Can Delete</p>

                                <div class="create-role-permission-checkboxes-container">
                                    @foreach ($permissionsdeletes as $permissionsdelete)
                                    <div class="create-role-permission-list-row-checkbox-container ">
                                        <input type="checkbox" name="permissionsdelete[]" id="{{$permissionsdelete->name}}" value="{{$permissionsdelete->name}}"/>
                                        <label for="{{$permissionsdelete->name}}">{{$permissionsdelete->name}}</label>
                                    </div>
                                    @endforeach
                                </div>


                            </div>
                            <div class="create-role-permission-list-row">
                                <p>Can Edit</p>

                                <div class="create-role-permission-checkboxes-container">
                                    @foreach ($permissionsedits as $permissionsedit)
                                    <div class="create-role-permission-list-row-checkbox-container ">
                                        <input type="checkbox" name="permissionsedit[]" id="{{$permissionsedit->name}}" value="{{$permissionsedit->name}}"/>
                                        <label for="{{$permissionsedit->name}}">{{$permissionsedit->name}}</label>
                                    </div>
                                    @endforeach
                                </div>


                            </div>
                            <div class="create-role-permission-list-row">
                                <p>Can View</p>

                                <div class="create-role-permission-checkboxes-container">
                                    @foreach ($permissionsviews as $permissionsview)
                                    <div class="create-role-permission-list-row-checkbox-container ">
                                        <input type="checkbox" name="permissionsview[]" id="{{$permissionsview->name}}" value="{{$permissionsview->name}}"/>
                                        <label for="{{$permissionsview->name}}">{{$permissionsview->name}}</label>
                                    </div>
                                    @endforeach
                                </div>


                            </div>
                            <div class="create-role-permission-list-row">
                                <p>Can Create</p>

                                <div class="create-role-permission-checkboxes-container">
                                    @foreach ($permissionscreates as $permissionscreate)
                                    <div class="create-role-permission-list-row-checkbox-container ">
                                        <input type="checkbox" name="permissionscreate[]" id="{{$permissionscreate->name}}" value="{{$permissionscreate->name}}"/>
                                        <label for="{{$permissionscreate->name}}">{{$permissionscreate->name}}</label>
                                    </div>
                                    @endforeach
                                </div>


                            </div>
                            <div class="create-role-permission-list-row">
                                <p>Other</p>

                                <div class="create-role-permission-checkboxes-container">
                                    @foreach ($permissionsothers as $permissionsother)
                                    <div class="create-role-permission-list-row-checkbox-container ">
                                        <input type="checkbox" name="permissionsother[]" id="{{$permissionsother->name}}" value="{{$permissionsother->name}}"/>
                                        <label for="{{$permissionsother->name}}">{{$permissionsother->name}}</label>
                                    </div>
                                    @endforeach
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="create-permission-btn-container">
                        <button type="submit">Create</button>
                        <button type="reset">Cancel</button>
                    </div>
                    </form>
                </div>
            </div>
            <!--create role end-->
        <!--main content-end-->


    </div>

@endsection
