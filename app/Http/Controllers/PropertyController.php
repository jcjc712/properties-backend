<?php

namespace App\Http\Controllers;

use App\Property\PropertyService;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    private $propertyService;
    public function __construct(PropertyService $propertyService)
    {
        $this->propertyService = $propertyService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = $this->propertyService->index();
        return response()->json($response, 201);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'code' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'administrative_area_level_1' => 'required',
            'name' => 'required',
            'country' => 'required',
            'locality' => 'required',
            'political' => 'required',
            'route' => 'required',
            'street_number' => 'required',
            'description' => 'required'
        ]);
        $response = $this->propertyService->create($request->all());
        return response()->json($response, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $response = $this->propertyService->show($id);
        return response()->json($response, 201);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function edit(Property $property)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'code' => 'required',
            'description' => 'required'
        ]);
        $response = $this->propertyService->update($request->all(), $id);
        return response()->json($response, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $response = $this->propertyService->delete($id);
        return response()->json($response, 201);
    }
}
