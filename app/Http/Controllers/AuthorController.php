<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Response;
use Illuminate\Support\Facades\Validator;
use View;


// use Illuminate\Support\Facades\Request;

class AuthorController extends Controller
{

    const PAGES = 4;
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        // Collection PHP sortBy(a), sortByDesc(a)
        // MariaDB DB orderBy(a), orderBy(a, 'desc')




        if ($request->sort) {
            if ($request->sort == 'name_asc') {
                $authors = Author::orderBy('name')->paginate(self::PAGES)
                    ->withQueryString();
            } elseif ($request->sort == 'name_desc') {
                $authors = Author::orderBy('name', 'desc')->paginate(self::PAGES)
                    ->withQueryString();
            } elseif ($request->sort == 'new_asc') {
                $authors = Author::orderBy('created_at', 'desc')->paginate(self::PAGES)
                    ->withQueryString();
            } elseif ($request->sort == 'new_desc') {
                $authors = Author::orderBy('created_at')->paginate(self::PAGES)
                    ->withQueryString();
            } else {
                $authors = Author::all(); // invalid sort input
            }
        } else {
            $authors = Author::all(); // without sort
        }


        // $authors = Author::all();
        // $books = Book::where('pages', '>', 12)->get()->sortByDesc('title');

        // $plucked = $books->pluck('title');
        // dd($plucked);
        // $books = $books->nth(2); // kas antra knyga
        // dd($books->contains(fn ($val) => $val->pages == 98));
        return view('author.index', ['authors' => $authors, 'sort' => $request->sort ?? '']);
    }

    public function list(Request $request)
    {


        if ($request->sort) {
            if ($request->sort == 'name_asc') {
                $authors = Author::orderBy('name')->paginate(self::PAGES)
                    ->withQueryString();
            } elseif ($request->sort == 'name_desc') {
                $authors = Author::orderBy('name', 'desc')->paginate(self::PAGES)
                    ->withQueryString();
            } elseif ($request->sort == 'new_asc') {
                $authors = Author::orderBy('created_at', 'desc')->paginate(self::PAGES)
                    ->withQueryString();
            } elseif ($request->sort == 'new_desc') {
                $authors = Author::orderBy('created_at')->paginate(self::PAGES)
                    ->withQueryString();
            } else {
                $authors = Author::paginate(self::PAGES)
                    ->withQueryString(); // invalid sort input
            }
        } else {
            $authors = Author::paginate(self::PAGES)
                ->withQueryString(); // without sort
        }

        $authors->withPath('');
        $html = View::make('author.list')->with('authors', $authors)->render();
        return Response::json([
            'html' => $html,
            'status' => 'OK'
        ]);
        // return 'Hello';
    }


    public function pages(Request $request)
    {


        if ($request->sort) {
            if ($request->sort == 'name_asc') {
                $authors = Author::orderBy('name')->paginate(self::PAGES)
                    ->withQueryString();
            } elseif ($request->sort == 'name_desc') {
                $authors = Author::orderBy('name', 'desc')->paginate(self::PAGES)
                    ->withQueryString();
            } elseif ($request->sort == 'new_asc') {
                $authors = Author::orderBy('created_at', 'desc')->paginate(self::PAGES)
                    ->withQueryString();
            } elseif ($request->sort == 'new_desc') {
                $authors = Author::orderBy('created_at')->paginate(self::PAGES)
                    ->withQueryString();
            } else {
                $authors = Author::paginate(self::PAGES)
                    ->withQueryString(); // invalid sort input
            }
        } else {
            $authors = Author::paginate(self::PAGES)
                ->withQueryString(); // without sort
        }

        $authors->withPath('');
        $html = View::make('author.pages')->with('authors', $authors)->render();
        return Response::json([
            'html' => $html,
            'status' => 'OK'
        ]);
        // return 'Hello';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('author.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'author_name' => 'required|max:64|min:3|alpha',
            'author_surname' => 'required|max:64|min:3|alpha'
        ]);

        $request->flash();

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator);
        }

        $author = new Author;

        $author->handlePortret($request);

        $author->name = $request->author_name;
        $author->surname = $request->author_surname;
        $author->save();
        return redirect()->route('author_index')->with('success_message', 'New author was created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
        return view('author.show', ['author' => $author]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Author $author)
    {

        return view('author.edit', ['author' => $author, 'return' => $request->return ?? '']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Author $author)
    {
        $validator = Validator::make($request->all(), [
            'author_name' => 'required|max:64|min:3|alpha',
            'author_surname' => 'required|max:64|min:3|alpha'
        ]);

        $request->flash();

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator);
        }

        // $author = new Author;
        $author->handlePortret($request, 'edit');

        $author->name = $request->author_name;
        $author->surname = $request->author_surname;

        $author->save();
        if ($request->return) {
            return redirect('authors/' . $request->return)->with('info_message', 'Author was updated');
        }

        return redirect()->route('author_index')->with('success_message', 'Author was updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
        if ($author->getBooks->count()) {
            return redirect()->back()->with('info_message', 'Can not delete the author, coz he has books');
        }
        $author->deleteOldPortret();
        $author->delete();
        return redirect()->route('author_index')->with('success_message', 'Author was deleted.');
    }
}
