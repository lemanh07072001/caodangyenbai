<?php

namespace App\Http\Controllers\Admin\GroupPost;

use App\Helper\getDataBase;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\groupPost\groupPostRequest;
use App\Service\GroupPost\ServiceGroupPost;

class GroupPostController extends Controller
{
    protected $table;
    public function __construct(ServiceGroupPost $serviceGroupPost)
    {
        $this->table = $serviceGroupPost;
    }

    public function index()
    {
        $getUser = getDataBase::getUser();
        $getCategories = getDataBase::getCategories();

        return view('admin.Page.groupPost.index', compact('getUser', 'getCategories'));
    }

    public function getData(Request $request)
    {
        return $this->table->getData($request);
    }

    public function create()
    {
        $getOrderBanner = getDataBase::getOrderBanner();
        $getCategories = getDataBase::getCategories();
        return view('admin.Page.groupPost.create', compact('getCategories', 'getOrderBanner'));
    }

    public function store(groupPostRequest $request)
    {
        return $this->table->store($request);
    }

    public function updateTitle(Request $request, $id)
    {
        return $this->table->updateTitle($request, $id);
    }

    public function changeStatus(Request $request, $id)
    {
        return $this->table->changeStatus($request, $id);
    }

    public function getTitle($id)
    {
        return $this->table->getTitle($id);
    }

    public function edit($id)
    {
        $getFind = $this->table->getFind($id);

        return view('admin.Page.groupPost.edit', compact('getFind'));
    }

    public function update(groupPostRequest $request, $id)
    {
        return $this->table->update($request, $id);
    }

    public function destroy($id)
    {
        return $this->table->destroy($id);
    }

    public function listPost(Request $request, $id)
    {
        $countPost = $this->table->getCountPostList($request);
        $getFind = $this->table->getFind($id);
        return view('admin.Page.groupPost.listPost', compact('getFind', 'countPost'));
    }

    public function listPostData(Request $request)
    {
        return $this->table->listPostData($request);
    }

    public function addListPostData(Request $request)
    {
        return $this->table->addListPostData($request);
    }

    public function getListPost(Request $request, $id)
    {
        return $this->table->getListPost($request, $id);
    }

    public function destroyListPost(Request $request, $id)
    {
        return $this->table->destroyListPost($request, $id);
    }

    public function getCountPostList(Request $request)
    {
        return $this->table->getCountPostList($request);
    }
}
