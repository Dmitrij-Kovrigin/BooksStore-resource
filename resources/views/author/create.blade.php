@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header background2">

                    <h1>Create author</h1>
                </div>
                <div class="card-body background">

                    <form action="{{ route('author_store') }}" method="post" enctype="multipart/form-data">

                        <div class="row justify-content-center">
                            <div class="col-6 form-group">
                                Name:<input type="text" class="form-control" name="author_name" value="{{old('author_name')}}">
                            </div>
                            <div class="col-6 form-group">
                                Surname: <input type="text" class="form-control" name="author_surname" value="{{old('author_surname')}}">

                            </div>
                            <div class="col-12 form-group">
                                Portrait: <input type="file" class="form-control" name="author_photo">

                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-success mt-2">New Author</button>
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
