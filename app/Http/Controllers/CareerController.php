<?php

namespace App\Http\Controllers;

use App\Http\Requests\CareerRequest;
use App\Http\Resources\CareerResource;
use App\Models\Career;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CareerController extends Controller
{
    private $careers;
    private $career;

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index', 'show']]);
    }

    public function index()
    {
        $this->careers = Career::all();
        $careerResource = CareerResource::collection($this->careers);
        return $this->sendResponse($careerResource, "Successfully get all careers!");
    }

    public function show($id)
    {
        $this->career = Career::where('id', '=', $id)->first();
        return $this->sendResponse(new CareerResource($this->career), "Successfully get this career!");
    }

    public function store(CareerRequest $request)
    {
        $request->validate([
            'name' => 'required|regex:/^[A-Za-z0-9]+$/',
        ]);

        try {
            $post = Career::create([
                'divisionID' => $request->divisionID,
                'departmentID' => $request->departmentID,
                'positionID' => $request->positionID,
                'name' => $request->name,
                'type' => $request->type,
                'is_urgently_needed' => $request->is_urgently_needed,
                'responsibilities' => $request->responsibilities,
                'skill_qualifications' => $request->skill_qualifications,
                'benefits' => $request->benefits,
                'descriptions' => $request->descriptions
            ]);

            $this->career = new CareerResource($post);
        } catch (Exception $e) {
            return $this->sendError("Internal Server Error", $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $this->sendResponse($this->career, "Successfully add career!");
    }

    public function update(CareerRequest $request, $id)
    {
        $career = Career::find($id);

        if (!$career) {
            return $this->sendError('Career not found', 'The  career you looking for was not found', Response::HTTP_NOT_FOUND);
        }

        $career->divisionID = $request->divisionID;
        $career->departmentID = $request->departmentID;
        $career->positionID = $request->positionID;
        $career->name = $request->name;
        $career->type = $request->type;
        $career->is_urgently_needed = $request->is_urgently_needed;
        $career->responsibilities = $request->responsibilities;
        $career->skill_qualifications = $request->skill_qualifications;
        $career->benefits = $request->benefits;
        $career->descriptions = $request->descriptions;

        try {
            $career->save();
            $this->career = new CareerResource($career);
        } catch (Exception $e) {
            return $this->sendError('Internal Server Error', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $this->sendResponse($this->career, "Successfully update this career!");
    }

    public function destroy($id)
    {
        $this->career = Career::find($id);

        if (!$this->career) {
            return $this->sendError('Career not found', 'The  career you looking for was not found', Response::HTTP_NOT_FOUND);
        }

        try {
            $this->career->delete();
        } catch (Exception $e) {
            return $this->sendError('Internal Server Error', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $this->sendResponse($this->career, "Successfully delete this career!");
    }
}
