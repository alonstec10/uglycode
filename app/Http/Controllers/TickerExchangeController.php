<?php

namespace App\Http\Controllers;

use App\Models\Polygon\Exchange;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class TickerExchangeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index( string $exchange = "" ): Response
    {
        if( $exchange ) {
            $data = Exchange::all()->where("mic", "=", $exchange)->first();
            return response($data->tickers->toArray(), ResponseAlias::HTTP_ACCEPTED);
        } else {
            return response(Exchange::all()->toArray(), ResponseAlias::HTTP_OK);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //

        return "create";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
        return "store";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {

        return "show";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
        return "edit";
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
        return "update";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
        return "desytroy";
    }
}
