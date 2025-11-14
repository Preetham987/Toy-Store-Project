<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Size;
use Illuminate\Support\Str;
use App\Helpers\helpers;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sizes = Size::latest('id')->paginate();
        return view('backend.size.index', compact('sizes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.size.create');
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

        $slug = generateUniqueSlug($request->title, Size::class);

        $validatedData['slug'] = $slug;

        $size = Size::create($validatedData);

        $message = $size
            ? 'Size successfully created'
            : 'Error, Please try again';

        return redirect()->route('size.index')->with(
            $size ? 'success' : 'error',
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
        $size = Size::find($id);

        if (!$size) {
            return redirect()->back()->with('error', 'Size not found');
        }

        return view('backend.size.edit', compact('size'));
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
        $size = Size::find($id);

        if (!$size) {
            return redirect()->back()->with('error', 'Size not found');
        }

        $validatedData = $request->validate([
            'title' => 'required|string',
            'status' => 'required|in:active,inactive',
        ]);

        $status = $size->update($validatedData);

        $message = $status
            ? 'Size successfully updated'
            : 'Error, Please try again';

        return redirect()->route('size.index')->with(
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
        $size = Size::find($id);

        if (!$size) {
            return redirect()->back()->with('error', 'Size not found');
        }

        $status = $size->delete();

        $message = $status
            ? 'Size successfully deleted'
            : 'Error, Please try again';

        return redirect()->route('size.index')->with(
            $status ? 'success' : 'error',
            $message
        );
    }
}
