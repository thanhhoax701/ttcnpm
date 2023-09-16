<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DonVi;
use App\Models\HopDong;
use App\Models\NguoiDungDonVi;
use App\Models\QuyenNguoiDung;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Http\Controllers\redirect;
use App\Models\Quyen;
use Auth;
use Storage;

class TaiKhoanController extends Controller
{
    public function index()
    {
        $role = null;
        $id = Auth::user()->id;
        if (!empty(Auth::user())) {
            $role = Auth::user()->quyennguoidungs()->first()->quyen()->first();
        }
        $title = 'Tài Khoản';
        $breadcrumbs = [
            [
                'name' => 'Tài khoản',
                'link' => './taikhoan'
            ]
        ];
        $taikhoans = User::paginate(5);

        return view('taikhoan/taikhoan', compact('title', 'taikhoans', 'breadcrumbs', 'role','id'));
    }

    public function them()
    {
        $title = 'Tài Khoản';
        $breadcrumbs = [
            [
                'name' => 'Tài khoản',
                'link' => './'
            ], [
                'name' => 'Thêm',
                'link' => './them'
            ]
        ];
        $quyens = Quyen::get();
        $donvis = DonVi::get();

        return view('taikhoan/them', compact('title', 'breadcrumbs', 'quyens', 'donvis'));
    }

    public function hienthi(Request $request)
    {
        $title = 'Tài Khoản';
        $breadcrumbs = [
            [
                'name' => 'Tài khoản',
                'link' => '../'
            ], [
                'name' => 'Chi tiết',
                'link' => './' . $request->id
            ]
        ];
        $hienthitaikhoan = User::where('id', $request->id)->get();

        return view('taikhoan/hienthi', compact('title', 'hienthitaikhoan', 'breadcrumbs'));
    }

    public function chinhsua(Request $request)
    {
        $title = 'Tài Khoản';
        $breadcrumbs = [
            [
                'name' => 'Tài khoản',
                'link' => '../'
            ], [
                'name' => 'Sửa',
                'link' => './' . $request->id
            ]
        ];
        $sua = User::where('id', $request->id)->first();
        $avatar = asset($sua->avatar);
        if ($request->isMethod('post')) {
            $sua->ND_MaND = $request->ND_MaND;
            // $sua->avatar = $request->avatar;
            if ($file = $request->file('avatar')) {

                // $path = $file->store('public/avatar');
                $filename = $file->getClientOriginalName();

                // Move the file to the public directory
                $file->move(public_path('avatar'), $filename);

                // Get the public URL of the file
                $publicUrl = asset('avatar/' . $filename);
                $sua->avatar = 'avatar/' . $filename;
            }
            $sua->name = $request->name;
            $sua->ND_GioiTinh = $request->ND_GioiTinh;
            $sua->ND_DiaChi = $request->ND_DiaChi;
            $sua->email = $request->email;
            $sua->ND_SDT = $request->ND_SDT;
            $sua->save();
            return redirect()->route('taikhoan')->with('success', 'sửa thành công');
        }
        return view('taikhoan/chinhsua', compact('title', 'sua', 'breadcrumbs', 'avatar'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ND_MaND' => 'required|unique:users',
            'email' => 'required|unique:users',
            'ND_SDT' => 'required|unique:users',
        ]);
        if ($validator->fails()) {
            return redirect()->route('taikhoan')
                ->withErrors($validator);
        }
        // dd($request->file('avatar'));
        $addtaikhoan = new User();
        $addtaikhoan->ND_MaND = $request->input('ND_MaND');
        $addtaikhoan->name = $request->input('name');
        $addtaikhoan->ND_GioiTinh = ($request->input('gioiTinh') == 1) ? 'Nam' : 'Nu';
        $addtaikhoan->ND_DiaChi = $request->input('diaChi');
        $addtaikhoan->email = $request->input('email');
        $addtaikhoan->password = $request->input('password');

        if ($file = $request->file('avatar')) {
            // $path = $file->store('public/avatar');
            $filename = $file->getClientOriginalName();

            // Move the file to the public directory
            $file->move(public_path('avatar'), $filename);

            // Get the public URL of the file
            $publicUrl = asset('avatar/' . $filename);
            $addtaikhoan->avatar = 'avatar/' . $filename;
        }
        $addtaikhoan->ND_SDT = $request->input('ND_SDT');
        $addtaikhoan->save();

        $addquyennguoidung = new QuyenNguoiDung();
        $addquyennguoidung->Q_MaQ = $request->input('Ma_Q');
        $addquyennguoidung->ND_MaND = User::where('ND_MaND', $request->input('ND_MaND'))->first()->id;
        $addquyennguoidung->save();

        $addnguoidungdonvi = new NguoiDungDonVi();
        $addnguoidungdonvi->DV_MaDV = $request->input('Ma_DV');
        $addnguoidungdonvi->ND_MaND = User::where('ND_MaND', $request->input('ND_MaND'))->first()->id;
        $addnguoidungdonvi->save();
        return redirect()->route('taikhoan')->with('success', 'Thêm thành công');
    }

    public function xoa(Request $request)
    {
        $user = User::find($request->id);
        $quyennguoidungs = QuyenNguoiDung::where('ND_MaND', $user->id)->get();
        // dd($quyennguoidungs);
        if (!empty($quyennguoidungs)) {
            foreach ($quyennguoidungs as $quyennguoidung) {
                $quyennguoidung->delete();
            }
        }

        $nguoidungdonvis = NguoiDungDonVi::where('ND_MaND', $user->id)->get();
        if (!empty($nguoidungdonvis)) {
            foreach ($nguoidungdonvis as $nguoidungdonvi) {
                $nguoidungdonvi->delete();
            }
        }

        $hopdongs = HopDong::where('ND_MaND', $user->id)->get();
        if (!empty($hopdongs)) {
            foreach ($hopdongs as $hopdong) {
                $dongias = $hopdong->dongias;
                foreach ($dongias as $dongia) {
                    $dongia->whereNotNull('DG_MaDG')->delete();
                }
                $files = $hopdong->filehopdongs;
                foreach ($files as $file) {
                    $file->whereNotNull('F_MaFile')->delete();
                }
                // dd($dongias);
                $hopdong->whereNotNull('HD_MaHD')->delete();
            }
        }
        $user->delete();
        return redirect()->route('taikhoan')->with('success', 'Xóa thành công');
    }
}
