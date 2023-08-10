<?php

namespace App\Http\Controllers;

use App\Http\Requests\DivisionRequest;
use App\Http\Resources\DivisionResource;
use App\Models\Division;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DivisionController extends Controller
{
    private $divisions;
    private $division;

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index', 'show']]);
    }

    public function index()
    {
        $this->divisions = Division::all();
        $divisionResource = DivisionResource::collection($this->divisions);
        return $this->sendResponse($divisionResource, "Successfully get all divisions!");
    }

    public function show($id)
    {
        $this->division = Division::where('id', '=', $id)->first();
        return $this->sendResponse(new DivisionResource($this->division), "Successfully get this division!");
    }

    public function store(DivisionRequest $request)
    {
        try {
            $post = Division::create([
                'name' => $request->name,
            ]);

            $this->division = new DivisionResource($post);
        } catch (Exception $e) {
            return $this->sendError('Internal Server Error', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $this->sendResponse($this->division, "Successfully add division!");
    }

    public function update(DivisionRequest $request, $id)
    {
        $division = Division::find($id);

        if (!$division) {
            return $this->sendError('Division not found', 'The division you looking for was not found', Response::HTTP_NOT_FOUND);
        }

        $division->name = $request->name;

        try {
            $division->save();
            $this->division = new DivisionResource($division);
        } catch (Exception $e) {
            return $this->sendError('Internal Server Error', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $this->sendResponse($this->division, "Sucessfully update this division!");
    }

    public function destroy($id)
    {
        $this->division = Division::find($id);

        if (!$this->division) {
            return $this->sendError('Division not found', 'The division you looking for was not found', Response::HTTP_NOT_FOUND);
        }

        try {
            $this->division->delete();
        } catch (Exception $e) {
            return $this->sendError('Internal Server Error', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $this->sendResponse($this->division, "Sucessfully delete this division!");
    }
}
