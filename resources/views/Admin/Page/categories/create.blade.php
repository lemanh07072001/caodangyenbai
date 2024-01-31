{{--  Layout  --}}
@extends('Admin.LayoutAdmin.layout')

{{--  Title  --}}
@section('title','Thêm - Sửa danh mục')

{{--  Breadcrumbs  --}}
@section('breadcrumbs')
    {{ Breadcrumbs::render('CategoriesCreate') }}
@endsection

{{--  Content  --}}
@section('content')
    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <form method="post" action="{{route('categories.store')}}">
                    @csrf
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Thêm danh mục</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="inputName">Tên danh mục <span class="text-danger">(*)</span></label>
                                <input type="text" id="inputName" name="title" value="{{old('title')}}"
                                       class="form-control @error('title')is-invalid @enderror" placeholder="Nhập tên danh mục...">

                                @error('title')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label for="inputStatus">Danh mục <span class="text-danger">(*)</span></label>
                                <select id="inputStatus" name="parent_id" class="form-control custom-select @error('parent_id')is-invalid @enderror">
                                    <option value="">Danh mục cha</option>
                                    @if(!empty($getCategories))
                                        {{showCategoriesSelect($getCategories,old('parent_id'))}}
                                    @endif
                                </select>

                                @error('parent_id')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="inputStatus">Vị trí <span class="text-danger">(*)</span></label>
                                <select id="inputStatus" name="type" class="form-control custom-select @error('type')is-invalid @enderror">
                                    <option value="" {{old('type')==null?'selected':''}}>Chọn vị trí</option>
                                    <option value="0"{{old('type')==0?'selected':''}}>Danh mục top</option>
                                    <option value="1"{{old('type')==1?'selected':''}}>Danh mục chính</option>
                                </select>

                                @error('type')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" name="status" id="btnStatus" class="custom-control-input" {{old('status')=='on'?'checked':''}}>
                                    <label class="custom-control-label" for="btnStatus"><span id="status">Không kích hoạt</span></label>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-12 float-right">
                                    <a href="{{url()->previous()}}" class="btn btn-secondary">Cancel</a>
                                    <button class="btn btn-success ">Xác nhận</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>

        </div>


    </section>
@endsection
