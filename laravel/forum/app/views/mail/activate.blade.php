{{Lang::get('messages.activate_your_account')}}<br>
{{Lang::get('messages.activation_code_is')}}: {{$code}}<br>
{{Lang::get('messages.activation_link')}}: {{URL::to('activate_code/'.$code.'/'.$acc)}}
