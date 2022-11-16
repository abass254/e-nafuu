@extends('backend.master')
@section('content')
    <div class="">
        <h1 class="display-4">Banners </h1>
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
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/extensions/toastr.min.js') }}"></script>

    <script src="{{ asset('app-assets/js/banners-list.js') }}"></script>
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
                            <th>TITLE</th>
                            <th>DESCRIPTION</th>
                            <th>CONDITION</th>
                            <th>STATUS</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($banners as $user)
                            <tr>
                                <td></td>
                                <td><img src="{{ $user->photo }}" alt="image banner" height="90" width="120"></td>
                                <td class="text-info">{{ $user->id }}</td>
                                <td class="product-name text-uppercase">{{ $user->title }}</td>
                                <td class="product-name">{{ $user->description }}</td>
                                <td>
                                    <div class="chip chip-{{ $user->condition == 'banner' ? 'info' : 'warning' }}">
                                        <div class="chip-body">
                                            <div class="chip-text">{{ strtoupper($user->condition) }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check form-switch form-check-success">
                                        <input value="{{ $user->id }}" name="status" type="checkbox"
                                            class="form-check-input" id="customSwitch111"
                                            {{ $user->status == 'active' ? 'checked' : '' }} />
                                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                        <label class="form-check-label" for="customSwitch111">
                                            <span class="switch-icon-left"><i data-feather="check"></i></span>
                                            <span class="switch-icon-right"><i data-feather="x"></i></span>
                                        </label>
                                    </div>
                                </td>
                                <td class="product-action">
                                    <span class="action-edit" data-uuid="{{ $user->uuid }}"
                                        onclick="updateUser({{ $user }})" data-idnt="{{ $user->uuid }}"><i
                                            class="feather icon-edit blue-text lighten"></i></span>
                                    <span class="action-delete" data-uuid="{{ $user->uuid }}"
                                        data-idnt="{{ $user->uuid }}"><i class="feather icon-trash danger"></i></span>
                                    <span class="action-view" data-uuid="{{ $user->uuid }}"
                                        data-idnt="{{ $user->uuid }}"><i class="feather icon-airplay"></i></span>
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
                            <h4 class="text-uppercase">ADD BANNER</h4>
                        </div>
                        <div class="hide-data-sidebar">
                            <i class="feather icon-x"></i>
                        </div>
                    </div>
                    <div class="data-items pb-3">
                        <form action="">
                            <input type="hidden" class="form-control" name="id" id="banner-id">
                            @csrf
                            <div class="data-fields px-2 mt-25">
                                <div class="row">
                                    <div class="col-sm-12 data-field-col">
                                        <label for="data-name">Title</label>

                                        <input type="text" name="title" class="form-control" id="banner-title">
                                    </div>
                                    <div class="col-sm-12 data-field-col">
                                        <label for="data-category">Condition</label>
                                        <select class="form-control" name="conditions" id="banner-conditions">
                                            <option value="" selected disabled>--Condition--</option>
                                            <option value="banner">Banner</option>
                                            <option value="promo">Promo</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-12 data-field-col">
                                        <label for="data-status">Status</label>
                                        <select class="form-control" name="status" id="banner-status">
                                            <option value="" selected disabled>--Status--</option>
                                            <option value="active">Active</option>
                                            <option value="inactive">Inactive</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-12 data-field-col">
                                        <label for="data-price">Banner Image</label>
                                        <div class="input-group">
                                            <span class="input-group-btn text-white">
                                                <a id="lfm" data-input="thumbnail" data-preview="holder"
                                                    class="btn btn-primary">
                                                    <i class="fa fa-picture-o"></i> Choose
                                                </a>
                                            </span>
                                            <input id="thumbnail" class="form-control" type="text" name="photo">
                                        </div>
                                        <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                                    </div>
                                    <div class="col-sm-12 data-field-col">
                                        <label for="data-status">Description</label>
                                        <textarea class="form-control" rows="4" name="description" id="banner-description"></textarea>
                                    </div>
                                </div>
                            </div>

                    </div>
                    <div class="add-data-footer d-flex justify-content-around px-3 mt-2">
                        <div class="add-data-btn">
                            <button id="btn-save" class="btn btn-success btn-save-banner">Save Banner</button>
                        </div>
                        <div class="cancel-data-btn">
                            <button class="btn btn-danger">Cancel</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
            <!-- add new sidebar ends -->
        </section>
    </div>
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        $('#lfm').filemanager('image');
    </script>
@endsection
