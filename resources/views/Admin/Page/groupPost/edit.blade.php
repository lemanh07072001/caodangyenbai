{{--  Layout  --}}
@extends('Admin.LayoutAdmin.layout')

{{--  Title  --}}
@section('title','Thêm nhóm tin tức')

{{--  Breadcrumbs  --}}
@section('breadcrumbs')
{{ Breadcrumbs::render('groupPostEdit',$getFind->id) }}
@endsection

{{--  Content  --}}
@section('content')
<section class="content">
    <form method="post" action="{{route('groupPost.update',$getFind->id)}}">
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
                            <label for="inputName">Tên nhóm tin tức <x-span-danger/></label>
                            <input type="text" id="inputName" name="title" value="{{old('title')??$getFind->title}}"
                                class="form-control @error('title')is-invalid @enderror" placeholder="Nhập tên nhóm tin tức...">

                            @error('title')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Mô tả </label>
                            <textarea class="form-control  @error('description')is-invalid @enderror" 
                                name="description" rows="3" placeholder="">{{old('description')??$getFind->description}}</textarea>

                           
                          </div>


                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" name="status" id="btnStatus" class="custom-control-input" {{old('status')=='on'||$getFind->status==0?'checked':''}} >
                                <label class="custom-control-label" for="btnStatus"><span id="status">Không kích hoạt</span></label>
                            </div>
                            
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card card-warning">
                    <div class="card-header">
                        <h3 class="card-title">Cấu hình</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                       

                        <div class="form-group">
                            <label>Thứ tự sắp xếp ( Số bé hơn hiển thị trước) <x-span-danger/></label>
                            <select class="form-control" name="order">
                              @for($i=0;$i<=10;$i++)
                                <option value={{$i}} {{old('order')==$i||$getFind->order==$i?'selected':''}}>{{$i}}</option>
                              @endfor
                            </select>

                            @error('order')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
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