<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class BookPhoto extends Model
{
    use HasFactory;

    public function getBook()
    {
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }


    public function handleImage($photo, $mode = 'create')
    {

        // if ($request->delete_photo) {
        //     $this->deleteOldPortret();
        //     $this->photo = null;
        //     return;
        // }


        if ($photo) {

            $photoName = rand(10000000, 999999999);
            $photoExt = $photo->getClientOriginalExtension(); // failo ispletimas
            $photoName = $photoName . '.' . $photoExt;
            $destinationPath = public_path() . '/img/books'; // serverio kelias
            $photo->move($destinationPath, $photoName);

            $this->photo = asset('img/books/' . $photoName); // irasoma i DB
        }
    }

    public function deleteOldImage()
    {
        $oldPhoto = $this->photo;
        $oldPhoto = str_replace(asset(''), '', $oldPhoto);
        $oldPhoto = public_path() . '/' . $oldPhoto;
        if (file_exists($oldPhoto)) {
            unlink($oldPhoto);
        }
    }
}
