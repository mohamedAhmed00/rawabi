<div class="modal-dialog" role="document">
    <div class="modal-content text-center">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">تعديل الاسليدر</h5>
        </div>
        <form class="edit-form" action="{{route('admin.sliders.edit',$slider->id)}}" method="post" enctype="multipart/form-data">
            <div class="modal-body">
                <div class="alert alert-success hidden SuccessMessage" ></div>
                <div class="alert alert-danger hidden ErrorMessage" ></div>
                @csrf
                <div class="col-md-6">
                    <div class="form-group">
                        <label>الاسم</label>
                        <input class="form-control" type="text" name="name" value="{{$slider->name}}">
                    </div>
                    <div class="form-group">
                        <label>الترتيب</label>
                        <input class="form-control" type="text" name="order" value="{{$slider->order}}">
                    </div>
                    <div class="form-group">
                        <label>اظهار</label>
                        <select class="form-control" name="status">
                            <option value="1" @if($slider->status == 1){{'selected'}}@endif>نعم</option>
                            <option value="0" @if($slider->status == 0){{'selected'}}@endif>لا</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>الفيديو</label>
                        <input type="file" name="video">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="img-block">
                        <img src="{{Storage::url($slider->image)}}" class="img-responsive btn-product-image" style="cursor: pointer;">
                        <input type="file" name="image" style="display: none;">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="img-block">
                        <video style="width: 100%;height: 200px" controls>
                            <source src="{{Storage::url($slider->video)}}" type="video/webm">
                            <source src="{{Storage::url($slider->video)}}" type="video/mp4">
                        </video>
                    </div>
                </div>


                <div class="spacer-15"></div>
                <div class="col-sm-12 save-btn">
                    <button class="custom-btn green-bc" type="submit">حفظ</button>
                </div>
        </form>
    </div>
</div>
