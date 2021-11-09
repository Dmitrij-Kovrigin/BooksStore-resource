@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header background2">

                    <h1>Edit tag</h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('tag_update', [$tag, 'return' => $return]) }}" method="post" enctype="multipart/form-data">

                        <div class="row justify-content-center">
                            <div class="col-6 form-group">
                                name:<input type="text" class="form-control" name="tag_name" value="{{old('tag_name', $tag->name)}}">
                            </div>

                            {{-- <div class=" col-3 index-list__extra">
                                @if ($tag->photo)
                                <img src="{{$tag->photo}}">
                            @else
                            <img src="{{asset('img/noimage.png')}}">
                            @endif
                        </div> --}}
                        {{-- <div class="col-10 form-group">
                                Portrait: <input type="file" class="form-control" name="tag_photo">
                            </div> --}}
                        {{-- <div class="form-check mt-2">
                                <input type="checkbox" class="form-check-input" name="delete_photo">
                                <label class="form-check-label">
                                    delete photo
                                </label>
                            </div> --}}
                        <div class="col-12">
                            <button type="submit" class="btn btn-success mt-2">Edit tag</button>
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
