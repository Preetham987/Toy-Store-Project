<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductType;
use Illuminate\Support\Str;
use App\Helpers\helpers;

class ProductTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $producttypes = ProductType::latest('id')->paginate();
        return view('backend.producttype.index', compact('producttypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.producttype.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string',
            'status' => 'required|in:active,inactive',
        ]);

        $slug = generateUniqueSlug($request->title, ProductType::class);

        $validatedData['slug'] = $slug;

        $producttype = ProductType::create($validatedData);

        $message = $producttype
            ? 'Product Type successfully created'
            : 'Error, Please try again';

        return redirect()->route('producttype.index')->with(
            $producttype ? 'success' : 'error',
            $message
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $producttype = ProductType::find($id);

        if (!$producttype) {
            return redirect()->back()->with('error', 'Product Type not found');
        }

        return view('backend.producttype.edit', compact('producttype'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $producttype = ProductType::find($id);

        if (!$producttype) {
            return redirect()->back()->with('error', 'Product Type not found');
        }

        $validatedData = $request->validate([
            'title' => 'required|string',
            'status' => 'required|in:active,inactive',
        ]);

        $status = $producttype->update($validatedData);

        $message = $status
            ? 'Product Type successfully updated'
            : 'Error, Please try again';

        return redirect()->route('producttype.index')->with(
            $status ? 'success' : 'error',
            $message
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $producttype = ProductType::find($id);

        if (!$producttype) {
            return redirect()->back()->with('error', 'Product Type not found');
        }

        $status = $producttype->delete();

        $message = $status
            ? 'Product Type successfully deleted'
            : 'Error, Please try again';

        return redirect()->route('producttype.index')->with(
            $status ? 'success' : 'error',
            $message
        );
    }
}
