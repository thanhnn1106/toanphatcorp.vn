{!! trans('email_verify.dear', ['name' => $name]) !!}

{!! trans('email_verify.text_1', ['siteName' => $site_name, 'url' => route('auth.activate', $token)]) !!}

{!! trans('email_verify.text_2', ['siteName' => $site_name]) !!}