{!! trans('email_forgot_password.dear', ['name' => isset($user->display_name) ? $user->display_name : 'client']) !!}

{!! trans('email_forgot_password.text_1') !!}

{!! trans('email_forgot_password.text_2', ['url' => route('auth.reset_form', ['token'=>$token])]) !!}

{!! trans('email_forgot_password.text_3', ['siteName' => app('magbe.theme')->site_display_name]) !!}