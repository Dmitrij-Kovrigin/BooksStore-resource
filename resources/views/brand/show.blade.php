@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header background2">

                    <h1>More about brand</h1>
                </div>
                <div class="card-body">
                    <div class="row justify-content-center show-content">
                        <div class="col-4 show-content__block">
                            <div class="index-list__extra">
                                <img style="border-radius: 50%;" src="{{$brand->logo}}">
                            </div>
                            <div class="index-list__extra">
                                <span>name:</span>
                                <div>{{$brand->title}}</div>
                            </div>
                        </div>

                        <div class="col-12 show-content__block">
                            <h4>Outfits by brand</h4>
                            <ul class="list-group">
                                @foreach ($brand->getOutfits as $outfit)
                                <li class="list-group-item">{{$outfit->type}}
                                    <div class="show-content__buttons">
                                        <a href="{{route('outfit_edit', $outfit)}}" class="btn btn-info m-1">REDAGUOTI</a><br>
                                        <a href="{{route('outfit_show', $outfit)}}" class="btn btn-success m-1">DAUGIAU</a>
                                        <button type="submit" class="delete--button btn btn-danger m-2" data-action="{{route('outfit_delete', [$outfit, 'return' => 'back'])}}">DELETE</button>
                                    </div>

                                </li>
                                @endforeach
                            </ul>

                            <a href="{{route('brand_edit', [$brand, 'return' => 'show/'.$brand->id])}}" class="btn btn-success m-2">EDIT</a>

                            <button type="submit" class="delete--button btn btn-danger m-2" @if($brand->getOutfits->count()) disabled @endif
                                data-action="{{route('brand_delete', $brand)}}">DELETE</button>

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






{{-- <p style="padding:1% 0 0 100px;">Brand:{{$brand->title}}</p><br>

<h4> All outfits: </h4><br>

<ul>
    @foreach($brand->getOutfits as $outfit)
    <li> {{$outfit->type}} </li>
    @endforeach
</ul> --}}
