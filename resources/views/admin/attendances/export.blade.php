<html style="font-family: 'Times New Roman', sans-serif">
<head>
    <title>Danh sách chech In</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<h1 style="text-align: center">Danh sách check in</h1>
<p>&nbsp;</p>
<table class="table table-hover text-nowrap">
    <thead>
    <tr>
        <th>
            STT
        </th>
        <th>
            <b>Họ và tên</b>
        </th>
        <th>
            <b>Số điện thoại</b>
        </th>
        <th>
            <b>Mã số dự thưởng</b>
        </th>
        <th>
            <b>Phòng ban</b>
        </th>
        <th>
            <b>Thời gian đăng ký</b>
        </th>
        <th>
            <b>Trạng thái</b>
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach($attendances as $item)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$item->name}}</td>
            <td>{{$item->phone}}</td>
            <td>{{$item->code}}</td>
            <td>{{$item->department ? $item->department->name : ''}}</td>
            <td>{{date('H:i d/m/Y', strtotime($item->created_at))}}</td>
            <td>{{$item->status ? 'Hiển thị' : 'Ẩn'}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
