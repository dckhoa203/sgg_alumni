<style>

tbody div{
    overflow: auto!important;
  }
  table{
    height: 1080px;
  }
  .table-responsive.scrollxy {
    height: 720px!important;
    width: 100%;
    overflow-x: scroll;
    overflow-y: scroll;
  }

  </style>
<h1 style="    color: #2570BB;
font-family: 'Roboto Condensed', Arial, sans-serif;
text-transform: uppercase;">{{ $survey['survey_name'] }}</h1>
<h4 style="white-space: pre-wrap;
    line-height: 135%;
    margin-top: 22px;
    font-size: 16px;">{{ $survey['survey_description'] }}</h4>
@csrf
<div class="table-responsive scrollxy">
  
  
  <table class=" table color-table primary-table table-hover" >
    <thead class="thead-dark">
      <tr>
          <th scope="col">User</th>
          <th scope="col">Code</th>
          <th scope="col">Date Create</th>
          @if(is_array($survey['questions']))
            @foreach ($survey['questions'] as $key => $value)
              <th scope="col" >{{ $value['question_title'] }}</th>
            @endforeach
          @endif
      </tr>
    </thead>
      <tbody>
      
        @forelse ($survey['answers'] as $key => $value)
        <tr >
          {{-- hiện thông tin người trả lời --}}
              <td>{{$survey['users'][$key]['name']}}</td>
              <td>{{$survey['users'][$key]['code']}}</td>
              <td>{{$value['created_at']}}</td>
          {{-- lấy dữ liệu --}}
          <?php $content=json_decode($value['answer_content'],true); ?>
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
            No answers provided by you for this Survey
          </td>
          <td></td>
        </tr>
        
      @endforelse
      
    </tr>
    </tbody>
  </table>
</div>


