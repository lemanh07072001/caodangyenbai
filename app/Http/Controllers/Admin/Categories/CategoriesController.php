<?php

namespace App\Http\Controllers\Admin\Categories;

use App\Helper\getDataBase;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Categories\CategoriesRequest;
use App\Service\Categories\ServiceCategorises;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    protected $table;
    public function __construct(ServiceCategorises $serviceCategorises)
    {
        $this->table = $serviceCategorises;
    }

    public function index()
    {
        return view('admin.Page.categories.index');
    }

    public function getData(Request $request){
        return $this->table->getData($request);
    }

    public function create()
    {
        $getCategories = getDataBase::getCategories();
        return view('admin.Page.categories.create',compact('getCategories'));
    }

    public function store(CategoriesRequest $categoriesRequest){
        return $this->table->store($categoriesRequest);
    }

    public function changeCategories(Request $request,$id){
        return $this->table->changeCategories($request,$id);
    }

    public function changeStatus(Request $request , $id){
        return $this->table->changeStatus($request,$id);
    }

    public function editTile(Request $request ){
        return $this->table->editTile($request);
    }

    public function edit($id){
        $getCategories = getDataBase::getCategories();
        $getFind = $this->table->getFind($id);

        return view('admin.Page.categories.edit',compact('getCategories','getFind'));
    }

    public function update(CategoriesRequest $request , $id){
        return $this->table->update($request,$id);
    }

    public function destroy($id){
        return $this->table->destroy($id);
    }
}
