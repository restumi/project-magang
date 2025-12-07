<?php

namespace App\Http\Controllers;

use App\Models\Hobby;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HobbyController extends Controller
{
    public function index()
    {
        $hobbies = Hobby::latest()->get();
        return view('hobbies.index', compact('hobbies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string'
        ]);

        Hobby::create($request->only('name', 'description'));

        return redirect()->back()->with('success', 'Hobby created!');
    }

    public function update(Request $request, Hobby $hobby)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string'
        ]);

        Log::info($request);

        try{
            $new = $hobby->update($request->only('name', 'description'));
            Log::info($new);
        } catch (Exception $e){
            Log::info(['error' => $e->getMessage()]);
        }

        return redirect()->back()->with('success', 'Hobby updated!');
    }

    public function destroy(Hobby $hobby)
    {
        $hobby->delete();
        return redirect()->back()->with('success', 'Hobby deleted!');
    }
}
