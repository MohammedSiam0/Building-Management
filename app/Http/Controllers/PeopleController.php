<?php

namespace App\Http\Controllers;

use App\Models\People;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class PeopleController extends Controller
{

     public function __construct()
    {
         $this->authorizeResource(People::class, 'people');
     }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pepoles = People::withCount('service')->get();

        return response()->view('peoples.index', ['pepoles' => $pepoles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return response()->view('peoples.create');
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
            'name' => 'required|string|min:3|max:100',
            'mobile' => 'required|numeric',
            'phone' => 'required|numeric',
            'identification_number' => 'required|numeric',
            'apartment_number' => 'required|numeric',
            'floor_number' => 'required|numeric',
            'family_members' => 'required|numeric',
        ])->validate();

        $pepole = new People();
        $pepole->name = $request->input('name');
        $pepole->mobile = $request->input('mobile');
        $pepole->phone = $request->input('phone');
        $pepole->identification_number = $request->input('identification_number');
        $pepole->apartment_number = $request->input('apartment_number');
        $pepole->floor_number = $request->input('floor_number');
        $pepole->family_members = $request->input('family_members');
        $pepole->dwelling = $request->input('dwelling') ;
        $pepole->active = $request->input('active');
        $isSaved = $pepole->save();

        return response()->json(
            ['message' => $isSaved ? __('created successfully') : __('Create failed!')],
            $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST,
        );
    }


    public function show(People $people)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\People  $pepole
     * @return \Illuminate\Http\Response
     */
    public function edit(People $pepole)
    {
        //

        return response()->view('peoples.edit', [
            'pepole' => $pepole,

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\People  $pepole
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, People $pepole)
    {
        //
        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3|max:100',
            'mobile' => 'required|numeric',
            'phone' => 'required|numeric',
            'identification_number' => 'required|numeric',
            'apartment_number' => 'required|numeric',
            'floor_number' => 'required|numeric',
            'family_members' => 'required|numeric',
        ])->validate();


        $pepole->name = $request->input('name');
        $pepole->mobile = $request->input('mobile');
        $pepole->phone = $request->input('phone');
        $pepole->identification_number = $request->input('identification_number');
        $pepole->apartment_number = $request->input('apartment_number');
        $pepole->floor_number = $request->input('floor_number');
        $pepole->family_members = $request->input('family_members');

        $isSaved = $pepole->save();
        return response()->json(
            ['message' => $isSaved ? __('Updated successfully') : __('Update failed!')],

            $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST,
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\People  $pepole
     * @return \Illuminate\Http\Response
     */
    public function destroy(People $pepole)
    {
        //
        $isDeleted = $pepole->delete();
        return response()->json(
            ['message' => $isDeleted ? 'Deleted successfully' : 'Delete failed!'],
            $isDeleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }
}
