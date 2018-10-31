{!!
    Form::macro('iRadio', function($name,$text,$value)
    {
    return '<label><div class="iradio checked">'.$text.Form::radio($name,$value).'</div></label>';
    });
!!}
