@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header background2">
                    <h2>Create outfit</h2>
                </div>
                <div class="card-body background">
                    <form action="{{ route('outfit_store') }}" method="post" enctype="multipart/form-data">

                        <div class=" row justify-content-center">
                            <div class="col-4 form-group">
                                Type:<input type="text" class="form-control" name="outfit_type" value="{{old('outfit_type')}}">

                            </div>
                            <div class="col-4 form-group">
                                Color: <input type="text" class="form-control" name="outfit_color" value="{{old('outfit_color')}}">

                            </div>
                            <div class="col-4 form-group">
                                Price: <input type="text" class="form-control" name="outfit_price" value="{{old('outfit_price')}}">

                            </div>
                            <div class="col-4 form-group">
                                Discount: <input type="text" class="form-control" name="outfit_discount" value="{{old('outfit_discount')}}">
                            </div>
                            <div class="col-4 form-group">
                                Brands:
                                <select name="brand_id" class="form-control">
                                    <option value="0"> Select brand </option>
                                    @foreach($brands as $brand)
                                    <option value="{{$brand->id}}" @if(old('brand_id')==$brand->id) selected @endif
                                        > {{$brand->title}} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 form-group">
                                Tags:
                                <div class="tags-list">
                                    @forelse($tags as $tag)
                                    <div class="tags-list__tag">
                                        <input type="checkbox" id="tag-{{$tag->id}}" name="tag[]" value="{{$tag->id}}">

                                        <label for="tag-{{$tag->id}}" class="badge rounded-pill">{{$tag->name}}</label>

                                    </div>
                                    @empty
                                    <h3>No tags </h3>
                                    @endforelse
                                </div>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-success mt-2">New outfit</button>
                                <button type="button" class="btn-sm btn-dark mt-2 ml-5 add--photo">Add photo</button>
                            </div>
                            <div class="col-6 form-group mt-2">
                                Photos of outfit:
                                <div class="outfit--photos book-photo-form">
                                </div>
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


{{-- <form action="{{route('outfit_store')}}" method="post">

<p style="padding:1% 0 0 100px;">Type: <input type="text" name="outfit_type"></p><br>
<p style="padding:0 100px;">Color: <input type="text" name="outfit_color"></p><br>
<p style="padding:0 100px;">Price: <input type="text" name="outfit_price"></p><br>
<p style="padding:0 100px;">Discount: <input name="outfit_discount" type="text"></p><br>


<button type="submit" style="margin-left:160px;"> New oufit </button>


@csrf

</form> --}}
