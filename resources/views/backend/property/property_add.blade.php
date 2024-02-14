@php use Illuminate\Support\Facades\Auth; @endphp
@php
    $role = Auth::user()->role;
@endphp
@extends('backend.layouts.app')
@section('PageTitle', 'Add new Property')
@section('content')

    <!--breadcrumb -->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Property</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route($role . '-profile') }}"><i
                                class="bx
                    bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Add new Property</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb -->
    <div class="card">
        <div class="card-body">
            <h4 class="d-flex align-items-center mb-3">Add Property</h4>
            <br>
            <form id="" action="{{ route('property-create') }}" method="POST">
                @csrf
                <!-- New Sections: Title, Location, Price, Description, Status -->
                <div class="row mb-3">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Title</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <input name="title" type="text" class="form-control" required />
                        <small style="color: #e20000" class="error" id="title-error"></small>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Location</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <input name="location" type="text" class="form-control" required />
                        <small style="color: #e20000" class="error" id="location-error"></small>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Price</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <input name="price" type="text" class="form-control" required />
                        <small style="color: #e20000" class="error" id="price-error"></small>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Description</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <textarea name="description" class="form-control" required></textarea>
                        <small style="color: #e20000" class="error" id="description-error"></small>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Status</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <select name="status" class="form-control" required>
                            <option value="">Select Status</option>
                            <option value="available">Available</option>
                            <option value="occupied">Occupied</option>
                            <option value="under maintenance">Under Maintenance</option>
                        </select>
                        <small style="color: #e20000" class="error" id="status-error"></small>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Assign Employe</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <select name="user_id" class="form-control" required>
                            <option value="">Select Employe</option>

                            @foreach ($data as $employe)
                                <option value="{{ $employe->id }}">{{ $employe->name }}</option>
                            @endforeach
                        </select>
                        <small style="color: #e20000" class="error" id="status-error"></small>
                    </div>
                </div>
                <!-- End of New Sections -->

                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-9 text-secondary">
                        <input type="submit" class="btn btn-primary px-4" value="Save Changes" />
                    </div>
                </div>
            </form>

        </div>
    </div>
    </div>
@endsection


@section('AjaxScript')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            // $('#brand_form').on('submit', function(event){
            //     event.preventDefault();
            //     // remove errors if the conditions are true
            //     $('#brand_form *').filter(':input.is-invalid').each(function(){
            //         this.classList.remove('is-invalid');
            //     });
            //     $('#brand_form *').filter('.error').each(function(){
            //         this.innerHTML = '';
            //     });
            //     $.ajax({
            //         url: "{{ route('brand-create') }}",
            //         method: 'POST',
            //         data: new FormData(this),
            //         dataType: 'JSON',
            //         contentType: false,
            //         cache: false,
            //         processData: false,
            //         success : function(response)
            //         {
            //             // remove errors if the conditions are true
            //             $('#brand_form *').filter(':input.is-invalid').each(function(){
            //                 this.classList.remove('is-invalid');
            //             });
            //             $('#brand_form *').filter('.error').each(function(){
            //                 this.innerHTML = '';
            //             });
            //             Swal.fire({
            //                 icon: 'success',
            //                 title: response.msg,
            //                 showDenyButton: false,
            //                 showCancelButton: false,
            //                 confirmButtonText: 'OK'
            //             }).then((result) => {
            //                 window.location.reload();
            //             });
            //         },
            //         error: function(response) {
            //             var res = $.parseJSON(response.responseText);
            //             $.each(res.errors, function (key, err){
            //                 $('#' + key + '-error').text(err[0]);
            //                 $('#' + key ).addClass('is-invalid');
            //             });
            //         }
            //     });
            // });
        });
    </script>
@endsection

@section('js')
    {{-- <script type="text/javascript">
        $(document).ready(function() {
            $('#brand_image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#show_image').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script> --}}
@endsection
