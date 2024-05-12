<?php

namespace App\Http\Controllers;

use App\Models\Galery;
use App\Models\TreeDModel;
use App\Models\VidioYoutube;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function overview(){
        return view('overview.index');
    }
    public function video(){
        $data['getVideo'] = VidioYoutube::where('status_posision','Video Page')->first();
        return view('overview.video',$data);
    }
    public function treedExplore(){
        $data['getThreeD'] = TreeDModel::where('status_posision','3D Explore Page')->first();
        return view('overview.3d',$data);
    }
    public function resources(){
        return view('overview.resources');
    }
    public function vr(){
        return view('overview.vr');
    }
    public function exhibit(){
        return view('overview.exhibit');
    }
    public function galery(){
        $data['galery'] = DB::table('galeries')->orderBy('id', 'desc')->paginate(2);
        return view('overview.galery',$data);
    }
}
