<div>
    <div class="box box-info">
        <div class="box-body no-padding">
            <ul class="users-list clearfix">
                @if(isset($users))
                    @if($users != null)
                        @foreach($users as $user)
                            <li>
                                <img class="user-profile-image" src="{{ \App\Http\Controllers\ProfileController::getAvatarUrlUser($user) }}" alt="{{ $user->name }}">
                                <a class="users-list-name" href="{{ route('profile.show',$user->id) }}">{{ $user->name }}</a>
                                @if($doctor = \App\Models\Medical\Doctor::where('user_id',$user->id)->first())
                                    <a href=""><h4>{{ $doctor->medicalSpeciality->name }}</h4></a>
                                @endif
                                <span class="users-list-date">
                                    <a href="{{ route('messenger.read',$user->id)}}"><i class="fa fa-comments"></i> Mensaje</a>
                                </span>
                            </li>
                        @endforeach
                    @endif
                @endif
            </ul>
        </div>
    </div>
</div>
