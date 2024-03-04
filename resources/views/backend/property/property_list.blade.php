@php
    use Illuminate\Support\Facades\Auth;
    $role = Auth::user()->role;
@endphp
@extends('backend.layouts.app')
@section('PageTitle', 'Property List')
@section('content')
    <style>
        .title-single {
            max-height: 100px;
            /* Adjust height as needed */
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: normal;
        }
    </style>

    <!--breadcrumb -->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Property</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route($role . '-profile') }}"><i
                                class="bx
                    bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Property List</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb -->

    <div class="card">
        <div class="card-body">
            <div class="table-responsive" style="overflow-x: auto;">
                <div class="d-flex align-items-center" style="margin-bottom: 20px">

                    @if ($role === 'admin')
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle radius-30 mt-2 mt-lg-0" type="button"
                                id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bx bx-menu"></i> Status
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li><a class="dropdown-item" href="{{ route('property-list', ['status' => 'all']) }}"><i
                                            class="bx bxs-plus-square"></i> All</a></li>
                                <li><a class="dropdown-item" href="{{ route('property-list', ['status' => 'new']) }}"><i
                                            class="bx bxs-plus-square"></i> New</a></li>
                                <li><a class="dropdown-item"
                                        href="{{ route('property-list', ['status' => 'in-contact']) }}"><i
                                            class="bx bxs-plus-square"></i> In-Contact</a></li>
                                <li><a class="dropdown-item" href="{{ route('property-list', ['status' => 'pending']) }}"><i
                                            class="bx bxs-plus-square"></i> Pending</a></li>
                                <li><a class="dropdown-item"
                                        href="{{ route('property-list', ['status' => 'accepted']) }}"><i
                                            class="bx bxs-plus-square"></i> Accepted</a></li>
                                <li><a class="dropdown-item"
                                        href="{{ route('property-list', ['status' => 'completed']) }}"><i
                                            class="bx bxs-plus-square"></i> Completed</a></li>
                                <li><a class="dropdown-item" href="{{ route('property-list', ['status' => 'sold']) }}"><i
                                            class="bx bxs-plus-square"></i> Sold</a></li>

                            </ul>

                        </div>
                        <div class="ms-auto">
                            <a href="{{ route('property-add') }}" class="btn btn-primary radius-30 mt-2 mt-lg-0">
                                <i class="bx bxs-plus-square"></i> Add New Property
                            </a>
                        </div>
                    @else
                        <a href="{{ route('property-add') }}" class="btn btn-primary radius-30 mt-2 mt-lg-0">
                            <i class="bx bxs-plus-square"></i> Add New Property
                        </a>
                    @endif

                </div>


                <div class="container-fluid" style="overflow-x: auto;">
                    <div class="row flex-nowrap">
                        <div class="col-lg-4 bg-light-info align-items-center justify-content-center">

                        </div>

                        <div class="col-lg-4 bg-light-danger">a</div>
                        <div class="col-lg-4 bg-light-warning">a</div>
                        <div class="col-lg-4 bg-light-success">a</div>
                        <div class="col-lg-4 bg-light-danger">a</div>
                        <div class="col-lg-4 bg-light-info">a</div>
                    </div>
                </div>

                <div class="row">
                    @foreach ($data as $item)
                        <div class="col-lg-4 col-md-5 col-sm-6 mb-4">
                            <div class="card p-2">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <p class="card-text">#{{ $item->id }}</p>

                                        <p
                                            class="badge rounded-pill bg-light-{{ $item->status === 'in-contact'
                                                ? 'secondary'
                                                : ($item->status === 'pending'
                                                    ? 'warning'
                                                    : ($item->status === 'accepted'
                                                        ? 'success'
                                                        : ($item->status === 'completed'
                                                            ? 'primary'
                                                            : ($item->status === 'sold'
                                                                ? 'dark'
                                                                : 'info')))) }}

                                                                    ($item->status === 'sold' ? 'light' : 'info')
)))) }}
                                                                    text-{{ $item->status === 'in-contact'
                                                                        ? 'secondary'
                                                                        : ($item->status === 'pending'
                                                                            ? 'warning'
                                                                            : ($item->status === 'accepted'
                                                                                ? 'success'
                                                                                : ($item->status === 'completed'
                                                                                    ? 'primary'
                                                                                    : ($item->status === 'sold'
                                                                                        ? 'light'
                                                                                        : 'info')))) }}


                                          ">
                                            {{ $item->status }}
                                        </p>




                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <h5 class="card-subtitle mb-2 text-muted text-truncate"
                                            title="{{ $item->title }}">
                                            {{ \Illuminate\Support\Str::limit($item->title, 30) }}
                                        </h5>
                                    </div>


                                    <div>
                                        <h6 class="card-subtitle mb-2 text-muted" title="{{ $item->location }}">
                                            {{ \Illuminate\Support\Str::limit($item->location, 20) }}</h6>
                                        <p class="card-text">$ {{ $item->price }}</p>
                                    </div>
                                    @php
                                        $user = DB::table('users')
                                            ->where('id', $item->user_id)
                                            ->first();
                                    @endphp
                                    @if ($item->user_id)
                                        <div>
                                            <span>Assigned Employee :<b> {{ $user->name }}</b></span>
                                        </div>
                                    @endif
                                    <div>
                                        <span>Created At :<b>
                                                {{ Carbon\Carbon::parse($item->updated_at)->format('d M Y') }}</b></span>
                                    </div>
                                    <div>
                                        <span class="badge badge-primary">Status</span>
                                    </div>

                                    <div class="d-flex justify-content-between">
                                        <a href="#" class="card-link" title="{{ $item->property_link }}">
                                            Visit Site</a>
                                        <a href="" class="btn btn-sm btn-secondary" data-bs-toggle="modal"
                                            data-bs-target="#exampleFullScreenModal-{{ $item->id }}">Details</a>

                                        <div class="modal fade" id="exampleFullScreenModal-{{ $item->id }}"
                                            tabindex="-1" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog modal-fullscreen">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">View Property</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <!-- ======= Intro Single ======= -->
                                                                <section class="intro-single">
                                                                    <div class="container-fluid">
                                                                        <div class="row">
                                                                            <div class="col-md-12 col-lg-12">
                                                                                <nav aria-label="breadcrumb"
                                                                                    class="breadcrumb-box d-flex justify-content-lg-end">
                                                                                    <ol class="breadcrumb">
                                                                                        <li class="breadcrumb-item">
                                                                                            <p>Property ID :</p>
                                                                                        </li>
                                                                                        <li class="breadcrumb-item active"
                                                                                            aria-current="page">
                                                                                            <b>{{ $item->id }}</b>
                                                                                        </li>
                                                                                    </ol>
                                                                                </nav>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-8">
                                                                                <div class="title-single-box">
                                                                                    <h3 class="title-single">
                                                                                        {{ $item->title }}</h3>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-4">
                                                                                <div
                                                                                    class="title-single-box justify-content-end">
                                                                                    <h5 class="title-single text-end">
                                                                                        ${{ $item->price }}
                                                                                    </h5>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>

                                                                </section>
                                                                <!-- End Intro Single-->

                                                                <!-- ======= Property Single ======= -->
                                                                <section class="property-single nav-arrow-b">
                                                                    <div class="container">
                                                                        <div class="row justify-content-center">

                                                                            <div class="row">
                                                                                <div class="col-sm-12">

                                                                                    <div
                                                                                        class="row justify-content-between">
                                                                                        <div class="col-md-5 col-lg-4">
                                                                                            <div class="property-summary">
                                                                                                <div class="row">
                                                                                                    <div class="col-sm-12">
                                                                                                        <div
                                                                                                            class="title-box-d section-t4">
                                                                                                            <h4
                                                                                                                class="title-d">
                                                                                                                Quick
                                                                                                                Summary
                                                                                                            </h4>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="summary-list">
                                                                                                    <ul class="list">
                                                                                                        <li class="d-flex">
                                                                                                            <strong>Property
                                                                                                                Link:&nbsp;&nbsp;</strong>
                                                                                                            <span>
                                                                                                                <a
                                                                                                                    href="  {{ $item->property_link }}">click
                                                                                                                    here</a></span>
                                                                                                        </li>
                                                                                                        @if ($item->user_id)
                                                                                                            <li
                                                                                                                class="d-flex">
                                                                                                                <strong>Assigned
                                                                                                                    Employe:&nbsp;&nbsp;</strong>
                                                                                                                @if ($item->user_id)
                                                                                                                    <span>{{ $user->name }}</span>
                                                                                                                @endif
                                                                                                            </li>
                                                                                                        @else
                                                                                                            <li
                                                                                                                class="d-flex justify-content-between">
                                                                                                                <strong>Assign
                                                                                                                    Employe:</strong>
                                                                                                                <span>
                                                                                                                    <input
                                                                                                                        type="hidden"
                                                                                                                        name="property_id"
                                                                                                                        id="property_id"
                                                                                                                        readonly
                                                                                                                        value="{{ $item->id }}">
                                                                                                                    <select
                                                                                                                        name="user_id"
                                                                                                                        id="assign_employee"
                                                                                                                        class="form-control"
                                                                                                                        required>
                                                                                                                        <option
                                                                                                                            value="">
                                                                                                                            Assign
                                                                                                                            Employee
                                                                                                                        </option>
                                                                                                                        @foreach ($users as $employee)
                                                                                                                            <option
                                                                                                                                value="{{ $employee->id }}">
                                                                                                                                {{ $employee->name }}
                                                                                                                            </option>
                                                                                                                        @endforeach
                                                                                                                    </select>
                                                                                                                </span>

                                                                                                            </li>
                                                                                                        @endif
                                                                                                        <li class="d-flex">
                                                                                                            <strong>Property
                                                                                                                Status:&nbsp;&nbsp;</strong>
                                                                                                            <span
                                                                                                                class="badge rounded-pill bg-primary">{{ $item->status }}</span>
                                                                                                        </li>
                                                                                                        <li class="d-flex">
                                                                                                            <strong>Created
                                                                                                                At:&nbsp;&nbsp;</strong>
                                                                                                            <span
                                                                                                                class="">{{ Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</span>
                                                                                                        </li>
                                                                                                        {{-- <li class="d-flex">
                                                                                                            <strong>Updated At:&nbsp;&nbsp;</strong>
                                                                                                            <span class="">{{ Carbon\Carbon::parse($item->updated_at)->format('d M Y') }}</span>
                                                                                                        </li> --}}
                                                                                                    </ul>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-5 col-lg-8">
                                                                                            <div class="property-summary">
                                                                                                <div class="row">
                                                                                                    <div class="col-sm-12">
                                                                                                        <div
                                                                                                            class="title-box-d section-t4">
                                                                                                            <h4
                                                                                                                class="title-d">
                                                                                                                Property
                                                                                                                Description
                                                                                                            </h4>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="summary-list">
                                                                                                    <p
                                                                                                        class="title-single color-text-a">
                                                                                                        {{ $item->description }}
                                                                                                    </p>
                                                                                                </div>
                                                                                            </div>
                                                                                            <hr>
                                                                                            <div class="col-sm-12">
                                                                                                <div class="row">
                                                                                                    <div class="col-sm-12">
                                                                                                        <div
                                                                                                            class="title-box-d section-t4">
                                                                                                            <h4
                                                                                                                class="title-d">
                                                                                                                Update
                                                                                                                Status
                                                                                                            </h4>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="container mt-3">
                                                                                                    <input type="hidden"
                                                                                                        value="{{ $item->id }}"
                                                                                                        id="property_id_value">
                                                                                                    <button type="button"
                                                                                                        class="btn {{ $item->status === 'new' ? 'btn-success' : 'btn-light' }} toggle-btn">New</button>
                                                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                                                        width="24"
                                                                                                        height="24">
                                                                                                        <path
                                                                                                            d="M7.293 4.707 14.586 12l-7.293 7.293 1.414 1.414L17.414 12 8.707 3.293 7.293 4.707z"
                                                                                                            fill="#ccc" />
                                                                                                    </svg>
                                                                                                    <button type="button"
                                                                                                        class="btn {{ $item->status === 'in-contact' ? 'btn-success' : 'btn-light' }} toggle-btn">In-Contact</button>
                                                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                                                        width="24"
                                                                                                        height="24">
                                                                                                        <path
                                                                                                            d="M7.293 4.707 14.586 12l-7.293 7.293 1.414 1.414L17.414 12 8.707 3.293 7.293 4.707z"
                                                                                                            fill="#ccc" />
                                                                                                    </svg>
                                                                                                    <button type="button"
                                                                                                        class="btn {{ $item->status === 'pending' ? 'btn-success' : 'btn-light' }} toggle-btn">Pending</button>
                                                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                                                        width="24"
                                                                                                        height="24">
                                                                                                        <path
                                                                                                            d="M7.293 4.707 14.586 12l-7.293 7.293 1.414 1.414L17.414 12 8.707 3.293 7.293 4.707z"
                                                                                                            fill="#ccc" />
                                                                                                    </svg>
                                                                                                    <button type="button"
                                                                                                        class="btn {{ $item->status === 'accepted' ? 'btn-success' : 'btn-light' }} toggle-btn">Accepted</button>
                                                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                                                        width="24"
                                                                                                        height="24">
                                                                                                        <path
                                                                                                            d="M7.293 4.707 14.586 12l-7.293 7.293 1.414 1.414L17.414 12 8.707 3.293 7.293 4.707z"
                                                                                                            fill="#ccc" />
                                                                                                    </svg>
                                                                                                    <button type="button"
                                                                                                        class="btn {{ $item->status === 'sold' ? 'btn-success' : 'btn-light' }} toggle-btn">Sold</button>

                                                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                                                        width="24"
                                                                                                        height="24">
                                                                                                        <path
                                                                                                            d="M7.293 4.707 14.586 12l-7.293 7.293 1.414 1.414L17.414 12 8.707 3.293 7.293 4.707z"
                                                                                                            fill="#ccc" />
                                                                                                    </svg>
                                                                                                    <button type="button"
                                                                                                        class="btn {{ $item->status === 'completed' ? 'btn-success' : 'btn-light' }} toggle-btn">Completed</button>

                                                                                                </div>
                                                                                            </div>

                                                                                        </div>
                                                                                        <div class="col-sm-12">
                                                                                            <h4
                                                                                                class="fw-light text-center text-lg-start mt-4 mb-0">
                                                                                                Property Images</h4>
                                                                                            <div class="container">

                                                                                                <hr class="mt-2 mb-5">
                                                                                                <div
                                                                                                    class="row text-center text-lg-start">

                                                                                                    @if (!empty($item->images))
                                                                                                        @foreach (json_decode($item->images) as $image)
                                                                                                            <!-- Page Content -->
                                                                                                            <div
                                                                                                                class="col-lg-3 col-md-4 col-6">
                                                                                                                <a href="{{ url('uploads/images/properties/' . $image) }}"
                                                                                                                    class="d-block mb-4 h-100">
                                                                                                                    <img class="img-fluid img-thumbnail"
                                                                                                                        src="{{ url('uploads/images/properties/' . $image) }}"
                                                                                                                        alt="">
                                                                                                                </a>
                                                                                                            </div>
                                                                                                        @endforeach
                                                                                                </div>
                                                                                            </div>
                    @endif
                </div>

                {{-- </div> --}}
            </div>
        </div>

    </div>
    </section><!-- End Property Single-->

    </div>
    </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close
        </button>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    @endforeach
    </div>



    </div>
    </div>
    </div>
@endsection
@section('plugins')
    <link href="{{ asset('backend_assets') }}/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
@endsection
@section('js')
    <script src="{{ asset('backend_assets') }}/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('backend_assets') }}/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            var table = $('#data_table').DataTable({
                lengthChange: true,
                buttons: ['excel', 'pdf', 'print']
            });

            table.buttons().container()
                .appendTo('#data_table_wrapper .col-md-6:eq(0)');
        });
    </script>

    <script src="sweetalert2.all.min.js"></script>



