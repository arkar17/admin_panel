@extends('layouts.app')

@section('title', 'Permission')

@section('content')

    <div>
        @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade in">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
                <strong>{{ Session::get('success') }}</strong>
            </div>
        @endif
        <!--main content start-->
        <div class="main-content-parent-container">
            <!--referee profile start-->
            <div class="agent-profile-parent-container">
                <h1>Data - agent Data - Agent Profile</h1>

                <div class="agent-profile-filters-container">
                    <input id="agent-profile-filter-fromdate" type="date" placeholder="From Date" />
                    <input id="agent-profile-filter-todate" type="date" placeholder="To Date" />

                    <button class="agent-profile-filter-btn">
                        <iconify-icon icon="ant-design:search-outlined" class="agent-data-filter-btn-icon"></iconify-icon>
                        <p>Filter</p>
                    </button>

                </div>

                <div class="agent-profile-details-parent-container">
                    <div class="agent-profile-details-container">
                        <div class="agent-profile-img-container">
                            <img src="../assets/imgs/avatar-1.jpg"/>
                        </div>

                        <div class="agent-profile-attributes-container">
                            <div class="agent-profile-attribute">
                                <h3>ID</h3>
                                <p>1</p>
                            </div>
                            <div class="agent-profile-attribute">
                                <h3>Agent Name</h3>
                                <p>Agent 01</p>
                            </div>
                            <div class="agent-profile-attribute">
                                <h3>Phone Number</h3>
                                <p>091234567</p>
                            </div>
                            <div class="agent-profile-attribute">
                                <h3>Total Sale Amount</h3>
                                <p>1000000</p>
                            </div>
                        </div>
                    </div>
                    <div class="agent-profile-chart-container">

                    </div>
                </div>

                <div class="section-line">

                </div>

                <div class="agent-profile-agent-list-parent-container">
                    <div class="agent-profile-agent-list-header">
                        <h1>Agent 01's Customer List</h1>
                        <div class="agent-profile-agent-list-filter">
                            <iconify-icon icon="ant-design:search-outlined" class="agent-profile-agent-list-icon"></iconify-icon>
                            <input list="agents" name="myBrowser" placeholder="Search By Name"/>
                            <datalist id="agents">
                                <option value="Agent 01">
                                <option value="Agent 02">
                                <option value="Agent 03">
                            </datalist>
                        </div>
                    </div>

                    <div class="agent-profile-agent-list-container">
                        <div class="agent-profile-agent-list-labels-container">
                            <h2>ID</h2>
                            <h2>Name</h2>
                            <h2>Phone No.</h2>
                            <h2>Number</h2>
                            <h2>Compensation</h2>
                            <h2>Amount</h2>
                        </div>

                        <div class="agent-profile-agent-list-rows-container">
                            <div class="agent-profile-agent-list-row">
                                <p>1</p>
                                <p>customer 01</p>
                                <p>091234567</p>
                                <p>34</p>
                                <p>85</p>
                                <p>1000ks</p>
                            </div>
                            <div class="agent-profile-agent-list-row">
                                <p>2</p>
                                <p>customer 01</p>
                                <p>091234567</p>
                                <p>34</p>
                                <p>85</p>
                                <p>1000ks</p>
                            </div>
                            <div class="agent-profile-agent-list-row">
                                <p>3</p>
                                <p>customer 01</p>
                                <p>091234567</p>
                                <p>34</p>
                                <p>85</p>
                                <p>1000ks</p>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <!--referee profile end-->
        </div>
        <!--main content end-->
    </div>
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
                                url: `/permission/${id}`
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
