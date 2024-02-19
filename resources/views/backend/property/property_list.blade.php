@php
    use Illuminate\Support\Facades\Auth;
    $role = Auth::user()->role;
@endphp
@extends('backend.layouts.app')
@section('PageTitle', 'Property List')
@section('content')
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
                @if ($role === 'admin')
                    <div class="ms-auto" style="margin-bottom: 20px">
                        <a href="{{ route('property-add') }}" class="btn btn-primary radius-30 mt-2 mt-lg-0">
                            <i class="bx bxs-plus-square"></i>Add New Property</a>
                    </div>
                @endif
                <div class="row">
                    @foreach ($data as $item)
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                            <div class="card p-2">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <h5 class="card-title">{{ $item->title }}</h5>
                                        <p class="card-text">#{{ $item->id }}</p>
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
                                                                    <div class="container">
                                                                        <div class="row">
                                                                            <div class="col-md-12 col-lg-8">
                                                                                <div class="title-single-box">
                                                                                    <h1 class="title-single">
                                                                                        {{ $item->title }}
                                                                                    </h1>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-12 col-lg-4">
                                                                                <nav aria-label="breadcrumb"
                                                                                    class="breadcrumb-box d-flex justify-content-lg-end">
                                                                                    <ol class="breadcrumb">
                                                                                        <li class="breadcrumb-item">
                                                                                            <p>Property ID :</p>
                                                                                        </li>

                                                                                        <li class="breadcrumb-item active"
                                                                                            aria-current="page">
                                                                                            {{ $item->id }}
                                                                                        </li>
                                                                                    </ol>
                                                                                </nav>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </section><!-- End Intro Single-->

                                                                <!-- ======= Property Single ======= -->
                                                                <section class="property-single nav-arrow-b">
                                                                    <div class="container">
                                                                        <div class="row justify-content-center">

                                                                            <div class="row">
                                                                                <div class="col-sm-12">

                                                                                    <div
                                                                                        class="row justify-content-between">
                                                                                        <div class="col-md-5 col-lg-4">
                                                                                            <div
                                                                                                class="property-price d-flex justify-content-center foo">
                                                                                                <div
                                                                                                    class="card-header-c d-flex">
                                                                                                    <div
                                                                                                        class="card-box-ico">
                                                                                                        <span
                                                                                                            class="bi bi-cash">$</span>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="card-title-c align-self-center">
                                                                                                        <h5 class="title-c">
                                                                                                            {{ $item->price }}
                                                                                                        </h5>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="property-summary">
                                                                                                <div class="row">
                                                                                                    <div class="col-sm-12">
                                                                                                        <div
                                                                                                            class="title-box-d section-t4">
                                                                                                            <h3
                                                                                                                class="title-d">
                                                                                                                Quick
                                                                                                                Summary
                                                                                                            </h3>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="summary-list">
                                                                                                    <ul class="list">
                                                                                                        <li
                                                                                                            class="d-flex justify-content-between">
                                                                                                            <strong>Property
                                                                                                                Link:</strong>
                                                                                                            <span>
                                                                                                                {{ $item->property_link }}</span>
                                                                                                        </li>
                                                                                                        @if ($item->user_id)
                                                                                                            <li
                                                                                                                class="d-flex justify-content-between">
                                                                                                                <strong>Assigned
                                                                                                                    Employe:</strong>
                                                                                                                @if ($item->user_id)
                                                                                                                    <span>{{ $user->name }}</span>
                                                                                                                @endif
                                                                                                            </li>
                                                                                                        @else
                                                                                                            <li
                                                                                                                class="d-flex justify-content-between">
                                                                                                                <strong>Property
                                                                                                                    Link:</strong>
                                                                                                                <span>
                                                                                                                    <select
                                                                                                                        name="user_id"
                                                                                                                        class="form-control"
                                                                                                                        required>
                                                                                                                        <option
                                                                                                                            value="">
                                                                                                                            Assign
                                                                                                                            Employe
                                                                                                                        </option>

                                                                                                                        @foreach ($data as $employe)
                                                                                                                            <option
                                                                                                                                value="{{ $employe->id }}">
                                                                                                                                {{ $employe->name }}
                                                                                                                            </option>
                                                                                                                        @endforeach
                                                                                                                    </select>
                                                                                                                </span>

                                                                                                            </li>
                                                                                                        @endif
                                                                                                    </ul>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div
                                                                                            class="col-md-7 col-lg-7 section-md-t3">
                                                                                            <div class="row">
                                                                                                <div class="col-sm-12">
                                                                                                    <div
                                                                                                        class="title-box-d">
                                                                                                        <h3 class="title-d">
                                                                                                            Property
                                                                                                            Description
                                                                                                        </h3>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div
                                                                                                class="property-description">
                                                                                                <p
                                                                                                    class="description color-text-a">
                                                                                                  {{$item->description}}
                                                                                                </p>
                                                                                            </div>

                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                </section><!-- End Property Single-->

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close
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
