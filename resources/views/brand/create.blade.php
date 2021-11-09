@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header background2">

                    <h1>Create brand</h1>
                </div>
                <div class="card-body background">

                    <form action="{{ route('brand_store') }}" method="post" enctype="multipart/form-data">

                        <div class="row justify-content-center">
                            <div class="col-6 form-group">
                                Title:<input type="text" class="form-control" name="brand_title" value="{{old('brand_title')}}">
                            </div>

                            <div class="col-12 form-group">
                                Logo: <input type="file" class="form-control" name="brand_logo">

                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-success mt-2">New brand</button>
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



{{-- <form action="{{route('brand_store')}}" method="post">

Brand: <p style="padding:1% 0 0 100px;">Title: <input type="text" name="brand_title"></p><br>



<button type="submit" style="margin-left:160px;"> New brand </button>


@csrf

</form> --}}
