<?php

namespace App\Http\Controllers\Admin\Post;

use App\Helper\getDataBase;
use Illuminate\Http\Request;
use App\Service\Post\ServicePost;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Post\PostRequest;

class PostController extends Controller
{
    protected $table;
    public function __construct(ServicePost $servicePost)
    {
        $this->table = $servicePost;
    }

    public function index()
    {
        $getUser = getDataBase::getUser();
        $getCategories = getDataBase::getCategories();

        return view('admin.Page.post.index', compact('getUser', 'getCategories'));
    }

    public function getData(Request $request)
    {
        return $this->table->getData($request);
    }

    public function create()
    {
        $getOrderBanner = getDataBase::getOrderBanner();
        $getCategories = getDataBase::getCategories();
        return view('admin.Page.post.create', compact('getCategories', 'getOrderBanner'));
    }

    public function store(PostRequest $request)
    {
        return $this->table->store($request);
    }

    public function changeCategories(Request $request, $id)
    {
        return $this->table->changeCategories($request, $id);
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

        $getCategories = getDataBase::getCategories();
        $getOrderBanner = getDataBase::getOrderBanner();
        return view('admin.Page.post.edit', compact('getFind', 'getCategories', 'getOrderBanner', 'getFind'));
    }

    public function update(PostRequest $request, $id)
    {
        return $this->table->update($request, $id);
    }

    public function destroy($id)
    {
        return $this->table->destroy($id);
    }
}
