<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Character;
use Illuminate\Support\Str;
use App\Helpers\helpers;

class CharacterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $characters = Character::latest('id')->paginate();
        return view('backend.character.index', compact('characters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.character.create');
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

        $slug = generateUniqueSlug($request->title, Character::class);

        $validatedData['slug'] = $slug;

        $character = Character::create($validatedData);

        $message = $character
            ? 'Character successfully created'
            : 'Error, Please try again';

        return redirect()->route('character.index')->with(
            $character ? 'success' : 'error',
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
        $character = Character::find($id);

        if (!$character) {
            return redirect()->back()->with('error', 'Character not found');
        }

        return view('backend.character.edit', compact('character'));
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
        $character = Character::find($id);

        if (!$character) {
            return redirect()->back()->with('error', 'Character not found');
        }

        $validatedData = $request->validate([
            'title' => 'required|string',
            'status' => 'required|in:active,inactive',
        ]);

        $status = $character->update($validatedData);

        $message = $status
            ? 'Character successfully updated'
            : 'Error, Please try again';

        return redirect()->route('character.index')->with(
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
        $character = Character::find($id);

        if (!$character) {
            return redirect()->back()->with('error', 'Character not found');
        }

        $status = $character->delete();

        $message = $status
            ? 'Character successfully deleted'
            : 'Error, Please try again';

        return redirect()->route('character.index')->with(
            $status ? 'success' : 'error',
            $message
        );
    }
}
