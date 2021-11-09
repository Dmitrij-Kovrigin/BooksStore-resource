@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header background2">

                    <h1>About outfit</h1>
                </div>
                <div class="card-body">
                    <div class="row justify-content-center show-content">
                        <div class="col-4 show-content__block">
                            <span>Type:</span>
                            <div>{{$outfit->type}}</div>
                        </div>
                        <div class="col-4 show-content__block">
                            <span>Color:</span>
                            <div>{{$outfit->color}}</div>
                        </div>
                        <div class="col-4 show-content__block">
                            <span>Price:</span>
                            <div>{{$outfit->price}}</div>
                        </div>
                        <div class="col-4 show-content__block">
                            <span style="color:red;"><b>Discount:</b></span>
                            <div>{{$outfit->discount}}</div>
                        </div>
                        <div class="col-12 show-content__block">
                            <span>Photos:</span>
                            <div class="images">
                                @forelse($outfit->getPhotos as $photo)
                                <img src="{{$photo->photo}}">
                                @empty
                                <h3> No photos</h3>
                                @endforelse
                            </div>
                        </div>

                    </div>
                </div>
                <a href="{{route('outfit_pdf', $outfit)}}" class="btn btn-success m-2"><i class="fas fa-dragon" style="font-size:16px;color:red;"></i> Download pdf</a>
            </div>
        </div>
    </div>
</div>
@endsection


{{-- <p style="padding:1% 0 0 100px;">Type:{{$outfit->type}}></p><br>
<p style="padding:0 100px;">Color: {{$outfit->color}}</p><br>
<p style="padding:0 100px;">Price: {{$outfit->price}}</p><br>
<p style="padding:0 100px;">Discount: {{$outfit->discount}}</p><br> --}}
