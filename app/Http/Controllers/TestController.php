<?php

namespace App\Http\Controllers;

use App\Models\BookPhoto;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function showAuthorName($id)
    {
        $bookPhoto = BookPhoto::where('id', $id)->first(); // vietoj first gali but: ->get()[0];
        return $bookPhoto->getBook->getAuthor->name;
    }
}
