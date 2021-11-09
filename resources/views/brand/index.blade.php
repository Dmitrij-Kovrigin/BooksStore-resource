{{-- <ul>
    @foreach($books as $book)

    <li><b>Title:</b> {{$book->title}}, <b>Isbn:</b> {{$book->isbn}},
<b>Number of pages:</b> {{$book->pages}}, <b>About:</b> {{$book->about}}</li>

@endforeach
</ul> --}}

@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header background2">
                    <div class="card-header__wrap">
                        <h1>Brands list</h1>

                        <div class="card-header__wrap__sort">


                            <div class="form-group">
                                <form action="{{route('brand_index')}}" method="GET">
                                    <select name="sort" class="form-control">
                                        <option value="">Sort by</option>

                                        <option value="name_asc" @if('name_asc'==$sort) selected @endif>Name A->Z</option>

                                        <option value="name_desc" @if('name_desc'==$sort) selected @endif>Name Z->A</option>


                                        <option value="new_asc" @if('new_asc'==$sort) selected @endif>New A->Z</option>

                                        <option value="new_desc" @if('new_desc'==$sort) selected @endif>New Z->A</option>


                                    </select>
                                    <button type="submit" class="btn btn-success">SORT</button>
                                    <a href="{{route('brand_index')}}" class="btn btn-secondary m-2">Reset</a>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="container">
                        @foreach ($brands->chunk(3) as $chunk)
                        <div class="row justify-content-center">
                            @foreach ($chunk as $brand)
                            <div class="col-12">
                                <div class="index-list">
                                    <div class="index-list__extra">
                                        @if ($brand->logo)
                                        <img style="border-radius: 50%;" src="{{$brand->logo}}">
                                        @else
                                        <img src="{{asset('img/noimage.png')}}">
                                        @endif
                                    </div>
                                    <div class="index-list__extra">
                                        {{$brand->title}}
                                    </div>
                                    <div class="index-list__content">
                                        <ul class="list-group">
                                            <li class="list-group-item">
                                                <b>Outfits count:</b> {{$brand->getOutfits->count()}}
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="index-list__buttons">
                                        <a href="{{route('brand_edit', $brand)}}" class="btn btn-success m-2">EDIT</a>
                                        <button type="submit" class="delete--button btn btn-danger m-2" @if($brand->getOutfits->count()) disabled @endif data-action="{{route('brand_delete', $brand)}}">DELETE</button>
                                        <a href="{{route('brand_show', $brand)}}" class="btn btn-info m-2">MORE</a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endforeach
                    </div>
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
            <h5 class="card-title">Confirm author delete</h5>
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






{{--
@foreach ($brands->chunk(2) as $chunk)
<div style="display:flex;width:80%;justify-content:space-between;">

    @foreach ($chunk as $brand)
    <span><b>Brand:</b> {{$brand->title}},
<b>Outfits count: </b> {{$brand->getOutfits->count()}},

<a href="{{route('brand_edit', $brand)}}">Redaguoti</a>
<a href="{{route('brand_show', $brand)}}">Daugiau...</a>

<form action="{{route('brand_delete', $brand)}}" method="post">

    <button type="submit"> Trinti </button>
    @method('delete')

    @csrf
</form>
</span>

@endforeach
</div>
@endforeach --}}
