<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Character;
use Illuminate\Http\Request;

class CharactersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $limit = isset($request['limit']) && $request['limit'] ? $request['limit'] : 10;
        $characters = Character::with('episodes:id', 'quotes:id');
        $characters = $characters->name($request['name']);
        $characters = $characters->paginate($limit);
        return responder()->success($characters);
    }

    /**
     * Display a random resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function random()
    {
        $character = Character::inRandomOrder()->first();
        return responder()->success($character);
    }

    /**
     * Display the specified resource.
     *
     * @param Character $character
     * @return \Illuminate\Http\Response
     */
    public function show(Character $character)
    {
        return responder()->success($character->load('episodes:id', 'quotes:id'));
    }
}
