<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\export;
use App\Models\Service;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ExportController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(export::class, 'export');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exports = export::all();
        return response()->view('export.index', ['exports' => $exports]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services =Service::all();
        $people =Employee::all();
        return response()->view('export.create',[
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

            'description'=>'nullable',
            'bond_number'=>'required',
            'company_name'=>'nullable',
            'date'=>'date',
            'employee_id' => 'nullable|int|exists:employees,id',
            'service_id' => 'required|int|exists:services,id',
        ])->validate();

        $exports =new export();
        $exports->employee_id = $request->input('employee_id');
        $exports->service_id = $request->input('service_id');
        $exports->date = $request->input('date');
        $exports->description = $request->input('description');
        $exports->bond_number = $request->input('bond_number');
        $exports->company_name = $request->input('company_name');
        $exports->description = $request->input('description');
        $exports->amount = $request->input('amount');
        $isSaved = $exports->save();
        return response()->json(
            ['message' => $isSaved ? __('created successfully') : __('Create failed!')],
            $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST,
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\export  $export
     * @return \Illuminate\Http\Response
     */
    public function show(export $export)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\export  $export
     * @return \Illuminate\Http\Response
     */
    public function edit(export $export)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\export  $export
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, export $export)
    {
        $validator = Validator($request->all(), [

            'description'=>'nullable',
            'bond_number'=>'required',
            'company_name'=>'nullable',
            'date'=>'date',
            'employee_id' => 'required|int|exists:employees,id',
            'service_id' => 'required|int|exists:services,id',
        ])->validate();

        $export->employee_id = $request->input('employee_id');
        $export->service_id = $request->input('service_id');
        $export->date = $request->input('date');
        $export->description = $request->input('description');
        $export->bond_number = $request->input('bond_number');
        $export->company_name = $request->input('company_name');
        $isSaved = $export->save();
        return response()->json(
            ['message' => $isSaved ? __('Updated successfully') : __('Update failed!')],

            $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST,
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\export  $export
     * @return \Illuminate\Http\Response
     */
    public function destroy(export $export)
    {
        $isDeleted = $export->delete();
        return response()->json(
            ['message' => $isDeleted ? 'Deleted successfully' : 'Delete failed!'],
            $isDeleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }
}
