<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Series;
use Illuminate\Support\Str;
use App\Helpers\helpers;

class SeriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $serieses = Series::latest('id')->paginate();
        return view('backend.series.index', compact('serieses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.series.create');
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

        $slug = generateUniqueSlug($request->title, Series::class);

        $validatedData['slug'] = $slug;

        $series = Series::create($validatedData);

        $message = $series
            ? 'Series successfully created'
            : 'Error, Please try again';

        return redirect()->route('series.index')->with(
            $series ? 'success' : 'error',
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
        $series = Series::find($id);

        if (!$series) {
            return redirect()->back()->with('error', 'Series not found');
        }

        return view('backend.series.edit', compact('series'));
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
        $series = Series::find($id);

        if (!$series) {
            return redirect()->back()->with('error', 'Series not found');
        }

        $validatedData = $request->validate([
            'title' => 'required|string',
            'status' => 'required|in:active,inactive',
        ]);

        $status = $series->update($validatedData);

        $message = $status
            ? 'Series successfully updated'
            : 'Error, Please try again';

        return redirect()->route('series.index')->with(
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
        $series = Series::find($id);

        if (!$series) {
            return redirect()->back()->with('error', 'Series not found');
        }

        $status = $series->delete();

        $message = $status
            ? 'Series successfully deleted'
            : 'Error, Please try again';

        return redirect()->route('series.index')->with(
            $status ? 'success' : 'error',
            $message
        );
    }
}
