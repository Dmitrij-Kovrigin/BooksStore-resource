@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header background2">
                    <div class="card-header__wrap">

                        <h2>Outfits list</h2>
                        <div class="card-header__wrap__sort">
                            <form action="{{route('outfit_index')}}" method="GET">
                                <div class="form-group">
                                    <select name="brand" class="form-control">
                                        <option value="0">Filter by</option>
                                        @foreach($brands as $brand)
                                        <option value="{{$brand->id}}" @if($brand_id==$brand->id) selected @endif>{{$brand->title}} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-success m-1">FILTER</button>

                                <a href="{{route('outfit_index')}}" class="btn btn-secondary m-1">RESET</a>

                            </form>
                        </div>
                        <div class="card-header__wrap__sort">
                            <form action="{{route('outfit_index')}}" method="GET">
                                <div class="form-group">
                                    <input type="text" name="s" class="form-control" placeholder="Search" value="{{$s}}">
                                </div>
                                <button type="submit" class="btn btn-success m-1">SEARCH</button>

                                <a href="{{route('outfit_index')}}" class="btn btn-secondary m-1">RESET</a>

                            </form>
                        </div>
                    </div>


                </div>
                <div class="card-body">
                    <div class="container">
                        @forelse ($outfits->chunk(3) as $chunk)
                        <div class="row justify-content-center">
                            @foreach ($chunk as $outfit)
                            <div class="col-8">
                                <div class="index-list">
                                    <div class="index-list__content">
                                        <ul class="list-group">
                                            <li class="list-group-item fs-1">
                                                <b>Type:</b> {{$outfit->type}}
                                            </li>
                                            <li class="list-group-item">
                                                <b>Color:</b> {{$outfit->color}}
                                            </li>
                                            <li class="list-group-item">
                                                <b>Price:</b> {{$outfit->price}}
                                            </li>
                                            <li class="list-group-item">
                                                <b>Discount:</b> {{$outfit->discount}}
                                            </li>
                                            <li class="list-group-item">
                                                <b>Brand:</b> {{$outfit->getBrand->title}}
                                            </li>
                                            <li class="list-group-item">
                                                <b>Photos:</b> {{$outfit->getPhotos->count()}}
                                            </li>
                                            <li class="list-group-item">
                                                <b>Tags:</b> {{$outfit->getTagOutfits->count()}}

                                            </li>

                                        </ul>
                                    </div>
                                    <div class="index-list__buttons">
                                        <a href="{{route('outfit_edit', $outfit)}}" class="btn btn-info btn-lg m-1">REDAGUOTI</a><br>
                                        <a href="{{route('outfit_show', $outfit)}}" class="btn btn-success btn-lg m-1">DAUGIAU</a>
                                        <button type="submit" class="delete--button btn btn-danger btn-lg m-2" data-action="{{route('outfit_delete', $outfit)}}">DELETE</button>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @empty
                        <div class="col-12">
                            <div class="index-list">
                                <div class="index-list__extra">
                                    No outfits
                                </div>
                            </div>
                        </div>

                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="confirm-modal" style="display:none;">
    <div class="card">
        <h5 class="card-header background2">Confirmation</h5>

        <div class="card-body">
            <h5 class="card-title">Confirm outfit delete</h5>
            <div class="buttons">
                <form action="" class="m-1" method="post">
                    <button type="submit" class="btn btn-danger">DELETE</button>
                    @method('DELETE')
                    @csrf
                </form>
                <button type="button" class="cancel--confirm--button btn btn-info m-1">Cancel</button>
            </div>
        </div>
    </div>
</div>

@endsection



{{-- @foreach ($outfits->chunk(2) as $chunk)
<div style="display:flex;width:80%;justify-content:space-between;">
    @foreach ($chunk as $outfit)
    <span><b>Type:</b> {{$outfit->type}}, <b>Color:</b> {{$outfit->color}},
<b>Price:</b> {{$outfit->price}},
<b>Discount:</b> {{$outfit->discount}},
<b>Brand:</b> {{$outfit->getBrand->title}}

<a href="{{route('outfit_show', $outfit)}}">Daugiau...</a>

<form action="{{route('outfit_delete', $outfit)}}" method="post">
    <button type="submit"> Trinti </button>
    @method('delete')

    @csrf
</form>

<a href="{{route('outfit_edit', $outfit)}}">Redaguoti</a>
</span>

@endforeach
</div>
@endforeach --}}
