<div class="table-responsive">
    <table class="table color-table primary-table">
        <thead>
            <tr>
                <th>Câu hỏi</th>
                <th>Câu trả lời</th>
                <th>Tổng số</th>
                <th>Tỷ lệ</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $key => $value)
                @foreach ($value as $key_val => $value_val)
                    <tr>
                    @if($key_val == 0)<td rowspan="{{count($value)}}">{{$key}}</td>@endif
                        <td>{{$value_val['label']}}</td>
                        <td>{{$value_val['total']}}</td>
                        <td>{{$value_val['ratio']}}%</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</div>