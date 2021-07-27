<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Quote;
use Illuminate\Http\Request;

class QuotesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $limit = isset($request['limit']) && $request['limit'] ? $request['limit'] : 10;
        $quotes = Quote::paginate($limit);
        return responder()->success($quotes);
    }

    /**
     * Display a random resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function random(Request $request)
    {
        $quote = Quote::query();
        $quote = $quote->character($request['author']);
        $quote = $quote->inRandomOrder()->first();
        return responder()->success($quote);
    }
}
