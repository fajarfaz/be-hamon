<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hardware;

class HardwareController extends Controller
{
    public function index()
    {
        $response = Hardware::all();
        return response()->json($response);
    }

    public function list(Request $request)
    {
        return  $request;
    }

    public function create(Request $request)
    {
        // dd($request);
        $hardwares = $request->json()->all();
       
        foreach ($hardwares as $hardware) {
            // dd($hardware);
            if (@$hardware['name'] != 'Categories') {
                $result = Hardware::updateOrCreate(
                    ['id_ori' => str_replace(' ', '', $hardware['name'])],
                    [
                        'id_ori' => str_replace(' ', '', $hardware['name']),
                        'name' => $hardware['name'],
                        'brand' => $hardware['brand'],
                        'desc' => html_entity_decode($hardware['desc']),
                        'category' => $hardware['category'],
                    ]
                );
                print($result);
            }
        }
    }
}
