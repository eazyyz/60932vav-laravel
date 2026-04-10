<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    public function uploadAvatar(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $file = $request->file('avatar');
        $fileName = rand(1, 1000000) . '_' . $file->getClientOriginalName();

        try {
            $path = Storage::disk('s3')->putFileAs(
                'avatars',
                $file,
                $fileName
            );
            $fileUrl = Storage::disk('s3')->url($path);

        } catch (Exception $e) {
            return response()->json([
                'code' => 2,
                'message' => 'Ошибка загрузки файла в S3'
            ], 500);
        }

        $user->avatar = $fileUrl;
        $user->save();

        return response()->json([
            'code' => 0,
            'message' => 'Аватар успешно загружен',
            'avatar' => $fileUrl
        ]);
    }

}
