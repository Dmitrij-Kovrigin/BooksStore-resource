@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header background2">
                    <div class="card-header__wrap">
                        <h1>Books list</h1>
                        <div class="card-header__wrap__sort">
                            <form action="{{route('book_index')}}" method="GET">
                                <div class="form-group">
                                    <select name="author" class="form-control">
                                        <option value="0">Filter by</option>
                                        @foreach($authors as $author)
                                        <option value="{{$author->id}}" @if($author_id==$author->id) selected @endif>{{$author->name}} {{$author->surname}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-success m-1">FILTER</button>
                                <a href="{{route('book_index')}}" class="btn btn-secondary m-1">RESET</a>
                            </form>
                        </div>
                        <div class="card-header__wrap__sort">
                            <form action="{{route('book_index')}}" method="GET">
                                <div class="form-group">
                                    <input type="text" name="s" class="form-control" placeholder="Search" value="{{$s}}">
                                </div>
                                <button type="submit" class="btn btn-success m-1">SEARCH</button>
                                <a href="{{route('book_index')}}" class="btn btn-secondary m-1">RESET</a>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="container">
                        @forelse ($books->chunk(3) as $chunk)
                        <div class="row justify-content-center">
                            @foreach ($chunk as $book)
                            <div class="col-12">
                                <div class="index-list">
                                    <div class="index-list__extra">
                                        <h3>{{$book->title}}</h3>
                                    </div>
                                    <div class="index-list__content">
                                        <ul class="list-group">
                                            <li class="list-group-item">
                                                <b>Author:</b> {{$book->getAuthor->name}} {{$book->getAuthor->surname}}
                                            </li>
                                            <li class="list-group-item">
                                                <b>Isbn:</b> {{$book->isbn}}
                                            </li>
                                            <li class="list-group-item">
                                                <b>Pages:</b> {{$book->pages}}
                                            </li>
                                            <li class="list-group-item">
                                                <b>Photos:</b> {{$book->getPhotos->count()}}
                                            </li>
                                            <li class="list-group-item">
                                                <b>Tags:</b> {{$book->getTagBooks->count()}}

                                            </li>

                                        </ul>
                                    </div>
                                    <div class="index-list__buttons">
                                        <a href="{{route('book_edit', $book)}}" class="btn btn-info btn-lg m-1">REDAGUOTI</a><br>

                                        <a href="{{route('book_show', $book)}}" class="btn btn-success btn-lg m-1">DAUGIAU</a>

                                        <button type="submit" class="delete--button btn btn-danger btn-lg m-2" data-action="{{route('book_delete', $book)}}">DELETE</button>

                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @empty
                        <div class="col-12">
                            <div class="index-list">
                                <div class="index-list__extra">

                                    No books
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
            <h5 class="card-title">Confirm book delete</h5>
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
