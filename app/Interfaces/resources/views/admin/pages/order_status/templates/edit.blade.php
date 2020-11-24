<div class="modal-dialog" role="document">
    <div class="modal-content text-center">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">تعديل الحالة</h5>
        </div>
        <form class="edit-form" action="{{route('admin.order_status.edit',$orderStatus->id)}}" method="post" enctype="multipart/form-data">
            <div class="modal-body">
                <div class="alert alert-success hidden SuccessMessage" ></div>
                <div class="alert alert-danger hidden ErrorMessage" ></div>
                @csrf
                <div class="col-md-6">
                    <div class="form-group">
                        <label>الاسم</label>
                        <input class="form-control" type="text" name="name" value="{{$orderStatus->name}}">
                    </div>
                </div>
                   <div class="spacer-15"></div>
                <div class="col-sm-12 save-btn">
                    <button class="custom-btn green-bc" type="submit">حفظ</button>
                </div>
        </form>
    </div>
</div>
