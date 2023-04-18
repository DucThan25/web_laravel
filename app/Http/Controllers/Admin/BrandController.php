<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Brand\BrandFormRequest;
use App\Http\Services\Brand\BrandService;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    protected $brandService;
    public function  __construct(BrandService $brandService)
    {
        $this ->brandService = $brandService;
    }

    public function create(){
        return view('admin.brand.add',[
            'title' => 'Thêm thương hiệu mới',
            'brands' => $this->brandService->getAll(),
        ]);
    }   

    public function store(BrandFormRequest $request){
        $this->brandService->create($request);

        return redirect()->back();
    } 
    
    public function index(){
        return view('admin.brand.list',[
            'title' => 'Danh Sách Thương Hiệu',
            'brands' => $this->brandService->getAll(),
        ]);
    }

    public function show(Brand $brand)
    {
        return view('admin.brand.edit', [
            'title' => 'Chỉnh Sửa Danh Mục: ' . $brand->name,
            'brand' => $brand,
            'brands' => $this->brandService->getAll()
        ]);
    }

    public function update(Brand $brand, BrandFormRequest $request)
    {
        $this->brandService->update($request, $brand);

        return redirect('/admin/brands/list');
    }
}
