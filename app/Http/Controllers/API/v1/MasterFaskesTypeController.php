<?php

namespace App\Http\Controllers\API\v1;

use App\MasterFaskesType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MasterFaskesTypeController extends Controller
{
    public function index(Request $request)
    {

        try {
            $data = MasterFaskesType::all();
        } catch (\Exception $exception) {
            return response()->format(400, $exception->getMessage());
        }

        return response()->format(200, 'success', $data);
    }
}
