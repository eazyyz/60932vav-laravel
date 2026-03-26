<?php

namespace App\Http\Controllers;

use App\Models\Text;
use Illuminate\Http\Request;

class TextControllerAPI extends Controller
{
//    public function index(Request $request)
//    {
//        return response(Text::all());
//    }

    public function index(Request $request)
    {
        $perpage = $request->perpage ?? 5;
        $page = $request->page ?? 0;
        $offset = $perpage * $page;

        return response(Text::limit($perpage)
            ->offset($offset)
            ->get());
    }

    public function total()
    {
        return response(Text::all()->count());
    }
    public function show($id)
    {
        return response(Text::find($id));
    }

    public function store(Request $request)
    {
        //
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
