<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Service;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EmployeeController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Employee::class, 'employee');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $employee = Employee::get();
        $employeeSum = Employee::sum('salary');
        return response()->view('employee.index', [
            'employees' => $employee,
            'employeeSum' =>$employeeSum
        ]);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $service =Service::with('parent')->get(['id','service_name']);
        return response()->view('employee.create',[
            'service' =>$service
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator($request->all(), [
            'name'=>'required',
            'mobile'=>'required',
            'identification_number'=>'required',
            'work_time'=>'required',
            'type_job'=>'required',
            'date_job'=>'required',
            'salary'=>'required',
            'photo'=>'required|image',


        ])->validate();

        $employee = new Employee();
        $employee->name = $request->input('name');
        $employee->mobile = $request->input('mobile');
        $employee->phone = $request->input('phone');
        $employee->identification_number = $request->input('identification_number');
        $employee->work_time = $request->input('work_time');
        $employee->type_job = $request->input('type_job');
        $employee->date_job = $request->input('date_job');
        $employee->salary = $request->has('salary');
        $employee->living = $request->has('living');
        if ($request->hasFile('photo')){
            $imgname =time().'_'.$employee->name.'.'.$request->file('photo')->extension();
            $request->file('photo')->storePubliclyAs('upload',$imgname,['disk'=>'public']);
            $employee->photo ='upload/'.$imgname;
        }
        // $employee->photo = $request->has('photo');

        $isSaved = $employee->save();
        return response()->json(
            ['message' => $isSaved ? __(' created successfully') : __('Create failed!')],
            $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST,
        );

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
        $service =Service::all();
        return response()->view('employee.edit', [
            'employee' => $employee,
            'service' => $service
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $validator = Validator($request->all(), [
            'name'=>'required',
            'mobile'=>'required',
            'identification_number'=>'required',
            'work_time'=>'required',
            'type_job'=>'required',
            'date_job'=>'required',
            'salary'=>'required',
   //      'photo'=>'required|image',


        ])->validate();
                $employee->name = $request->input('name');
                $employee->phone = $request->input('phone');
                $employee->mobile = $request->input('mobile');
                $employee->identification_number = $request->input('identification_number');
                $employee->work_time = $request->input('work_time');
                $employee->type_job = $request->input('type_job');
                $employee->date_job = $request->input('date_job');
                $employee->salary = $request->input('salary');
                $employee->living = $request->input('living');
        //      $employee->photo = $request->input('photo');
           

                $isSaved = $employee->save();
                return response()->json(
                    ['message' => $isSaved ? 'Updated successfully' : 'Update failed!'],
                    $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST,
                );


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        //
        $isDelete = $employee->delete();
        return response()->json(
            ['message' => $isDelete ? 'Deleted Successfully' : 'Delete failed'],
            $isDelete ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST,
        );
    }
}
