@extends ('layouts.app')

@section('content')

    <link rel="stylesheet" href="{{ asset('assets/css/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/modal.css') }}">

    <style>
        .table thead th {
            background-color: var(--theadbg) !important;
        }
    </style>

    <div class="sidebodydiv px-4 py-1">
        <div class="sidebodyhead mb-2">
            <h4 class="m-0">Customer Profile</h4>
        </div>

        <div class="mainbdy">
            {{-- @dd($e_list); --}}
            <!-- Left Content -->  
            <div class="contentleft">
                <div class="cards">
                    <div class="basicdetails mb-2">
                        <div class="maincard leftcard row">
                            <div class="cardshead">
                                <div class="col-12 cardsh5">
                                    <h5 class="mb-0">Customer Details</h5>
                                    
                                    <a href="{{ route('customer.edit-basic',$c_list->id)}}" data-bs-toggle="tooltip"
                                        data-bs-title="Edit Basic Details"><i class="fas fa-pen-to-square"></i></a> 
                                </div>
                            </div>
                            <div
                                class="col-sm-12 col-md-12 col-xl-12 mb-3 d-flex justify-content-center align-items-center">
                                <img src="{{ asset('assets/images/avatar.png') }}" width="125px" height="125px" alt=""
                                    class="profileimg">
                            </div>
                          
                            <div class="row mt-2">
                            <div class="col-sm-12 col-md-12 col-xl-12 mb-3">
                                    <h6 class="mb-0 text-start">Customer Name</h6>
                                    <h5 class="mb-0 text-end">{{ $c_list->c_name }}</h5>
                                </div>
                                <div class="col-sm-12 col-md-12 col-xl-12 mb-3">
                                    <h6 class="mb-0 text-start">contact</h6>
                                    <h5 class="mb-0 text-end">{{ $c_list->c_contact }}</h5>
                                </div>
                                <div class="col-sm-12 col-md-12 col-xl-12 mb-3">
                                    <h6 class="mb-0 text-start">Location</h6>
                                    <h5 class="mb-0 text-end">{{ $c_list->c_location }}</h5>
                                </div>
                                <div class="col-sm-12 col-md-12 col-xl-12 mb-3">
                                    <h6 class="mb-0 text-start">c_type</h6>
                                    <h5 class="mb-0 text-end">{{ $c_list->c_type }}</h5>
                                </div>
                                <div class="col-sm-12 col-md-12 col-xl-12 mb-3">
                                    <h6 class="mb-0 text-start">p_type</h6>
                                    <h5 class="mb-0 text-end">{{ $c_list->permission_type }}</h5>
                                </div>
                                <div class="col-sm-12 col-md-12 col-xl-12 mb-3">
                                    <h6 class="mb-0 text-start">p_time</h6>
                                    <h5 class="mb-0 text-end">{{ $c_list->permission_time }}</h5>
                                </div>
                                
                            </div>
                           
                        </div>
                    </div>

                </div>
            </div>


            <!-- Right Content -->
            <div class="contentright">
                <div class="proftabs">
                    <ul class="nav nav-tabs d-flex justify-content-start align-items-center gap-md-3 gap-xl-3" id="myTab"
                        role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="profiletabs active" id="attendance-tab" role="tab" data-bs-toggle="tab"
                                type="button" data-bs-target="#attendance" aria-controls="attendance"
                                aria-selected="true">Customers</button>
                        </li>
                        <!-- <li class="nav-item" role="presentation">
                            <button class="profiletabs" id="salary-tab" role="tab" data-bs-toggle="tab" type="button"
                                data-bs-target="#salary" aria-controls="salary" aria-selected="true">Salary</button>
                        </li> -->
                    </ul>
                </div>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="attendance" role="tabpanel" aria-labelledby="attendance-tab">
                        
                    </div>
                    <div class="tab-pane fade" id="salary" role="tabpanel" aria-labelledby="salary-tab">
                       
                    </div>
                </div>
            </div>


        </div>
    </div>

    <!-- Scripts -->
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Datatables List -->
    <script>
        $(document).ready(function () {
            function initTable(tableId, dropdownId, filterInputId) {
                var table = $(tableId).DataTable({
                    "paging": true,
                    "searching": true,
                    "ordering": true,
                    "order": [0, "asc"],
                    "bDestroy": true,
                    "info": false,
                    "responsive": true,
                    "pageLength": 30,
                    "dom": '<"top"f>rt<"bottom"ilp><"clear">',
                });
                $(tableId + ' thead th').each(function (index) {
                    var headerText = $(this).text();
                    if (headerText != "" && headerText.toLowerCase() != "action" && headerText.toLowerCase() != "image") {
                        $(dropdownId).append('<option value="' + index + '">' + headerText + '</option>');
                    }
                });
                $(filterInputId).on('keyup', function () {
                    var selectedColumn = $(dropdownId).val();
                    if (selectedColumn !== 'All') {
                        table.column(selectedColumn).search($(this).val()).draw();
                    } else {
                        table.search($(this).val()).draw();
                    }
                });
                $(dropdownId).on('change', function () {
                    $(filterInputId).val('');
                    table.search('').columns().search('').draw();
                });
                $(filterInputId).on('keyup', function () {
                    table.search($(this).val()).draw();
                });
            }
            initTable('#table1', '#headerDropdown1', '#filterInput1');
            initTable('#table2', '#headerDropdown2', '#filterInput2');
        });
    </script>
    
    


@endsection