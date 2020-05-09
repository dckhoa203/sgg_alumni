<p><b>Bảng thống kê câu trả lời</b></p>
<br>
<table class="table color-table primary-table">
    <thead>
        <tr>
            <th>Câu trả lời</th>
            <th>Tổng số</th>
            <th>Tỷ lệ</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $key => $value)
            <tr>
                <td>{{$value['label']}}</td>
                <td>{{$value['total']}}</td>
                <td>{{$value['ratio']}}%</td>
            </tr>
        @endforeach
    </tbody>
</table>