@extends('backend.master')
@section('content')
    <div class="">
        <h1 class="display-4">Our Brands</h1>
        <hr />
    </div>
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/datatables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/data-list-view.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/extensions/toastr.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/extensions/toastr.min.css') }}">
    <link href="toastr.css" rel="stylesheet" />
    <style>
        td.product-action span i.feather {
            font-size: 1.3em;
        }
    </style>

    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/users-lis.js') }}"></script>
    <script src="{{ asset('app-assets/js/brands.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="toastr.js"></script>

    <div class="content-body">
        <section id="data-list-view" class="data-list-view-header">
            <div class="action-btns d-none">
                <div class="btn-dropdown mr-1 mb-1">
                    <div class="btn-group dropdown actions-dropodown">
                        <button type="button" class="btn btn-white px-1 py-1 dropdown-toggle waves-effect waves-light"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Actions
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item"><i class="feather icon-percent"></i>Donor Details</a>
                            <a class="dropdown-item"><i class="feather icon-percent"></i>Update Status</a>
                            <a class="dropdown-item"><i class="feather icon-trash"></i>Delete</a>
                            <a class="dropdown-item"><i class="feather icon-archive"></i>Archive</a>
                            <a class="dropdown-item"><i class="feather icon-file"></i>Print Donors</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- DataTable starts -->
            <div class="table-responsive">
                <table class="table data-list-view">
                    <thead>
                        <tr>
                            <th></th>
                            <th></th>
                            <th>ID</th>
                            <th>BRAND TITLE</th>
                            <th>DESRIPTION</th>
                            <th>STATUS</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($brands as $br)
                            <tr>
                                <td></td>
                                <td><img class="round" src="{{ $br->photo }}" alt="avatar" height="40"
                                        width="40"></td>
                                <td class="text-info">{{ $br->id }}</td>
                                <td class="product-name text-uppercase">{{ $br->title }}
                                </td>
                                <td class="product-name">{{ $br->description }}</td>
                                <td>
                                    <div class="chip chip-success">
                                        <div class="chip-body">
                                            <div class="chip-text">Active</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="product-action">
                                    <span class="action-edit" data-uuid="{{ $br->uuid }}"
                                        data-idnt="{{ $br->uuid }}"><i
                                            class="feather icon-edit blue-text lighten"></i></span>
                                    <span class="action-delete" data-uuid="{{ $br->uuid }}"
                                        data-idnt="{{ $br->uuid }}"><i class="feather icon-trash danger"></i></span>
                                    <span class="action-view" data-uuid="{{ $br->uuid }}"
                                        data-idnt="{{ $br->uuid }}"><a href="projects/donors/{{ $br->uuid }}"><i
                                                class="feather icon-airplay"></i></a></span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- DataTable ends -->
            <!-- add new sidebar starts -->
            <div class="add-new-data-sidebar">
                <div class="overlay-bg"></div>
                <div class="add-new-data">
                    <div class="div mt-2 px-2 d-flex new-data-title justify-content-between">
                        <div>
                            <h4 class="text-uppercase">ADD USER</h4>
                        </div>
                        <div class="hide-data-sidebar">
                            <i class="feather icon-x"></i>
                        </div>
                    </div>
                    <div class="data-items pb-3">
                        <div class="data-fields px-2 mt-25">
                            <div class="row">
                                <div class="col-sm-6 data-field-col">
                                    <label for="data-name">First Name</label>
                                    <input type="hidden" class="form-control" id="donor-idnt">
                                    <input type="text" class="form-control" id="first_name" name="first_name">
                                </div>
                                <div class="col-sm-6 data-field-col">
                                    <label for="data-name">Last Name</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name">
                                </div>
                                <div class="col-sm-12 data-field-col">
                                    <label for="data-name">Email Address</label>
                                    <input type="email" class="form-control" id="email" name="email">
                                </div>
                                <div class="col-sm-6 data-field-col">
                                    <label for="data-name">User Name</label>
                                    <input type="text" class="form-control" id="user_name" name="user_name">
                                </div>
                                <div class="col-sm-6 data-field-col">
                                    <label for="data-name">Contact Information</label>
                                    <input type="number" class="form-control" id="contact" name="contact">
                                </div>
                                <div class="col-sm-6 data-field-col">
                                    <label for="data-name">Role</label>
                                    <select class="form-control" name="role" id="role">
                                        <option value="" selected disabled>--Role--</option>
                                        <option value="banner">Banner</option>
                                        <option value="promo">Promo</option>
                                    </select>
                                </div>
                                <div class="col-sm-6 data-field-col">
                                    <label for="data-name">Status</label>
                                    <select class="form-control" name="status" id="status">
                                        <option value="" selected disabled>--Status--</option>
                                        <option value="banner">Banner</option>
                                        <option value="promo">Promo</option>
                                    </select>
                                </div>
                                <div class="col-sm-12 data-field-col">
                                    <label for="data-status">Physical Address</label>
                                    <textarea type="text" rows="4" class="form-control" name="address" id="address"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="add-data-footer d-flex justify-content-around px-3 mt-2">
                        <div class="add-data-btn">
                            <button class="btn btn-primary btn-save-user"><i class="feather icon-save"></i>Save
                                Donor</button>
                        </div>
                        <div class="cancel-data-btn">
                            <button class="btn btn-outline-danger">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- add new sidebar ends -->
        </section>
    </div>
    <style>
        .product-action {
            z-index: 8;
        }
    </style>
@endsection
