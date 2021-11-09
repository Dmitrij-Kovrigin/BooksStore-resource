<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagOutfit extends Model
{
    use HasFactory;

    // public function deleteOldTags()
    // {
    //     $oldTag = $this->tag;
    //     $oldTag = str_replace(asset(''), '', $oldTag);
    //     $oldTag = public_path() . '/' . $oldTag;
    //     if (file_exists($oldTag)) {
    //         unlink($oldTag);
    //     }
    // }
}
