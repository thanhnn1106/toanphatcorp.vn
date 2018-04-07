{!! trans('email_response_contact.dear', ['name' => isset($name) ? $name : 'client']) !!}

{!! trans('email_response_contact.text_1') !!}

{!! trans('email_response_contact.text_2') !!}
{{app('magbe.theme')->site_display_name}} {!! trans('email_response_contact.text_3') !!}