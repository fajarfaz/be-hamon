<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hardware;
use Carbon\Carbon;

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

    public function trend()
    {
        $trends = Hardware::with('monitoring')->get();
        $response = collect([]);
        foreach ($trends as $trend) {
            $price = 0;
            // return $trend->monitoring[0]->price;
            foreach ($trend->monitoring as $m) {
                $price += $m->price;
            }
            if ($trend->monitoring->count() > 0) {
                $firstPrice = $trend->monitoring[0]->price;
                $newPrice = $trend->monitoring[$trend->monitoring->count() - 1]->price;
                $last_update = Carbon::createFromTimeStamp(strtotime($trend->monitoring[$trend->monitoring->count() - 1]->created_at))->diffForHumans();
                $percentage = ($price / $firstPrice) / $trend->monitoring->count() - 1;
                if ($percentage != 0) {
                    $response->push([
                        'percentage' => round($percentage * 100,3),
                        'old_price' => $firstPrice,
                        'new_price' => $newPrice,
                        'range' => $newPrice-$firstPrice,
                        'info' => $trend->withoutRelations(),
                        'last_update' => $last_update
                    ]);
                }
            } 
            // else {
            //     $response->push([
            //         'percentage' => 'nodata',
            //         'last_price' => 'nodata',
            //         'info' => $trend->withoutRelations()
            //     ]);
            // }
        }

        // $response = monitoring::with('hardware')->where(['hardware_id' => $id])->get();
        return response()->json($response);
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
                        'link' => $hardware['link'],
                        'image' => $hardware['image'],
                        'desc' => html_entity_decode($hardware['desc']),
                        'category' => $hardware['category'],
                    ]
                );
                print($result);
            }
        }
    }
    
}
