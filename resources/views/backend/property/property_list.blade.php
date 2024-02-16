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
                                                                                                            {{$item->price}}</h5>
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
                                                                                                                ID:</strong>
                                                                                                            <span>1134</span>
                                                                                                        </li>
                                                                                                        <li
                                                                                                            class="d-flex justify-content-between">
                                                                                                            <strong>Location:</strong>
                                                                                                            <span>Chicago,
                                                                                                                IL
                                                                                                                606543</span>
                                                                                                        </li>
                                                                                                        <li
                                                                                                            class="d-flex justify-content-between">
                                                                                                            <strong>Property
                                                                                                                Type:</strong>
                                                                                                            <span>House</span>
                                                                                                        </li>
                                                                                                        <li
                                                                                                            class="d-flex justify-content-between">
                                                                                                            <strong>Status:</strong>
                                                                                                            <span>Sale</span>
                                                                                                        </li>
                                                                                                        <li
                                                                                                            class="d-flex justify-content-between">
                                                                                                            <strong>Area:</strong>
                                                                                                            <span>340m
                                                                                                                <sup>2</sup>
                                                                                                            </span>
                                                                                                        </li>
                                                                                                        <li
                                                                                                            class="d-flex justify-content-between">
                                                                                                            <strong>Beds:</strong>
                                                                                                            <span>4</span>
                                                                                                        </li>
                                                                                                        <li
                                                                                                            class="d-flex justify-content-between">
                                                                                                            <strong>Baths:</strong>
                                                                                                            <span>2</span>
                                                                                                        </li>
                                                                                                        <li
                                                                                                            class="d-flex justify-content-between">
                                                                                                            <strong>Garage:</strong>
                                                                                                            <span>1</span>
                                                                                                        </li>
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
                                                                                                    Vestibulum ante ipsum
                                                                                                    primis
                                                                                                    in faucibus orci luctus
                                                                                                    et
                                                                                                    ultrices posuere cubilia
                                                                                                    Curae; Donec velit
                                                                                                    neque, auctor sit amet
                                                                                                    aliquam vel, ullamcorper
                                                                                                    sit
                                                                                                    amet ligula. Cras
                                                                                                    ultricies
                                                                                                    ligula sed magna dictum
                                                                                                    porta.
                                                                                                    Curabitur aliquet quam
                                                                                                    id
                                                                                                    dui posuere blandit.
                                                                                                    Mauris
                                                                                                    blandit aliquet elit,
                                                                                                    eget
                                                                                                    tincidunt
                                                                                                    nibh pulvinar quam id
                                                                                                    dui
                                                                                                    posuere blandit.
                                                                                                </p>
                                                                                                <p
                                                                                                    class="description color-text-a no-margin">
                                                                                                    Curabitur arcu erat,
                                                                                                    accumsan id imperdiet
                                                                                                    et,
                                                                                                    porttitor at sem. Donec
                                                                                                    rutrum congue leo eget
                                                                                                    malesuada. Quisque velit
                                                                                                    nisi,
                                                                                                    pretium ut lacinia in,
                                                                                                    elementum id enim. Donec
                                                                                                    sollicitudin molestie
                                                                                                    malesuada.
                                                                                                </p>
                                                                                            </div>
                                                                                            <div class="row section-t3">
                                                                                                <div class="col-sm-12">
                                                                                                    <div
                                                                                                        class="title-box-d">
                                                                                                        <h3
                                                                                                            class="title-d">
                                                                                                            Amenities</h3>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div
                                                                                                class="amenities-list color-text-a">
                                                                                                <ul
                                                                                                    class="list-a no-margin">
                                                                                                    <li>Balcony</li>
                                                                                                    <li>Outdoor Kitchen</li>
                                                                                                    <li>Cable Tv</li>
                                                                                                    <li>Deck</li>
                                                                                                    <li>Tennis Courts</li>
                                                                                                    <li>Internet</li>
                                                                                                    <li>Parking</li>
                                                                                                    <li>Sun Room</li>
                                                                                                    <li>Concrete Flooring
                                                                                                    </li>
                                                                                                </ul>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-10 offset-md-1">
                                                                                    <ul class="nav nav-pills-a nav-pills mb-3 section-t3"
                                                                                        id="pills-tab" role="tablist">
                                                                                        <li class="nav-item">
                                                                                            <a class="nav-link active"
                                                                                                id="pills-video-tab"
                                                                                                data-bs-toggle="pill"
                                                                                                href="#pills-video"
                                                                                                role="tab"
                                                                                                aria-controls="pills-video"
                                                                                                aria-selected="true">Video</a>
                                                                                        </li>
                                                                                        <li class="nav-item">
                                                                                            <a class="nav-link"
                                                                                                id="pills-plans-tab"
                                                                                                data-bs-toggle="pill"
                                                                                                href="#pills-plans"
                                                                                                role="tab"
                                                                                                aria-controls="pills-plans"
                                                                                                aria-selected="false">Floor
                                                                                                Plans</a>
                                                                                        </li>
                                                                                        <li class="nav-item">
                                                                                            <a class="nav-link"
                                                                                                id="pills-map-tab"
                                                                                                data-bs-toggle="pill"
                                                                                                href="#pills-map"
                                                                                                role="tab"
                                                                                                aria-controls="pills-map"
                                                                                                aria-selected="false">Ubication</a>
                                                                                        </li>
                                                                                    </ul>
                                                                                    <div class="tab-content"
                                                                                        id="pills-tabContent">
                                                                                        <div class="tab-pane fade show active"
                                                                                            id="pills-video"
                                                                                            role="tabpanel"
                                                                                            aria-labelledby="pills-video-tab">
                                                                                            <iframe
                                                                                                src="https://player.vimeo.com/video/73221098"
                                                                                                width="100%"
                                                                                                height="460"
                                                                                                frameborder="0"
                                                                                                webkitallowfullscreen
                                                                                                mozallowfullscreen
                                                                                                allowfullscreen></iframe>
                                                                                        </div>
                                                                                        <div class="tab-pane fade"
                                                                                            id="pills-plans"
                                                                                            role="tabpanel"
                                                                                            aria-labelledby="pills-plans-tab">
                                                                                            <img src="assets/img/plan2.jpg"
                                                                                                alt=""
                                                                                                class="img-fluid">
                                                                                        </div>
                                                                                        <div class="tab-pane fade"
                                                                                            id="pills-map" role="tabpanel"
                                                                                            aria-labelledby="pills-map-tab">
                                                                                            <iframe
                                                                                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.1422937950147!2d-73.98731968482413!3d40.75889497932681!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25855c6480299%3A0x55194ec5a1ae072e!2sTimes+Square!5e0!3m2!1ses-419!2sve!4v1510329142834"
                                                                                                width="100%"
                                                                                                height="460"
                                                                                                frameborder="0"
                                                                                                style="border:0"
                                                                                                allowfullscreen></iframe>
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
