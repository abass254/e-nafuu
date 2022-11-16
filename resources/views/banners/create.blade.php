@extends('backend.master')
@section('content')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <div class="">
        <h1 class="display-4">Add Banners</h1>
        <hr />
    </div>
    <div class="card">
        <div class="card-header">
            @if ($errors->any)
                <ul>
                    @foreach ($errors as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
        <div class="card-body">
            <form id="save-banner" class="form form-vertical" method="POST" action="{{ route('banners.store') }}">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="mb-1">
                            <label class="form-label" for="first-name-vertical">Title</label>
                            <input type="text" name="title" class="form-control">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-1">
                            <label class="form-label" for="first-name-vertical">Condition</label>
                            <select class="form-control" name="conditions" id="conditions">
                                <option value="" selected disabled>--Condition--</option>
                                <option value="banner">Banner</option>
                                <option value="promo">Promo</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-1">
                            <label class="form-label" for="first-name-vertical">Status</label>
                            <select class="form-control" name="status" id="status">
                                <option value="" selected disabled>--Status--</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-1">
                            <label class="form-label" for="first-name-vertical">Description</label>
                            <textarea class="form-control" name="description" id="summernote"></textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-1">
                            <label for="">Banner Image</label>
                            <div class="input-group">
                                <span class="input-group-btn text-white">
                                    <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                        <i class="fa fa-picture-o"></i> Choose
                                    </a>
                                </span>
                                <input id="thumbnail" class="form-control" type="text" name="photo">
                            </div>
                            <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-success me-1">Submit</button>
                        <button type="reset" class="btn btn-danger me-1">Reset</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script>
        $('#lfm').filemanager('image');
    </script>
@endsection
