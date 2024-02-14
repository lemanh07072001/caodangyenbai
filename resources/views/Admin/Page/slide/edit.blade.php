{{--  Layout  --}}
@extends('Admin.LayoutAdmin.layout')

{{--  Title  --}}
@section('title','Sửa Slide')

{{--  Breadcrumbs  --}}
@section('breadcrumbs')
{{ Breadcrumbs::render('SlideEdit',$getFind) }}
@endsection

{{--  Content  --}}
@section('content')
<section class="content">
    <form method="post" action="{{route('slide.update',$getFind->id)}}">
        @csrf
        <div class="row">
            <div class="col-md-8">    
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Nội dung</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputName">Tên Slide <x-span-danger/></label>
                            <input type="text" id="inputName" name="title" value="{{old('title')??$getFind->title}}"
                                class="form-control @error('title')is-invalid @enderror" placeholder="Nhập tên slide...">

                            @error('title')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>


                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="inputStatus">Danh mục <x-span-danger/></label>
                                    <select id="inputStatus" name="categories_id" class="form-control custom-select @error('categories_id')is-invalid @enderror">
                                        <option value="">-- Chọn danh mục --</option>
                                        @if(!empty($getCategories))
                                            {{showCategoriesSelect($getCategories,old('categories_id')??$getFind->categories_id)}}
                                        @endif
                                    </select>
        
                                    @error('categories_id')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                          
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="inputOrder">Vị trí <x-span-danger/></label>
                                    <select id="inputOrder" name="order" class="form-control custom-select @error('order')is-invalid @enderror">
                                        <option value="">-- Chọn vị trí --</option>
                                        @foreach(showOrderSlideList() as $key=>$slide)
                                        <option value="{{$key}}"{{old('order')||$getFind->order==$key?'selected':''}} >{{$slide}}</option>
                                        @endforeach
                                    </select>
        
                                    @error('order')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputName">Link <x-span-danger/></label>
                            <input type="text" id="inputName" name="link" value="{{old('link')??$getFind->link}}"
                                class="form-control @error('link')is-invalid @enderror" placeholder="Đường dẫn...">

                            @error('link')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" name="status" id="btnStatus" class="custom-control-input" {{old('status')=='on'||$getFind->status==0?'checked':''}}>
                                <label class="custom-control-label" for="btnStatus"><span id="status">Không kích hoạt</span></label>
                            </div>
                        </div>

                        <div>
                            
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Hình ảnh</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        

                        <div class="form-group">
                            <label for="exampleInputFile">Hình ảnh <x-span-danger/></label>
                            <div class="row ckfind-group">
                                <div class="col-lg-8">
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="text" class="form-control image-render @error('thumbnail')is-invalid @enderror"
                                             value="{{old('thumbnail')??$getFind->thumbnail}}" name="thumbnail"  id="exampleInputFile" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <button type="button" class="btn btn-danger btn-block chooseFile">Chọn ảnh</button>
                                </div>
                            </div>
                            @error('thumbnail')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div id="previewImage">

                        </div>
                        
                        <div class="row mt-2">
                            <div class="col-12 float-right">
                                <a href="{{url()->previous()}}" class="btn btn-secondary">Cancel</a>
                                <button class="btn btn-success ">Xác nhận</button>
                            </div>
                        </div>

                        
                    </div>
                    
                </div>

               
               
            </div>

        </div>

    </form>

</section>
@endsection

@push('js')

@endpush