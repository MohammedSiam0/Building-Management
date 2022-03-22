<?php

namespace App\Http\Controllers;

use App\Models\Financial;
use App\Models\People;
use App\Models\Service;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FinancialController extends Controller
{


    public function __construct()
    {
        $this->authorizeResource(Financial::class, 'financial');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $financials = Financial::with(['people','service'])->get();

        return response()->view('financials.index', ['financials' => $financials]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services =Service::get(['id','service_name','service_price']);

        $people =People::get();
        return response()->view('financials.create',[
           'services' =>$services,
            'people' =>$people
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator($request->all(), [
            'bond_number'=>'required',
            'amount_paid'=>'required',
            'payment_date'=>'date',
            'people_id' => 'required|int|exists:peoples,id',
            'service_id' => 'required|int|exists:services,id',
        ])->validate();

        $financials =new Financial();
        $financials->bond_number = $request->input('bond_number');
        $financials->amount_paid = $request->input('amount_paid');
        $financials->payment_date = $request->input('payment_date');
        $financials->people_id = $request->input('people_id');
        $financials->service_id = $request->input('service_id');
        $isSaved = $financials->save();
        return response()->json(
            ['message' => $isSaved ? __('created successfully') : __('Create failed!')],
            $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST,
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Financial  $financial
     * @return \Illuminate\Http\Response
     */
    public function show(Financial $financial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Financial  $financial
     * @return \Illuminate\Http\Response
     */
    public function edit(Financial $financial)
    {
        $services =Service::all();
        $people =People::all();
        return response()->view('financials.edit',[
            'services' =>$services,
            'people' =>$people,
            'financial' =>$financial
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Financial  $financial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Financial $financial)
    {
        $validator = Validator($request->all(), [
            'bond_number'=>'required',
            'amount_paid'=>'required',
            'payment_date'=>'date',
            'people_id' => 'required|int|exists:peoples,id',
            'service_id' => 'required|int|exists:services,id',
        ])->validate();
        $financial->service_name = $request->input('service_name');
        $financial->service_price = $request->input('service_price');
        $financial->description = $request->input('description');
        $financial->parent_id = $request->input('parent_id');
        $isSaved = $financial->save();
        return response()->json(
            ['message' => $isSaved ? __('Updated successfully') : __('Update failed!')],

            $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST,
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Financial  $financial
     * @return \Illuminate\Http\Response
     */
    public function destroy(Financial $financial)
    {
        $isDeleted = $financial->delete();
        return response()->json(
            ['message' => $isDeleted ? 'Deleted successfully' : 'Delete failed!'],
            $isDeleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }

    public function invoice($id)
    {
        $financials = Financial::with(['people','service'])
            ->get();


        return view('invoice',['financials'=>$financials]);
    }
}
