<?php

namespace App\Http\Controllers;

use App\Models\Location;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

use App\Services\LocationService;

class LocationController extends Controller
{
    /**
     * @var locationService
     */
    protected $locationService;

    /**
     * LocationController Constructor
     *
     * @param LocationService $locationService
     */
    public function __construct(LocationService $locationService)
    {
        $this->locationService = $locationService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'radius' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => Response::HTTP_BAD_REQUEST,
                'errors' => $validator->messages()
            ]);
        }

        try {
            $result = $this->locationService->getAll($request->all());
        } catch (Exception $e) {
            $result = [
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'error' => 'Something went wrong, please try again.'
            ];
        }

        return response()->json($result);
    }
}
