<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartmentRequest;
use App\Http\Resources\DepartmentResource;
use App\Models\Department;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DepartmentController extends Controller
{
    private $departments;
    private $department;

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index', 'show']]);
    }

    public function index()
    {
        $this->departments = Department::all();
        $departmentResource = DepartmentResource::collection($this->departments);
        return $this->sendResponse($departmentResource, "Successfully get all departments!");
    }

    public function show($id)
    {
        $this->department = Department::where('id', '=', $id)->first();
        return $this->sendResponse(new DepartmentResource($this->department), "Successfully get this department!");
    }

    public function store(DepartmentRequest $request)
    {
        try {
            $post = Department::create([
                'name' => $request->name,
            ]);

            $this->department = new DepartmentResource($post);
        } catch (Exception $e) {
            return $this->sendError("Internal Server Error", $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $this->sendResponse($this->department, "Successfully add department!");
    }

    public function update(DepartmentRequest $request, $id)
    {
        $department = Department::find($id);

        if (!$department) {
            return $this->sendError('Department not found', 'The department you looking for was not found', Response::HTTP_NOT_FOUND);
        }

        $department->name = $request->name;

        try {
            $department->save();
            $this->department = new DepartmentResource($department);
        } catch (Exception $e) {
            return $this->sendError('Internal Server Error', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $this->sendResponse($this->department, "Successfully update this department!");
    }

    public function destroy($id)
    {
        $this->department = Department::find($id);

        if (!$this->department) {
            return $this->sendError('Department not found', 'The department you looking for was not found', Response::HTTP_NOT_FOUND);
        }

        try {
            $this->department->delete();
        } catch (Exception $e) {
            return $this->sendError('Internal Server Error', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $this->sendResponse($this->department, "Successfully delete this department!");
    }
}