@section('AjaxScript')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#assign_employee').change(function() {
                var selectedValue = $(this).val(); // Get selected value using jQuery
                var property_id = $('#property_id').val(); // Get the value of property_id input
                console.log(property_id);

                // AJAX request
                $.ajax({
                    type: 'POST',
                    url: "{{ route('assign-property') }}", // URL to submit the form to
                    data: {
                        property_id: property_id, // Pass property_id to the server
                        user_id: selectedValue // Pass selected user_id to the server
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                            'content') // Include CSRF token
                    },
                    success: function(response) {
                        // Handle successful response
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Property assigned successfully!',
                        });
                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'An error occurred while assigning the property.',
                        });
                    }
                });
            });
        });
    </script>
    <script>
        var buttons = document.querySelectorAll('.toggle-btn');

        buttons.forEach(function(button) {
            button.addEventListener('click', function() {
                // Remove 'btn-success' class from all buttons
                buttons.forEach(function(btn) {
                    btn.classList.remove('btn-success');
                    btn.classList.add('btn-light');
                });

                // Add 'btn-success' class to the clicked button
                button.classList.remove('btn-light');
                button.classList.add('btn-success');

                var property_id = $(this).closest('.container').find('#property_id_value')
                    .val(); // Fetch property ID dynamically
                var status = button.textContent.trim();
                // Send AJAX request
                $.ajax({
                    url: '/update-property-status/' + property_id,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // Assuming you're using CSRF protection
                    },
                    data: {
                        status: status
                    },
                    success: function(response) {
                        // Show Swal notification
                        Swal.fire('Success', response.message, 'success');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        // Show Swal notification for error
                        Swal.fire('Error', 'An error occurred', 'error');
                    }
                });
            });
        });
    </script>


@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function() {

        });
    </script>
@endsection
@endsection
