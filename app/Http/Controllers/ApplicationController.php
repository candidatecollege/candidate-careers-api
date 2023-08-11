<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApplicationRequest;
use App\Http\Resources\ApplicationResource;
use App\Models\Application;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class ApplicationController extends Controller
{
    private $applications;
    private $application;

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index', 'show']]);
    }

    public function index()
    {
        $this->applications = Application::all();
        $applicationResource = ApplicationResource::collection($this->applications);
        return $this->sendResponse($applicationResource, "Successfully get all applications!");
    }

    public function show($id)
    {
        $this->application = Application::find($id);

        if (!$this->application) {
            return $this->sendError('The application not found', 'The application you looking for was not found', Response::HTTP_NOT_FOUND);
        }

        $this->application = Application::where('id', '=', $id)->first();
        return $this->sendResponse(new ApplicationResource($this->application), "Successfully get this application!");
    }

    public function store(ApplicationRequest $request)
    {
        $request->validate([
            'full_name' => 'required|regex:/^[A-Za-z0-9.,]+$/',
            'reason' => 'required|regex:/^[A-Za-z0-9.,]+$/',
            'leadership_experience' => 'required|regex:/^[A-Za-z0-9.,]+$/',
            'skill_experience' => 'required|regex:/^[A-Za-z0-9.,]+$/',
            'busyness' => 'required|regex:/^[A-Za-z0-9.,]+$/',
            'reason_commitment_value' => 'required|regex:/^[A-Za-z0-9.,]+$/',
        ]);

        $cv = $request->file('cv')->store('cvs');
        $portfolio = $request->file('portfolio')->store('portfolios');

        $instagram = 'https://instagram.com/' . $request->instagram;
        $whatsapp = 'https://wa.me/' . $request->whatsapp;

        try {
            $post = Application::create([
                'email' => $request->email,
                'full_name' => $request->full_name,
                'university' => $request->university,
                'major' => $request->major,
                'instagram' => $instagram,
                'whatsapp' => $whatsapp,
                'divisionID' => $request->divisionID,
                'departmentID' => $request->departmentID,
                'reason' => $request->reason,
                'leadership_experience' => $request->leadership_experience,
                'skill_experience' => $request->skill_experience,
                'busyness' => $request->busyness,
                'commitment_value' => $request->commitment_value,
                'reason_commitment_value' => $request->reason_commitment_value,
                'cv' => $cv,
                'portfolio' => $portfolio,
                'is_available_for_unpaid' => $request->is_available_for_unpaid,
            ]);

            $this->application = new ApplicationResource($post);
        } catch (Exception $e) {
            Storage::delete($cv);
            Storage::delete($portfolio);
            return $this->sendError('Internal Server Error', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $this->sendResponse($this->application, "Successfully submit the application!");
    }

    public function destroy($id)
    {
        $this->application = Application::find($id);

        if (!$this->application) {
            return $this->sendError('The application not found', 'The application you looking for was not found', Response::HTTP_NOT_FOUND);
        }

        try {
            Storage::delete($this->application->cv);
            Storage::delete($this->application->portfolio);
        } catch (Exception $e) {
            return $this->sendError('Internal Server Error', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $this->sendResponse($this->application, "Successfully delete this application!");
    }
}
