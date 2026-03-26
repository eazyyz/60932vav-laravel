<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserControllerAPI extends Controller
{
//    public function index()
//    {
//        return response(User::all());
//    }
    public function index(Request $request)
    {
        $perpage = $request->perpage ?? 5;
        $page = $request->page ?? 0;
        $offset = $perpage * $page;

        return response(User::limit($perpage)
            ->offset($offset)
            ->get());
    }

    public function total()
    {
        return response(User::all()->count());
    }
    public function show($id)
    {
        return response(User::find($id));
    }

    /**
     * Store a newly created resource in storage.
     */
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
