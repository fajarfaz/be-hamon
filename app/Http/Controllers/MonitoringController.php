<?php

namespace App\Http\Controllers;

use App\Models\monitoring;
use Illuminate\Http\Request;

class MonitoringController extends Controller
{
    
    public function create(Request $request)
    {
        $hardwares = $request->json()->all();

        foreach ($hardwares as $hardware) {

            if ($hardware['name'] != 'Categories') {

                $price = str_replace(['Rp ','.'],'', $hardware['price']);
                $result = monitoring::create([
                    'hardware_id' => str_replace(' ','', $hardware['name']),
                    'name' => $hardware['name'],
                    'price' => $price,
                    'source' => $hardware['source'],
                    'link' => $hardware['link'],
                    
                ]);
            }

            // print_r($result);
        }

    }
}
