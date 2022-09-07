@extends('layouts.app')

@section('title', 'Show Agent')

@section('custom_css')
    <style>
        .client_img {
            width: 120px;
            height: 120px;
            /* border: 2px solid #ddd; */
            /* border-radius: 10px; */
            padding: 3px;
        }
    </style>
@endsection

@section('content')
    <div>
        <!--referee view detail start-->
        <div class="role-view-detail-parent-container">
            <h1>Referee Information</h1>

            <div class="role-view-detail-container">
                <div class="role-view-detail-attributes-container">
                    <div class="role-view-detail-attribute">
                        <img src="{{asset('storage/image/'.$referee->image) }}" class="" alt="">
                    </div>
                    <div class="role-view-detail-attribute">
                        <p>Name:</p>
                        <p>{{$referee->name}}</p>
                    </div>
                    <div class="role-view-detail-attribute">
                        <p>Phone:</p>
                        <p> {{ $referee->phone }}</p>
                    </div>
                </div>

                <a href="{{url()->previous()}}">Go Back</a>
            </div>
        </div>
    </div>

@endsection


@push('script')
    <script>

    </script>
@endpush
