<?php

namespace App\Http\Controllers\Admin\Slide;

use App\Helper\getDataBase;
use Illuminate\Http\Request;
use App\Service\Slide\ServiceSlide;
use App\Http\Controllers\Controller;

class SlideController extends Controller
{
    protected $table;
    public function __construct(ServiceSlide $serviceSlide)
    {
        $this->table = $serviceSlide;
    }

    public function index()
    {
        $getUser = getDataBase::getUser();
        return view('admin.Page.slide.index', compact('getUser'));
    }

    public function getData(Request $request)
    {
        return $this->table->getData($request);
    }

    public function create()
    {
        $getCategories = getDataBase::getCategories();
        return view('admin.Page.banners.create', compact('getCategories'));
    }

    public function store(Request $request)
    {
        return $this->table->store($request);
    }

    public function changeStatus(Request $request, $id)
    {
        return $this->table->changeStatus($request, $id);
    }

    public function edit($id)
    {
        $getFind = $this->table->getFind($id);
        $getCategories = getDataBase::getCategories();
        return view('admin.Page.banners.edit', compact('getFind', 'getCategories'));
    }

    public function update(Request $request, $id)
    {
        return $this->table->update($request, $id);
    }

    public function destroy($id)
    {
        return $this->table->destroy($id);
    }
}
