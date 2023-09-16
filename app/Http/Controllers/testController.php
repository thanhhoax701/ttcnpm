<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HopDong;

class testController extends Controller
{
    public function test()
    {
        $hd = HopDong::where('HD_MaHD', 'HD1')->first();
        dd($hd->tram);
        // if ($user) {
        //     foreach($user->quyennguoidungs as $a){
        //         echo "<pre>";
        //         print_r($a->quyen);
        //         echo "</pre>";

        //     }
        // } else {
        //     dd('User not found');
        // }
        echo 'Không làm mà đòi có ăn';
    }
}
