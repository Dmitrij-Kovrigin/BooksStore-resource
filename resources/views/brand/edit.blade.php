@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header background2">

                    <h1>Edit brand</h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('brand_update', [$brand, 'return' => $return]) }}" method="post" enctype="multipart/form-data">

                        <div class="row justify-content-center">
                            <div class="col-6 form-group">
                                Brand:<input type="text" class="form-control" name="brand_title" value="{{$brand->title}}">
                            </div>
                            <div class=" col-4 index-list__extra">
                                @if ($brand->logo)
                                <img src="{{$brand->logo}}">
                                @else
                                <img src="{{asset('img/noimage.png')}}">
                                @endif
                            </div>
                            <div class="col-12 form-group">
                                Logo: <input type="file" class="form-control" name="brand_logo">
                            </div>
                            <div class="form-check mt-2">
                                <input type="checkbox" class="form-check-input" name="delete_logo">
                                <label class="form-check-label">
                                    delete logo
                                </label>
                            </div>


                            <div class="col-12">
                                <button type="submit" class="btn btn-success mt-2">Edit brand</button>
                            </div>
                        </div>
                        @method('PUT')
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection





{{--
<form action="{{route('brand_update', $brand)}}" method="post">

<p style="padding:1% 0 0 100px;">Brand: <input type="text" name="brand_title" value="{{$brand->title}}"></p><br>


<button type="submit" style="margin-left:160px;"> Edit brand </button>

@method('put')
@csrf

</form> --}}
