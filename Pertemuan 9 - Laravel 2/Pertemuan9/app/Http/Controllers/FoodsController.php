<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class FoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //GET
        $foods = Food::all();
        return view('index', compact('foods'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //Dipanggil ketika ingin memanggil view
        //GET
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Memanggil function
        //POST
        $foods = [
            'name' => $request->name,
            'price' => $request->price,
            'descriptions'=> $request->descriptions,
        ];

        Food::create($foods);
        return redirect()->to('Foods');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //GET
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //GET
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //PUT
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
