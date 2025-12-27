<?php

namespace App\Http\Controllers\Api;

use App\Classes\apiResponse;
use App\Http\Controllers\Controller;
use App\Models\Hobby;
use Exception;
use Illuminate\Http\Request;

class HobbyController extends Controller
{
    public function index()
    {
        try{
            $hobbies = Hobby::all();
            return apiResponse::success($hobbies, 'success get all hobbies');
        } catch (Exception $e){
            return apiResponse::error($e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string'
        ], [
            'name.required' => 'name fields is required!'
        ]);

        try{
            $hobby = Hobby::create($request->only('name', 'description'));
            return apiResponse::success($hobby, 'success created new hobby!', 201);
        } catch (Exception $e){
            return apiResponse::error($e->getMessage());
        }
    }

    public function update(Request $request, Hobby $hobby)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string'
        ],[
            'name.required' => 'name fields is required!',
        ]);

        try{
            $hobby->update($request->only('name', 'description'));
            return apiResponse::success($hobby, 'success updated hobby!');
        } catch (Exception $e){
            return apiResponse::error($e->getMessage());
        }
    }

    public function destroy(Hobby $hobby)
    {
        try{
            $hobby->delete();
            return apiResponse::success($hobby, 'success deleted hobby!');
        } catch (Exception $e){
            return apiResponse::error($e->getMessage());
        }
    }
}
