@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header background2">
                    <h1>Create tag</h1>
                </div>
                <div class="card-body background">

                    <form action="{{ route('tag_store') }}" method="post" enctype="multipart/form-data">

                        <div class="row justify-content-center">
                            <div class="col-6 form-group">
                                Name:<input type="text" class="form-control" name="tag_name" value="{{old('tag_name')}}">
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-success mt-2">New tag</button>
                            </div>
                        </div>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
