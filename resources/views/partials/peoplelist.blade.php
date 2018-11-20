<div class="people-list" id="people-list">
    <div class="search" style="text-align: center">
        <a href="{{url('/profile')}}" style="font-size:16px; text-decoration:none; color: white;"><i class="fa fa-user"></i> {{auth()->user()->name}}</a>
    </div>
    <ul class="list-unstyled">
        @foreach($threads as $inbox)
            @if(!is_null($inbox->thread))
                <li class="clearfix">
                    <a href="{{route('messenger.read', ['id'=>$inbox->withUser->id])}}">
                    <img class="avatar-sm img-circle" src="{{\App\Http\Controllers\ProfileController::getAvatarUrlUser($inbox->withUser)}}" alt="avatar" />
                    <div class="about">
                        <div class="name">{{$inbox->withUser->name}}</div>
                        <div class="status">
                            @if(auth()->user()->id == $inbox->thread->sender->id)
                                <span class="fa fa-reply"></span>
                            @endif
                            <span>{{substr($inbox->thread->message, 0, 20)}}</span>
                        </div>
                    </div>
                    </a>
                </li>
            @endif
        @endforeach

    </ul>
</div>
