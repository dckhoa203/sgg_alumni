@extends('layouts.admin')
@section('content')
<link rel="stylesheet" href="{{asset('css\survey\show_answer.css')}}">
<div class="white-box">
<form action="{{ action('Master\SurveyController@export') }}" method="POST">
  @csrf
  {{-- <input type="hidden" name="data" value="{{$survey_json}}"> --}}

  {{-- <button type="submit" class="btn btn-success" style="float: right;">Export</button> --}}
</form>
<h1 >{{ $survey->survey_name }}</h1>
<h4 >{{ $survey->survey_description }}</h4>
@csrf
<div class="table-responsive scrollxy">
  

<table id="table_answer" class=" table display color-table info-table table-hover " >

    <thead class="thead-dark">
      <tr>
        <div style="position:relative">
          <th>Họ Tên</th>
          <th >Mã số</th>
          <th >Dấu thời gian</th>
          @foreach ($questions as $item)
            <th>
              <div style="font-size:9.6px;position: flexed;/* top: 9px; *//* bottom: 4px; */">
              {{$item->question_title}}
              </div>
            </th>
            <?php 
            
              // $arr=explode ( ' ' ,  $item->question_title);
              

              // if(count($arr)<=5){
              //   echo "<th>";
              //   // foreach($arr as $i=>$e){
              //   // echo $e." ";}
              //   echo $item->question_title."</th>";
              //     // echo "<abbr title='$item->question_title'>...</abbr></th>";
              // }
              // else{
              //   echo "<th>";
              //   // for($i=0;$i<=5;$i++){
              //     // echo $arr[$i].' ';
              //   // }
              //   echo $item->question_title."</th>";
              //   // echo "<abbr title='$item->question_title'> ...</abbr></th>";
              // }
            ?>
          
          @endforeach
        </div>
      </tr>
    </thead>
      <tbody>
      
        @forelse ($survey->answers as $answer)
        <tr >
          {{-- hiện thông tin người trả lời --}}
              <td>{{$answer->users['name']}}</td>
              <td>{{$answer->users['username']}}</td>
              <td >{{$answer->created_at}}</td>
          {{-- lấy dữ liệu --}}
          <?php $content=json_decode($answer->answer_content,true);?>
            @foreach ($content as $item=>$value)
            {{-- nếu là loại câu hỏi checkbox (nhiều đáp án--}}
              @if(count($value)>1)
              <td>
                @foreach ($value as $item1=>$value1)
                  {{$value1}}<br>
                @endforeach
              </td>
              {{-- nếu là các câu hỏi 1 đáp án --}}
              @else 
              @foreach ($value as $item1=>$value1)
                <td>{{$value1}}</td>
              @endforeach
              @endif
            @endforeach
            
          {{-- @endif --}}
          
          {{-- {{dd($contents)}} --}}
          

        {{-- @endforeach --}}
      @empty
        <tr>
          <td>
            Chưa có câu trả lời nào cho khảo sát này
          </td>
          <td></td>
        </tr>
        
      @endforelse
      
        </tr>
    </tbody>
  
  </table>
</div>
</div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>

$(document).ready(function () {
        $('#table_answer').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            }); 
    });
    </script>
    
@endsection

