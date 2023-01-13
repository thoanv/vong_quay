<div class="px-3 py-2">
    <div class="form-group row">
        <div class="col-lg-12">
            <div class="form-group mb-3">
                <label>Tên phòng ban</label>
                <input type="text" class="form-control form-control-lg" name="name" placeholder="Nhập tên phòng ban..." value="{{old('name', $attendance['name'])}}">
                @if ($errors->has('name'))
                    <div class="mt-1 notification-error">
                        {{$errors->first('name')}}
                    </div>
                @endif
            </div>
            <div class="form-group mb-3">
                <label>Số điện thoại</label>
                <input type="text" class="form-control form-control-lg" name="phone" placeholder="Nhập số điện thoại..." value="{{old('phone', $attendance['phone'])}}">
                @if ($errors->has('phone'))
                    <div class="mt-1 notification-error">
                        {{$errors->first('phone')}}
                    </div>
                @endif
            </div>
            <div class="form-group mb-3">
                <label>Phòng ban</label>
                <select class="form-control js-example-basic-single" name="department_id">
                    <option value="" style="color: #d2d6da">Chọn</option>
                    @foreach($departments as $item)
                        <option  {{ old('department_id', $attendance['department_id']) == $item['id'] ? 'selected' : '' }} value="{{$item['id']}}">{{$item['name']}}</option>
                    @endforeach
                </select>
                @if ($errors->has('department_id'))
                    <div class="mt-1 notification-error">
                        {{$errors->first('department_id')}}
                    </div>
                @endif
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group mb-3">
                <label>Ẩn / Hiện thị</label>
                <div class="form-check form-switch d-flex align-items-center mb-3">
                    <input class="form-check-input" name="status" type="checkbox" id="rememberMe" {{ $attendance['status'] ? 'checked="checked"' : '' }}>
                </div>
            </div>
        </div>
        <hr class="dark horizontal">
        <div class="col-lg-12 text-center">
            <button type="submit" class="btn btn-primary btn-sm">Lưu</button>
            <a href="{{route('attendances.index')}}" class="btn btn-danger btn-sm">Trở lại</a>
        </div>
    </div>
</div>
