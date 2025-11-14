<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FeaturedIn;
use Illuminate\Support\Str;
use App\Helpers\helpers;

class FeaturedInController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $featuredins = FeaturedIn::latest('id')->paginate();
        return view('backend.featuredin.index', compact('featuredins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.featuredin.create');
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

        $slug = generateUniqueSlug($request->title, FeaturedIn::class);

        $validatedData['slug'] = $slug;

        $featuredin = FeaturedIn::create($validatedData);

        $message = $featuredin
            ? 'FeaturedIn successfully created'
            : 'Error, Please try again';

        return redirect()->route('featuredin.index')->with(
            $featuredin ? 'success' : 'error',
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
        $featuredin = FeaturedIn::find($id);

        if (!$featuredin) {
            return redirect()->back()->with('error', 'FeaturedIn not found');
        }

        return view('backend.featuredin.edit', compact('featuredin'));
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
        $featuredin = FeaturedIn::find($id);

        if (!$featuredin) {
            return redirect()->back()->with('error', 'FeaturedIn not found');
        }

        $validatedData = $request->validate([
            'title' => 'required|string',
            'status' => 'required|in:active,inactive',
        ]);

        $status = $featuredin->update($validatedData);

        $message = $status
            ? 'FeaturedIn successfully updated'
            : 'Error, Please try again';

        return redirect()->route('featuredin.index')->with(
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
        $featuredin = FeaturedIn::find($id);

        if (!$featuredin) {
            return redirect()->back()->with('error', 'FeaturedIn not found');
        }

        $status = $featuredin->delete();

        $message = $status
            ? 'FeaturedIn successfully deleted'
            : 'Error, Please try again';

        return redirect()->route('featuredin.index')->with(
            $status ? 'success' : 'error',
            $message
        );
    }
}
