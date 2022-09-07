@extends('layouts.app')

@section('title', 'Edit Role')

@section('content')
    <div>
        <!--Create role start-->
        <div class="create-role-parent-container">
            <h1>Edit Role</h1>

            <div class="create-role-container">
                <form action="{{ route('role.update', $role->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                <div class="create-role-name-container">
                    <p>Enter Role Name:</p>
                    <input type="text" placeholder="Role Name"  value="{{ old('name', $role->name) }}"  name="name" autofocus/>
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
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

                                    <input tabindex="5" type="checkbox" id="{{$permissions2d->name}}"
                                            name="permissions2d[]" class="icheck-minimal-blue" value="{{ $permissions2d->name }}"
                                            @if (in_array($permissions2d->id, $old_permissions2d)) checked @endif>
                                        <label class="icheck-label form-label" for="{{ $permissions2d->name }}">{{ $permissions2d->name }}</label>
                                </div>
                            @endforeach
                            </div>

                        </div>
                        <div class="create-role-permission-list-row">
                            <p>3D</p>

                            <div class="create-role-permission-checkboxes-container">
                                @foreach ($permissions3ds as $permissions3d)
                                <div class="create-role-permission-list-row-checkbox-container ">
                                    <input tabindex="5" type="checkbox" id="{{$permissions3d->name}}"
                                            name="permissions3d[]" class="icheck-minimal-blue" value="{{ $permissions3d->name }}"
                                            @if (in_array($permissions3d->id, $old_permissions3d)) checked @endif>
                                        <label class="icheck-label form-label" for="{{ $permissions3d->name }}">{{ $permissions3d->name }}</label>
                                </div>
                                @endforeach
                            </div>


                        </div>
                        <div class="create-role-permission-list-row">
                            <p>Can Delete</p>

                            <div class="create-role-permission-checkboxes-container">
                                @foreach ($permissionsdeletes as $permissionsdelete)
                                <div class="create-role-permission-list-row-checkbox-container ">
                                    <input tabindex="5" type="checkbox" id="{{$permissionsdelete->name}}"
                                            name="permissionsdelete[]" class="icheck-minimal-blue" value="{{ $permissionsdelete->name }}"
                                            @if (in_array($permissionsdelete->id, $old_permissionsdelete)) checked @endif>
                                        <label class="icheck-label form-label" for="{{ $permissionsdelete->name }}">{{ $permissionsdelete->name }}</label>
                                </div>
                                @endforeach
                            </div>


                        </div>
                        <div class="create-role-permission-list-row">
                            <p>Can Edit</p>

                            <div class="create-role-permission-checkboxes-container">
                                @foreach ($permissionsedits as $permissionsedit)
                                <div class="create-role-permission-list-row-checkbox-container ">
                                    <input tabindex="5" type="checkbox" id="{{$permissionsedit->name}}"
                                            name="permissionsedit[]" class="icheck-minimal-blue" value="{{ $permissionsedit->name }}"
                                            @if (in_array($permissionsedit->id, $old_permissionsedit)) checked @endif>
                                        <label class="icheck-label form-label" for="{{ $permissionsedit->name }}">{{ $permissionsedit->name }}</label>

                                </div>
                                @endforeach
                            </div>


                        </div>
                        <div class="create-role-permission-list-row">
                            <p>Can View</p>

                            <div class="create-role-permission-checkboxes-container">
                                @foreach ($permissionsviews as $permissionsview)
                                <div class="create-role-permission-list-row-checkbox-container ">
                                    <input tabindex="5" type="checkbox" id="{{$permissionsview->name}}"
                                            name="permissionsview[]" class="icheck-minimal-blue" value="{{ $permissionsview->name }}"
                                            @if (in_array($permissionsview->id, $old_permissionsview)) checked @endif>
                                        <label class="icheck-label form-label" for="{{ $permissionsview->name }}">{{ $permissionsview->name }}</label>
                                </div>
                                @endforeach
                            </div>


                        </div>
                        <div class="create-role-permission-list-row">
                            <p>Can Create</p>

                            <div class="create-role-permission-checkboxes-container">
                                @foreach ($permissionscreates as $permissionscreate)
                                <div class="create-role-permission-list-row-checkbox-container ">
                                    <input tabindex="5" type="checkbox" id="{{$permissionscreate->name}}"
                                            name="permissionscreate[]" class="icheck-minimal-blue" value="{{ $permissionscreate->name }}"
                                            @if (in_array($permissionscreate->id, $old_permissionscreate)) checked @endif>
                                        <label class="icheck-label form-label" for="{{ $permissionscreate->name }}">{{ $permissionscreate->name }}</label>
                                </div>
                                @endforeach
                            </div>


                        </div>
                        <div class="create-role-permission-list-row">
                            <p>Other</p>

                            <div class="create-role-permission-checkboxes-container">
                                @foreach ($permissionsothers as $permissionsother)
                                <div class="create-role-permission-list-row-checkbox-container ">
                                    <input tabindex="5" type="checkbox" id="{{$permissionsother->name}}"
                                            name="permissionsother[]" class="icheck-minimal-blue" value="{{ $permissionsother->name }}"
                                            @if (in_array($permissionsother->id, $old_permissionsother)) checked @endif>
                                        <label class="icheck-label form-label" for="{{ $permissionsother->name }}">{{ $permissionsother->name }}</label>
                                </div>
                                @endforeach
                            </div>


                        </div>
                    </div>
                </div>
                <div class="create-permission-btn-container">
                    <button type="submit">Edit</button>
                    <button type="reset">Cancel</button>
                </div>
                </form>
            </div>
        </div>
        <!--create role end-->


    </div>

@endsection
