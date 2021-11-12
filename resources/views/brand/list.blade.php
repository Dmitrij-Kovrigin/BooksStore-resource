<div class="m-4" id="authors--pages">
    {{$brands->links()}}
</div>

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
