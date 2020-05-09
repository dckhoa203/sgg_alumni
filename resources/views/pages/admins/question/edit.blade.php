@extends('layouts.admin')
@section('content')
<style>
input{
  padding-top: none;
    border-color: #e8e8e8!important;
    border-top: none;
    border-right: none;
    border-left: none;
    margin: 10px;
}
input#question_title {
    width: 700px;
}
</style>
<link href="{{asset('bootstrap-toggle.min.css')}}" rel="stylesheet">
<div class="white-box">
<form method="POST" action="{{route('question.update',$question->question_id)}}">
  @csrf
  
  <h2 class="flow-text">Edit Question Title</h2>

    @if($question->question_type === 'Text')
        <div class="input-field col s12">
        <label for="question_title">Question</label> <br><br>
        <input type="Text" name="question_title" id="question_title" value="{{ $question->question_title }}" style="width: 700px;">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Bắt buộc trả lời
        <input type="checkbox" data-toggle="toggle" data-onstyle="info" id='question_mandatory' name='question_mandatory'
        @if( $question->question_mandatory == 1) checked  @endif >

      @elseif($question->question_type === 'Textarea')
        <div class="input-field col s12">
          <label for="question_title">Question</label> <br><br>
          <textarea id="question_title" name="question_title" class="materialize-textarea" value="{{$question->question_title}}" style="width: 700px;"></textarea>
          <label for="Textarea">Textarea</label>
          <label for="question_mandatory">Bắt buộc trả lời</label>
        <input type="checkbox" data-toggle="toggle" data-onstyle="info" id='question_mandatory' name='question_mandatory' 
        @if( $question->question_mandatory == 1) checked  @endif >
        </div>

      @elseif($question->question_type === 'Radio')
        <label for="question_title">Question</label> 
        <input type="text" name="question_title" id="question_title" value="{{ $question->question_title }}">
        <label for="question_mandatory">Bắt buộc trả lời</label>
        <input type="checkbox" data-toggle="toggle" data-onstyle="info" id='question_mandatory' name='question_mandatory' 
        @if( $question->question_mandatory == 1) checked  value='1' @endif ><br>
        {{-- decode --}}
        <?php $option=json_decode($question->question_option,true); ?>
        @foreach ($option as $item=>$value)
          @if(is_array($value))
            @foreach ($value as $item1=>$value1)
            <label><input type="radio"></label><label> <input name="option[]" type="Text" id="{{ $item1 }}" value="{{ $value1 }}" style="width: 700px;"/> 
              <a style="margin-left:50px; color:red; cursor:pointer;"class="delete-option" 
              href="{{route('question.delete',['question_id'=>$question_id,'item1'=>$item1])}}">Xóa</a>
            </label><br>
            @endforeach
          @endif
        @endforeach
          
        <div class="form-g" id="form-g"></div>
        <p class="add-option" style="cursor:pointer; color:green; margin-top:5px">Thêm phương án trả lời</p>

      @elseif($question->question_type === 'Checkbox')
        <label for="question_title">Question</label><br>
        <input type="text" name="question_title" id="question_title" value="{{ $question->question_title }}">
        <label for="question_mandatory">Bắt buộc trả lời</label>
        <input type="checkbox" data-toggle="toggle" data-onstyle="info" id='question_mandatory' name='question_mandatory' 
        @if( $question->question_mandatory == 1) checked  @endif ><br>
        
        {{-- decode --}}
        <?php $option=json_decode($question->question_option,true);?>
        @foreach ($option as $item=>$value)
          @if(is_array($value))
            @foreach ($value as $item1=>$value1)
            <label><input type="checkbox"></label><label> <input name="option[]" type="Text" id="{{ $item1 }}" value="{{ $value1 }}" style="width: 700px;"/> 
            <a style="margin-left:50px; color:red; cursor:pointer;"class="delete-option" 
            href="{{route('question.delete',['question_id'=>$question_id,'item1'=>$item1])}}">Xóa</a>
          </label>
              <br>
            @endforeach
          @endif
        @endforeach

          <div class="form-g" id="form-g"></div>
          <div class="add-option" style="cursor:pointer; color:green; margin-top:5px; width:700px;" onclick="scroll()">Thêm phương án trả lời</div>
          @endif 
    
        {{-- </div>        --}}
    <div class="input-field col s12">
    <button class="btn waves-effect waves-light">Cập nhật</button>
    <a href="{{route('survey.detail',$question->surveys['survey_id'])}}" class="btn btn-default">Trở lại</a>
    </div>
 

</form>
</div>
@endsection
<script src="{{ URL::asset('jquery-3.4.1.min.js') }}"></script>
{{-- <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script> --}}
<script src="{{asset('bootstrap-toggle.min.js') }}"></script>

<script >
    // for adding new option
$(document).on('click', '.add-option', function() {
    $(".form-g").append(material);
  });

  // will replace .form-g class when referenced
  var material = '<div class="input-field col input-g s12"><br>' +
    '<input name="option[]"  type="text" placeholder="Nhập phương án trả lời" style="width:700px" >' +
    '<span style="margin-left:50px; color:red; cursor:pointer;"class="delete-option">Delete</span><br>' +

    // '<label for="question_option">Options</label><br>' +
  
    '</div>';
    $(document).on('click', '.delete-option', function() {
    $(this).parent(".input-field").remove();
    });
    $('form-g').scrollspy({target: ".submit"})

</script>