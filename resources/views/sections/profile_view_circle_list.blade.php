<div>
    <div class="box box-info">
        <div class="box-body no-padding">
            <ul class="users-list clearfix">
                @if(isset($users))
                    @if($users != null)
                        @foreach($users as $user)
                            <li>
                                <img class="user-profile-image" src="{{ \App\Http\Controllers\ProfileController::getAvatarUrlUser($user) }}" alt="{{ $user->name }}">
                                <a class="users-list-name" href="#">{{ $user->name }}</a>
                                <span class="users-list-date">Hoy</span>
                            </li>
                        @endforeach
                    @endif
                @endif
            </ul>
        </div>
    </div>
</div>
