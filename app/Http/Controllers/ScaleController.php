<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Scale;
use Illuminate\Support\Str;
use App\Helpers\helpers;

class ScaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $scales = Scale::latest('id')->paginate();
        return view('backend.scale.index', compact('scales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.scale.create');
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

        $slug = generateUniqueSlug($request->title, Scale::class);

        $validatedData['slug'] = $slug;

        $scale = Scale::create($validatedData);

        $message = $scale
            ? 'Scale successfully created'
            : 'Error, Please try again';

        return redirect()->route('scale.index')->with(
            $scale ? 'success' : 'error',
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
        $scale = Scale::find($id);

        if (!$scale) {
            return redirect()->back()->with('error', 'Scale not found');
        }

        return view('backend.scale.edit', compact('scale'));
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
        $scale = Scale::find($id);

        if (!$scale) {
            return redirect()->back()->with('error', 'Scale not found');
        }

        $validatedData = $request->validate([
            'title' => 'required|string',
            'status' => 'required|in:active,inactive',
        ]);

        $status = $scale->update($validatedData);

        $message = $status
            ? 'Scale successfully updated'
            : 'Error, Please try again';

        return redirect()->route('scale.index')->with(
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
        $scale = Scale::find($id);

        if (!$scale) {
            return redirect()->back()->with('error', 'Scale not found');
        }

        $status = $scale->delete();

        $message = $status
            ? 'Scale successfully deleted'
            : 'Error, Please try again';

        return redirect()->route('scale.index')->with(
            $status ? 'success' : 'error',
            $message
        );
    }
}
