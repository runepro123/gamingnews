@extends('backend.layouts.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Breaking News</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <form action="{{ url('breaking-news/edit') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <input type="hidden" class="form-control" name="breaking_news_id" value="{{ $breakingNews->id }}">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control">
                                        <option value="0" @if($breakingNews->status == '0') selected @endif>Active
                                        </option>
                                        <option value="1" @if($breakingNews->status == '1') selected @endif>Inactive
                                        </option>
                                    </select>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
</div>
@endsection
