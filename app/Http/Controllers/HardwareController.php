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
        $hardwares = $request->json()->all();

        foreach ($hardwares as $hardware) {

            if ($hardware['name'] != 'Categories') {
                $result = Hardware::create([
                    'name' => $hardware['name'],
                    'price' => $hardware['price'],
                    'source' => $hardware['source'],
                ]);
            }

            // print_r($result);
        }



        // foreach($area as $i => $v)
        // {
        //     echo $v['name'].'<br/>';
        //     echo $v['price'].'<br/>';
        // }



    }
}
