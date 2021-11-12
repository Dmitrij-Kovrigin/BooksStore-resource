<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use View;
use Response;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $brands = Brand::all();

        if ($request->sort) {
            if ($request->sort == 'name_asc') {
                $brands = Brand::orderBy('title')->get();
            } elseif ($request->sort == 'name_desc') {
                $brands = Brand::orderBy('title', 'desc')->get();
            } elseif ($request->sort == 'new_asc') {
                $brands = Brand::orderBy('created_at', 'desc')->get();
            } elseif ($request->sort == 'new_desc') {
                $brands = Brand::orderBy('created_at')->get();
            } else {
                $brands = Brand::all(); // invalid sort input
            }
        } else {
            $brands = Brand::all(); // without sort
        }


        return view('brand.index', ['brands' => $brands, 'sort' => $request->sort ?? '']);
    }

    public function list(Request $request)
    {
        sleep(2);
        if ($request->sort) {
            if ($request->sort == 'name_asc') {
                $brands = Brand::orderBy('title')->get();
            } elseif ($request->sort == 'name_desc') {
                $brands = Brand::orderBy('title', 'desc')->get();
            } elseif ($request->sort == 'new_asc') {
                $brands = Brand::orderBy('created_at', 'desc')->get();
            } elseif ($request->sort == 'new_desc') {
                $brands = Brand::orderBy('created_at')->get();
            } else {
                $brands = Brand::all(); // invalid sort input
            }
        } else {
            $brands = Brand::all(); // without sort
        }
        // $brands = Brand::all();
        $html = View::make('brand.list')->with('brands', $brands)->render();
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
        return view('brand.create');
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
            'brand_title' => 'required|max:64|min:3|alpha'
        ]);

        $request->flash();

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator);
        }

        $brand = new Brand;

        $brand->addBrand($request);

        $brand->title = $request->brand_title;

        $brand->save();

        return redirect()->route('brand_index')->with('info_message', 'New brand was created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        return view('brand.show', ['brand' => $brand]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Brand $brand)
    {
        return view('brand.edit', ['brand' => $brand, 'return' => $request->return ?? '']);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        // $brand = new Brand;

        $brand->addBrand($request, 'edit');
        $brand->title = $request->brand_title;

        $brand->save();

        if ($request->return) {
            return redirect('brands/' . $request->return)->with('info_message', 'Brand was updated');
        }

        return redirect()->route('brand_index')->with('info_message', 'The brand was updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        if ($brand->getOutfits->count()) {
            return redirect()->back()->with('info_message', 'Can not delete the brand, coz he has outfits');
        }
        $brand->deleteOldBrand();
        $brand->delete();
        return redirect()->route('brand_index')->with('success_message', 'The brand was deleted');
    }
}
