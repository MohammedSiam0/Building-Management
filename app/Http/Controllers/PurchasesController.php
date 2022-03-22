<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PurchasesController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Purchase::class, 'purchase');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchases = Purchase::all();
        return response()->view('purchases.index', ['purchases' => $purchases]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('purchases.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //*invoice_number
        //product_name
        //price
        //date_of_purchase
        //content
        $validator = Validator($request->all(), [
            'invoice_number' => 'required|numeric',
            'product_name' => 'required|string',
            'price' => 'required|numeric',
            'date_of_purchase' => 'required|date',
            'description' => 'nullable',

        ])->validate();

        $purchases = new Purchase();
        $purchases->invoice_number = $request->input('invoice_number');
        $purchases->product_name = $request->input('product_name');
        $purchases->price = $request->input('price');
        $purchases->date_of_purchase = $request->input('date_of_purchase');
        $purchases->description = $request->input('description');
        $isSaved = $purchases->save();

        return response()->json(
            ['message' => $isSaved ? __('created successfully') : __('Create failed!')],
            $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST,
        );

    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Purchase  $purchases
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {

        return response()->view('purchases.edit', [
            'purchase' => $purchase,

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Purchase  $purchases
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchase $purchases)
    {
        $validator = Validator($request->all(), [
            'invoice_number' => 'required|numeric',
            'product_name' => 'required|string',
            'price' => 'required|numeric',
            'date_of_purchase' => 'required|date',
            'description' => 'nullable',

        ])->validate();
        $purchases->invoice_number = $request->input('invoice_number');
        $purchases->product_name = $request->input('product_name');
        $purchases->price = $request->input('price');
        $purchases->date_of_purchase = $request->input('date_of_purchase');
        $purchases->description = $request->input('description');
        $isSaved = $purchases->save();
        return response()->json(
            ['message' => $isSaved ? __('Updated successfully') : __('Update failed!')],

            $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST,
        );

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Purchase  $purchases
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase)
    {
        $isDeleted = $purchase->delete();
        return response()->json(
            ['message' => $isDeleted ? 'Deleted successfully' : 'Delete failed!'],
            $isDeleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }
}
