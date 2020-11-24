<div class="modal-dialog" role="document">
    <div class="modal-content text-center">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">تعديل المنتج</h5>
        </div>
        <form class="edit-form" action="{{route('admin.products.edit',$product->slug)}}" method="post" enctype="multipart/form-data">
            <div class="modal-body">
                <div class="alert alert-success hidden SuccessMessage" ></div>
                <div class="alert alert-danger hidden ErrorMessage" ></div>
                @csrf
                <div class="col-md-6">
                    <div class="form-group">
                        <label>الاسم</label>
                        <input class="form-control" type="text" name="name" value="{{$product->name}}">
                    </div>
                    <div class="form-group">
                        <label>طريقه التقطيع</label>
                        <select class="form-control" name="cutting[]" multiple="">
                            <option value="ثلاجة" @if(in_array("ثلاجة", $product->cutting)){{'selected'}}@endif>ثلاجة </option>
                            <option value=" غوزي (كامل)" @if(in_array("غوزي (كامل)", $product->cutting)){{'selected'}}@endif> غوزي (كامل) </option>
                            <option value="انصاف" @if(in_array("انصاف", $product->cutting)){{'selected'}}@endif>انصاف </option>
                            <option value="ارباع (4 قطع)" @if(in_array("ارباع (4 قطع)", $product->cutting)){{'selected'}}@endif> ارباع (4 قطع) </option>
                            <option value="تقطيع كبير (8 قطع)" @if(in_array("تقطيع كبير (8 قطع)", $product->cutting)){{'selected'}}@endif> تقطيع كبير (8 قطع)</option>
                            <option value="تقطيع صغير (12 قطعة)" @if(in_array("تقطيع صغير (12 قطعة)", $product->cutting)){{'selected'}}@endif> تقطيع صغير (12 قطعة) </option>
                            <option value="مفطح" @if(in_array("مفطح", $product->cutting)){{'selected'}}@endif>مفطح </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>اظهار</label>
                        <select class="form-control" name="active">
                            <option value="1" @if($product->active == 1){{'selected'}}@endif>نعم</option>
                            <option value="0" @if($product->active == 0){{'selected'}}@endif>لا</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label>الترتيب</label>
                    <input class="form-control" type="number" name="order" value="{{$product->order}}">
                </div>
                <div class="col-md-6">
                    <div class="img-block">
                        <img src="{{Storage::url($product->image)}}" class="img-responsive btn-product-image" style="cursor: pointer;">
                        <input type="file" name="image" style="display: none;">
                    </div>
                </div>


                <div class="spacer-15"></div>
                <div class="col-sm-12 save-btn">
                    <button class="custom-btn green-bc" type="submit">حفظ</button>
                </div>
        </form>
    </div>
</div>