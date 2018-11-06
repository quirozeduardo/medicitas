<div>
    <div class="box box-info">
        <div class="box-body no-padding">
            <ul class="users-list clearfix">
                @if(isset($patients))
                    @foreach($patients as $patient)
                        <li>
                            <img class="user-profile-image" src="{{ \App\Http\Controllers\ProfileController::getAvatarUrlUser($patient->user) }}" alt="{{ $patient->user->name }}">
                            <a class="users-list-name" href="#">{{ $patient->user->name }}</a>
                            <span class="users-list-date">Today</span>
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>
    </div>
</div>
