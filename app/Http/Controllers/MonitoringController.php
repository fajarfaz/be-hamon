<?php

namespace App\Http\Controllers;

use App\Models\monitoring;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MonitoringController extends Controller
{
    public function call($id)
    {
        $response = monitoring::with('hardware')->where(['hardware_id' => $id])->get();

        return response()->json($response);
    }

    public function create(Request $request)
    {
        $hardwares = $request->json()->all();

        foreach ($hardwares as $hardware) {

            if ($hardware['name'] != 'Categories') {
                $id = str_replace(' ', '', $hardware['name']);
                $price = str_replace(['Rp ', '.'], '', $hardware['price']);
                $cek = monitoring::whereDate('created_at','=', Carbon::today())-> where(['hardware_id' => $id ])->get();
                // return $cek->count();
                if($cek->count() < 1){ //cek apakah hari ini data sudah masuk
                    $result = monitoring::create(
                        [
                            'hardware_id' => $id,
                            'name' => $hardware['name'],
                            'price' => $price,
                            'source' => $hardware['source'],
                            'link' => $hardware['link'],
                        ]
                    );
                  
                }
              
            }

            // print_r($result);
        }
    }
}
