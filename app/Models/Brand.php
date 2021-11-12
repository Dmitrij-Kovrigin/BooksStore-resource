<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Brand extends Model
{
    use HasFactory;

    public function getOutfits()
    {
        return $this->hasMany(Outfit::class, 'brand_id', 'id');
    }

    public function addBrand(Request $request, $mode = 'create')
    {

        if ($request->delete_logo) {
            $this->deleteOldBrand();
            $this->logo = null;
            return;
        }


        if ($request->file('brand_logo')) {
            $logo = $request->file('brand_logo'); // informacija apie faila
            $logoName = rand(10000000, 999999999);
            $logoExt = $logo->getClientOriginalExtension(); // failo ispletimas
            $logoName = $logoName . '.' . $logoExt;
            $destinationPath = public_path() . '/img/brands'; // serverio kelias
            $logo->move($destinationPath, $logoName);

            if ('edit' == $mode && $this->logo) {
                $this->deleteOldLogo();
            }

            $this->logo = asset('img/brands/' . $logoName); // irasoma i DB
        }
    }

    public function deleteOldBrand()
    {
        $oldLogo = $this->logo;
        if (null === $oldLogo) {
            return;
        }
        $oldLogo = str_replace(asset(''), '', $oldLogo);
        $oldLogo = public_path() . '/' . $oldLogo;
        if (file_exists($oldLogo)) {
            unlink($oldLogo);
        }
    }
}
