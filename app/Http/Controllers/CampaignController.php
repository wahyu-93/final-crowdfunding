<?php

namespace App\Http\Controllers;

use App\Campaign;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function random($count)
    {
        $campaigns = Campaign::select('*')
                ->inRandomOrder()
                ->limit($count)
                ->get();

        $data['campaigns'] = $campaigns;

        return response()->json([
            'response_code' => '00',
            'response_message'  => 'Data Campaigns Berhasil Ditampilkan',
            'data'  => $data
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description'   => 'required',
            'image' => 'required|mimes:jpg,jpeg,png'
        ]);

        $campaign = Campaign::create([
            'title'         => $request->title,
            'description'   => $request->description
        ]);

        if ($request->hasFile('image')){
            $image = $request->file('image');
            $image_extension = $image->getClientOriginalExtension();
            $image_name = $campaign->id . "." . $image_extension;
            $image_folder = '/photos/campaign/';
            $image_location = $image_folder . $image_name;

            try {
                $image->move(public_path($image_folder), $image_name);

                $campaign->update([
                    'image' => $image_location
                ]);
            } catch (\Exception $e){
                return response()->json([
                    'response_code' => '01',
                    'response_message'  => 'photo profile gagal diupload',
                    'data'  => $data
                ], 200);
            }
        }

        $data['campaign'] = $campaign;
        
        return response()->json([
            'response_code' => '00',
            'response_message'  => 'Data Campaign Berhasil Ditambahkan',
            'data'  => $data
        ], 200);
    }

    public function index()
    {
        $campaigns = Campaign::paginate(6);

        $data['campaigns'] = $campaigns;
        
        return response()->json([
            'response_code' => '00',
            'response_message'  => 'Data Campaign Berhasil Ditampilkan',
            'data'  => $data
        ], 200);
    }

    public function detail($id)
    {
        $campaigns = Campaign::find($id);
            
        $data['campaigns'] = $campaigns;

        return response()->json([
            'response_code' => '00',
            'response_message'  => 'data campaign berhasil ditampilkan',
            'data'  => $data,
        ], 200);
    }

    public function search($keyword)
    {
        $campaign = Campaign::select('*')
            ->where('title', 'LIKE', "%".$keyword."%")
            ->get();
            
        $data['campaign'] = $campaign;

        return response()->json([
            'response_code' => '00',
            'response_message'  => 'data campaign berhasil ditampilkan',
            'data'  => $data,
        ], 200);
    }
}
