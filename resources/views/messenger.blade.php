@extends('layouts.body')
@section('body')
<div class="row messenger">
    <div class="col-sm-2">
        @include('partials.peoplelist')
    </div>
    <div class="chat col-sm-10">
        <div class="chat-header clearfix">
            @if(isset($user))
                <img class="avatar-sm img-circle" src="{{\App\Http\Controllers\ProfileController::getAvatarUrlUser($user)}}" alt="avatar" />
            @endif
            <div class="chat-about">
                @if(isset($user))
                    <div class="chat-with">{{'Chat with ' . @$user->name}}</div>
                @else
                    <div class="chat-with">Ninguna conversacion seleccionada</div>
                @endif
            </div>
            <i class="fa fa-star"></i>
        </div> <!-- end chat-header -->

        <div class="chat-history">
            <ul id="talkMessages" class="list-unstyled">
                @if(isset($messages))
                @foreach($messages as $message)
                    @if($message->sender->id == Auth::user()->id)
                        <li class="clearfix" id="message-{{$message->id}}">
                            <div class="message-data align-right">
                                <span class="message-data-time" >{{$message->humans_time}}</span> &nbsp; &nbsp;
                                <span class="message-data-name" >{{$message->sender->name}}</span>
                                {{--<a href="#" class="talkDeleteMessage" data-message-id="{{$message->id}}" title="Delete Message"><i class="fas fa-times-circle"></i></a>--}}
                            </div>
                            <div class="message other-message float-right">
                                {{$message->message}}
                            </div>
                        </li>
                    @else
                        <li id="message-{{$message->id}}">
                            <div class="message-data">
                                <span class="message-data-name">{{$message->sender->name}}</span>
                                <span class="message-data-time">{{$message->humans_time}}</span>
                            </div>
                            <div class="message my-message">
                                {{$message->message}}
                            </div>
                        </li>
                    @endif
                @endforeach
                @endif
            </ul>

        </div> <!-- end chat-history -->

        <div class="chat-message clearfix">
            @if(isset($messages))
            <form action="" method="post" id="talkSendMessage">
                <textarea name="message-data" id="message-data" placeholder ="Escribir..." rows="3"></textarea>
                <input type="hidden" name="_id" value="{{@request()->route('id')}}">
                <button type="submit">Enviar</button>
            </form>
            @endif
        </div> <!-- end chat-message -->

    </div> <!-- end chat -->

</div> <!-- end container -->
@endsection
@section('scripts')
    <script !src="">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function () {

            var __baseUrl = "{{url('/')}}"
            $('#talkSendMessage').on('submit', function(e) {
                e.preventDefault();
                var url, request, tag, data;
                tag = $(this);
                url = __baseUrl + '/ajax/message/send';
                data = tag.serialize();

                request = $.ajax({
                    method: "post",
                    url: url,
                    data: data,
                });

                request.done(function (response) {
                    if (response.status == 'success') {
                        $('#talkMessages').append(response.html);
                        tag[0].reset();
                    }
                });

            });


            // $('body').on('click', '.talkDeleteMessage', function (e) {
            //     e.preventDefault();
            //     var tag, url, id, request;
            //
            //     tag = $(this);
            //     id = tag.data('message-id');
            //     url = __baseUrl + '/ajax/message/delete/' + id;
            //
            //     if(!confirm('Do you want to delete this message?')) {
            //         return false;
            //     }
            //
            //     request = $.ajax({
            //         method: "post",
            //         url: url,
            //         data: {"_method": "DELETE"}
            //     });
            //
            //     request.done(function(response) {
            //         if (response.status == 'success') {
            //             $('#message-' + id).hide(500, function () {
            //                 $(this).remove();
            //             });
            //         }
            //     });
            // })

        });

    </script>
@endsection
