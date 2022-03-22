<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Service::class, 'service');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $service =Service::with('parent')->get();
        return response()->view('services.index',['service'=>$service]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parents = Service::all();
        return response()->view('services.create',['parents'=>$parents]);

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
            'service_name'=>'required|string',
            'service_price'=>'required|string',
            'description'=>'nullable',
            'parent_id' => 'nullable|int|exists:services,id',
        ])->validate();
        $servies =new Service();
        $servies->service_name = $request->input('service_name');
        $servies->service_price = $request->input('service_price');
        $servies->description = $request->input('description');
        $servies->parent_id = $request->input('parent_id');
        $isSaved = $servies->save();

        return response()->json(
            ['message' => $isSaved ? __('created successfully') : __('Create failed!')],
            $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST,
        );

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        $parents = Service::where('id', '<>', $service->id)->get();

        return response()->view('services.edit', [
            'service' => $service,
            'parents' => $parents,

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        $validator = Validator($request->all(), [
            'service_name'=>'required|string',
            'service_price'=>'required|string',
            'description'=>'nullable',
            'parent_id' => 'nullable|int|exists:services,id',
        ])->validate();

        $service->service_name = $request->input('service_name');
        $service->service_price = $request->input('service_price');
        $service->description = $request->input('description');
        $service->parent_id = $request->input('parent_id');
        $isSaved = $service->save();
        return response()->json(
            ['message' => $isSaved ? __('Updated successfully') : __('Update failed!')],

            $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST,
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        $isDeleted = $service->delete();
        return response()->json(
            ['message' => $isDeleted ? 'Deleted successfully' : 'Delete failed!'],
            $isDeleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }
}
