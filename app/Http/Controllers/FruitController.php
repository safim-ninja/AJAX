<?php

namespace App\Http\Controllers;

use App\Models\Fruit;
use Illuminate\Http\Request;

class FruitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fruits = Fruit::get();
        return response()->json($fruits);
        // return response('yo', 200);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'price' => 'required'
        // ]);
        // return response('success', 201);
        Fruit::create([
            'name' => $request->name,
            'price' => $request->price
        ]);
        return response('success', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Fruit $fruit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fruit $fruit)
    {
        return response()->json($fruit, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fruit $fruit)
    {
        $fruit->update([
            'name' => $request->name,
            'price' => $request->price
        ]);

        return response('success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fruit $fruit)
    {
        Fruit::destroy($fruit->id);
    }
}
