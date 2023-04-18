<?php

namespace App\Http\Services\Brand;

use App\Models\Brand;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class BrandService   
{
    public function getAll()
    {
        return Brand::orderbyDesc('id')->paginate(20);
    }

    public function create($request)
    {
        try {
            Brand::create([
                'name' => (string)$request->input('name'),
                'description' => (string)$request->input('description'),
                'content' => (string)$request->input('content'),
                'active' => (string)$request->input('active')
            ]);

            Session::flash('success', 'Tạo Thương Hiệu Thành Công');
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }

        return true;
    }  
    
    public function update($request, $menu): bool
    {

        $menu->name = (string)$request->input('name');
        $menu->description = (string)$request->input('description');
        $menu->content = (string)$request->input('content');
        $menu->active = (string)$request->input('active');
        $menu->save();

        Session::flash('success', 'Cập nhật thành công thương hiệu');
        return true;
    }

    
}
