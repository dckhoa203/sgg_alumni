@extends('layouts.admin')
@section('content')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$( function() {
    var availableTags = [
        "ruskhanh9@gmail.com",
        "huukhanhadobe@gmail.com",
        "khanhb1605219@student.ctu.edu.vn",
        "admin@gmail.com",
        "anB1203877@student.ctu.edu.vn",
        "chonB1203878@student.ctu.edu.vn",
        "hienB1201378@student.ctu.edu.vn",
        "huongB1302736@student.ctu.edu.vn",
        "ngocB1201312@student.ctu.edu.vn",
        "triB1302092@student.ctu.edu.vn",
        "vienB1200339@student.ctu.edu.vn",
    ];
    function split( val ) {
        return val.split( /,\s*/ );
    }
    function extractLast( term ) {
        return split( term ).pop();
    }

    $( "#multiple_emails")
        // don't navigate away from the field on tab when selecting an item
        .on( "keydown", function( event ) {
            if ( event.keyCode === $.ui.keyCode.TAB &&
                    $( this ).autocomplete( "instance" ).menu.active ) {
                event.preventDefault();
            }
        })
        .autocomplete({
            minLength: 0,
            source: function( request, response ) {
                // delegate back to autocomplete, but extract the last term
                response( $.ui.autocomplete.filter(
                    availableTags, extractLast( request.term ) ) );
            },
            focus: function() {
                // prevent value inserted on focus
                return false;
            },
            select: function( event, ui ) {
                var terms = split( this.value );
                // remove the current input
                terms.pop();
                // add the selected item
                terms.push( ui.item.value );
                // add placeholder to get the comma-and-space at the end
                terms.push( "" );
                this.value = terms.join( ", " );
                return false;
            }
        });
        $( "#email")
        // don't navigate away from the field on tab when selecting an item
        .on( "keydown", function( event ) {
            if ( event.keyCode === $.ui.keyCode.TAB &&
                    $( this ).autocomplete( "instance" ).menu.active ) {
                event.preventDefault();
            }
        })
        .autocomplete({
            minLength: 0,
            source: function( request, response ) {
                // delegate back to autocomplete, but extract the last term
                response( $.ui.autocomplete.filter(
                    availableTags, extractLast( request.term ) ) );
            },
            focus: function() {
                // prevent value inserted on focus
                return false;
            },
            select: function( event, ui ) {
                var terms = split( this.value );
                // remove the current input
                terms.pop();
                // add the selected item
                terms.push( ui.item.value );
                // add placeholder to get the comma-and-space at the end
                terms.push( "" );
                this.value = terms.join( "," );
                return false;
            }
        });
} );
</script>
    <!-- row -->
    <div class="row">
        <!-- Left sidebar -->
        <div class="col-md-12">
            <div class="white-box">
                @if (count($errors) > 0)
                <div class="alert alert-danger" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{  $error}}    </li>
                        @endforeach
                    </ul>
                </div>
                @endif
                @if (\Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <p>{{  \Session::get('success') }}</p>
                    </div>
                @endif
                <div class="row">
                    {{-- <div class="col-lg-2 col-md-3  col-sm-4 col-xs-12 inbox-panel">
                        <div> <a href="#" class="btn btn-custom btn-block waves-effect waves-light">Compose</a>
                            <div class="list-group mail-list m-t-20"> <a href="inbox.html" class="list-group-item active">Inbox <span class="label label-rouded label-success pull-right">5</span></a> <a href="#" class="list-group-item ">Starred</a> <a href="#" class="list-group-item">Draft <span class="label label-rouded label-warning pull-right">15</span></a> <a href="#" class="list-group-item">Sent Mail</a> <a href="#" class="list-group-item">Trash <span class="label label-rouded label-default pull-right">55</span></a> </div>
                            <h3 class="panel-title m-t-40 m-b-0">Labels</h3>
                            <hr class="m-t-5">
                            <div class="list-group b-0 mail-list"> <a href="#" class="list-group-item"><span class="fa fa-circle text-info m-r-10"></span>Work</a> <a href="#" class="list-group-item"><span class="fa fa-circle text-warning m-r-10"></span>Family</a> <a href="#" class="list-group-item"><span class="fa fa-circle text-purple m-r-10"></span>Private</a> <a href="#" class="list-group-item"><span class="fa fa-circle text-danger m-r-10"></span>Friends</a> <a href="#" class="list-group-item"><span class="fa fa-circle text-success m-r-10"></span>Corporate</a> </div>
                        </div>
                    </div> --}}
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mail_listing">
                        <h3 class="box-title">Compose New Message</h3>
                        <form action="{{ route('mails.import_list_mails') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                              <label for="list_mails">Import danh sách mail</label>
                              <input type="file" name="list_mails" id="list_mails" class="form-control" placeholder="" aria-describedby="helpId">
                              <br>
                              <button type="submit" class="btn btn-warning">Import</button>
                            </div>
                        </form>
                        <form action="{{route('mails.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="email">Email người nhận</label>
                                <input class="form-control" id="email" name="email" placeholder="Email người nhận">
                            </div>
                            @if (isset($final))
                                <div class="form-group">
                                    <label for="list_mails_class">Danh sách mail trên lớp cố vấn</label>
                                    <input class="form-control" type="text" name="list_mails_class" id="list_mails_class" value="{{$final}}" maxlength="250">
                                </div>
                            @else
                                <div class="form-group show-send-multiple-email">
                                    <label for="multiple_emails">Danh sách emails</label>
                                    <input type="text" class="form-control" id="multiple_emails" name="multiple_emails" placeholder="Gửi nhiều">
                                </div> 
                            @endif
                            
                            <div class="form-group">
                                <label for="subject">Tiêu đề</label>
                                <input class="form-control" id="subject" name="subject" placeholder="Tiêu đề">
                            </div>
                            <div class="form-group">
                                <label for="message">Nội dung</label>
                                <textarea class="textarea_editor form-control" id="message" name="message" rows="15" placeholder="Enter text ..."></textarea>
                            </div>
                            <h4><i class="ti-link"></i> Attachment</h4>
                            <div class="fallback">
                                <input type="file" name="file" id="file">
                            </div>
                            <hr>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Send</button>
                                <button type="reset" class="btn btn-default"><i class="fa fa-times"></i> Discard</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="{{asset('/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('/unisharp/laravel-ckeditor/adapters/jquery.js')}}"></script>
<script>
    $('textarea').ckeditor();
    // $('.textarea').ckeditor(); // if class is prefered.
</script>
@endsection