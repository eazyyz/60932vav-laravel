<?php

namespace App\Http\Controllers;

use App\Models\TokenTransaction;
use Illuminate\Http\Request;

class TokenControllerAPI extends Controller
{
    public function index()
    {
        return response(TokenTransaction::all());
    }

    public function show(string $id)
    {
        return response(TokenTransaction::find($id));
    }
    public function store(Request $request)
    {
        //
    }

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
