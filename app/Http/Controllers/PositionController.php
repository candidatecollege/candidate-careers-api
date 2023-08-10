<?php

namespace App\Http\Controllers;

use App\Http\Requests\PositionRequest;
use App\Http\Resources\PositionResource;
use App\Models\Position;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PositionController extends Controller
{
    private $positions;
    private $position;

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index', 'show']]);
    }

    public function index()
    {
        $this->positions = Position::all();
        $positionResource = PositionResource::collection($this->positions);
        return $this->sendResponse($positionResource, "Successfully get all positions");
    }

    public function show($id)
    {
        $this->position = Position::where('id', '=', $id)->first();
        return $this->sendResponse(new PositionResource($this->position), "Successfully get this position!");
    }

    public function store(PositionRequest $request)
    {
        try {
            $post = Position::create([
                'name' => $request->name,
            ]);

            $this->position = new PositionResource($post);
        } catch (Exception $e) {
            return $this->sendError("Internal Server Error", $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $this->sendResponse($this->position, "Successfully add position!");
    }

    public function update(PositionRequest $request, $id)
    {
        $position = Position::find($id);

        if (!$position) {
            return $this->sendError('Position not found', 'The position you looking for was not found', Response::HTTP_NOT_FOUND);
        }

        $position->name = $request->name;

        try {
            $position->save();
            $this->position = new PositionResource($position);
        } catch (Exception $e) {
            return $this->sendError('Internal Server Error', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $this->sendResponse($this->position, "Successfully update this position!");
    }

    public function destroy($id)
    {
        $this->position = Position::find($id);

        if (!$this->position) {
            return $this->sendError('Position not found', 'The position you looking for was not found', Response::HTTP_NOT_FOUND);
        }

        try {
            $this->position->delete();
        } catch (Exception $e) {
            return $this->sendError('Internal Server Error', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $this->sendResponse($this->position, "Successfully delete this position!");
    }
}
