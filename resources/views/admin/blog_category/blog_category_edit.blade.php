@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="page-content">
<div class="container-fluid">
<div class="row">
<div class="col-12">
<div class="card">
    <div class="card-body">

        <h4 class="card-title">Portfolio Edit Page</h4>
        <form method="post" action="{{route('update.blog.category')}}">
            @csrf
            <input type="hidden" name="id" value="{{$blogcategory->id}}">
            
        <div class="row mb-3">
            <label for="example-text-input" class="col-sm-2 col-form-label">Portfolio Name</label>
            <div class="col-sm-10">
                <input name="blog_category" class="form-control" type="text" id="blog_category" value="{{$blogcategory->blog_category}}">
                @error('blog_category')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <!-- end row -->
        <input type="submit" class="btn btn-info waves-effect waves-light" value="Update Blog Category">
    </div>
</div>
</div> <!-- end col -->

</form>
</div>
</div>
</div>

@endsection
