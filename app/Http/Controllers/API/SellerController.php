<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\SellerRequest;
use App\Models\Seller\Seller;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Seller[]|\Illuminate\Database\Eloquent\Collection|
     */
    public function index()
    {
        $seller = Seller::query()->with('sales')->get();
        $seller = collect($seller)->map(function ($seller){
            $seller['commission'] = 'R$'.number_format(round((float)collect($seller['sales'])->sum('commission'),2),2);
            return $seller;
        });

        return $seller;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SellerRequest $request
     * @return Seller
     */
    public function store(SellerRequest $request)
    {
        $seller = new Seller();
        $seller->fill($request->all());
        $seller->saveOrFail();
        return $seller;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SellerRequest $request
     * @param  int  $id
     * @return Seller
     */
    public function update(Request $request, $id)
    {
        $seller = Seller::find($id);
        $seller->fill($request->all());
        $seller->saveOrFail();
        return $seller;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Seller::query()->where('id', $id)->delete();
    }
}
