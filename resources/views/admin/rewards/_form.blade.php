<div class="px-3 py-2">
    <div class="form-group row">
        <div class="col-lg-12">
            <div class="form-group mb-3">
                <label>Tên giải thường</label>
                <input type="text" class="form-control form-control-lg" name="name" placeholder="eg. Giải nhất, giải nhì, giải khuyến khích,.." value="{{old('name', $reward['name'])}}">
                @if ($errors->has('name'))
                    <div class="mt-1 notification-error">
                        {{$errors->first('name')}}
                    </div>
                @endif
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group mb-3">
                <label>Giá trị giả thưởng</label>
                <input type="text" class="form-control form-control-lg" name="value" placeholder="1 triệu đồng, 5 trăm nghìn đồng, ..." value="{{old('value', $reward['value'])}}">
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group mb-3">
                <label>Ghi chú</label>
                <textarea name="note" class="form-control">{!! old('note', $reward['note']) !!}</textarea>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group mb-3">
                <label>Ẩn / Hiện thị</label>
                <div class="form-check form-switch d-flex align-items-center mb-3">
                    <input class="form-check-input" name="status" type="checkbox" id="rememberMe" {{ $reward['status'] ? 'checked="checked"' : '' }}>
                </div>
            </div>
        </div>
        <hr class="dark horizontal">
        <div class="col-lg-12 text-center">
            <button type="submit" class="btn btn-primary btn-sm">Lưu</button>
            <a href="{{route('rewards.index')}}" class="btn btn-danger btn-sm">Trở lại</a>
        </div>
    </div>
</div>
