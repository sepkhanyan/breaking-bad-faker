<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Episode;
use Illuminate\Http\Request;

class EpisodesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $limit = isset($request['limit']) && $request['limit'] ? $request['limit'] : 10;
        $episodes = Episode::paginate($limit);
        return responder()->success($episodes);
    }

    /**
     * Display the specified resource.
     *
     * @param Episode $episode
     * @return \Illuminate\Http\Response
     */
    public function show(Episode $episode)
    {
        return responder()->success($episode->load('characters'));
    }
}
