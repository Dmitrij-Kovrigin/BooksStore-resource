<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Outfit;
use App\Models\OutfitPhoto;
use App\Models\Tag;
use App\Models\TagBook;
use App\Models\TagOutfit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade as PDF;

class OutfitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        $brands = Brand::orderBy('title')->get();

        if ($request->brand) {
            $outfits = Outfit::where('brand_id', $request->brand)->get();
        } elseif ($request->s) {
            $outfits = Outfit::where('type', 'like', '%' . $request->s . '%')->get();
        } else {
            $outfits = Outfit::orderBy('updated_at', 'desc')->get();
        }

        return view('outfit.index', [
            'outfits' => $outfits,
            'brands' => $brands,
            'brand_id' => $request->brand ?? 0,
            's' => $request->s ?? ''
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::orderBy('name')->get();
        return view('outfit.create', [
            'brands' => Brand::all(),
            'tags' => $tags
        ]);
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
            'outfit_type' => 'required|max:255|min:2',
            'outfit_color' => 'required|max:20|min:2',
            'outfit_price' => 'required|numeric',
            'outfit_discount' => 'required|numeric',
            'brand_id' => 'required|integer|min:1'
        ], [
            'brand_id.min' => 'Please, select brand!'
        ]);

        $request->flash();

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator);
        }

        $outfit = new Outfit();
        $outfit->type = $request->outfit_type;
        $outfit->color = $request->outfit_color;
        $outfit->price = $request->outfit_price;
        $outfit->discount = $request->outfit_discount;
        $outfit->brand_id = $request->brand_id;

        $outfit->save();


        // Starts Tag Manager

        foreach ($request->tag ?? [] as $tagId) {
            $tagOutfit = new TagOutfit;
            $tagOutfit->tag_id = $tagId;
            $tagOutfit->outfit_id = $outfit->id;
            $tagOutfit->save();
        }

        // End Tag Manager

        if ($request->file('outfit_photo')) {
            foreach ($request->file('outfit_photo') as $photo) {
                $bookPhoto = new OutfitPhoto();
                $bookPhoto->handleImage($photo);
                $bookPhoto->outfit_id = $outfit->id;
                $bookPhoto->save();
            }
        }

        return redirect()->route('outfit_index')->with('success_message', 'New outfit was created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Outfit  $outfit
     * @return \Illuminate\Http\Response
     */
    public function show(Outfit $outfit)
    {
        return view('outfit.show', ['outfit' => $outfit]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Outfit  $outfit
     * @return \Illuminate\Http\Response
     */
    public function edit(Outfit $outfit)
    {
        $tags = Tag::orderBy('name')->get();
        $outfitTags = $outfit->getTagOutfits->pluck('tag_id')->all();
        return view('outfit.edit', [
            'outfit' => $outfit,
            'brands' => Brand::all(),
            'tags' => $tags,
            'outfitTags' => $outfitTags
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Outfit  $outfit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Outfit $outfit)
    {
        $validator = Validator::make($request->all(), [
            'outfit_type' => 'required|max:255|min:2',
            'outfit_color' => 'required|max:20|min:2',
            'outfit_price' => 'required|numeric',
            'outfit_discount' => 'required|numeric',
            'brand_id' => 'required|integer|min:1'
        ], [
            'brand_id.min' => 'Please, select brand!'
        ]);

        $request->flash();

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator);
        }

        $outfit->type = $request->outfit_type;
        $outfit->color = $request->outfit_color;
        $outfit->price = $request->outfit_price;
        $outfit->discount = $request->outfit_discount;
        $outfit->brand_id = $request->brand_id;

        $outfit->save();

        // Starts Tag Manager


        $oldOutfitsTags = $outfit->getTagOutfits->pluck('tag_id')->all();
        $outfitTags = array_map(fn ($t) => (int) $t, ($request->tag ?? []));
        $delOutfitTags = array_diff($oldOutfitsTags, $outfitTags);

        // dd($oldOutfitsTags, $outfitTags, $delOutfitTags);

        foreach ($delOutfitTags as $tagId) {
            $tagOutfit = TagOutfit::where('tag_id', $tagId);
            $tagOutfit->delete();
        }

        foreach ($request->tag ?? [] as $tagId) {

            $tagOutfit = TagOutfit::where('tag_id', $tagId)->where('outfit_id', $outfit->id)->first();
            if ($tagOutfit) {
                continue;
            }

            $tagOutfit = new TagOutfit;
            $tagOutfit->tag_id = $tagId;
            $tagOutfit->outfit_id = $outfit->id;
            $tagOutfit->save();
        }

        // End Tag Manager


        foreach ($request->delete_photo ?? [] as $photoId) {
            $outfitPhoto = OutfitPhoto::where('id', $photoId)->first();
            $outfitPhoto->deleteOldImage();
            $outfitPhoto->delete();
        }

        if ($request->file('outfit_photo')) {
            foreach ($request->file('outfit_photo') as $photo) {
                $outfitPhoto = new OutfitPhoto;
                $outfitPhoto->handleImage($photo);
                $outfitPhoto->outfit_id = $outfit->id;
                $outfitPhoto->save();
            }
        }

        $mainId = (int) $request->main_photo ?? 0;

        foreach (OutfitPhoto::where('outfit_id', $outfit->id)->get() as $photo) {
            if ($photo->id == $mainId) {
                $photo->main = 1;
            } else {
                $photo->main = null;
            }
            $photo->save();
        }

        return redirect()->route('outfit_index')->with('success_message', 'Outfit was updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Outfit  $outfit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Outfit $outfit)
    {

        foreach ($outfit->getPhotos as $outfitPhoto) {
            $outfitPhoto->deleteOldImage();
            $outfitPhoto->delete();
        }
        $outfit->delete();
        if ($request->return && $request->return == 'back') {
            return redirect()->back()->with('success_message', 'The book was deleted.');
        }
        return redirect()->route('outfit_index')->with('success_message', 'Outfit was deleted');
    }

    public function pdf(Outfit $outfit)
    {
        $pdf = PDF::loadView('outfit.pdf', ['outfit' => $outfit]);
        return $pdf->download('outfit-' . $outfit->id . '.pdf');
    }
}
