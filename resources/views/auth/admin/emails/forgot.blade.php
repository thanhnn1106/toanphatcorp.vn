Dear {{ isset($user->display_name) ? $user->display_name : 'client' }},

It looks like you forgot your password or it isn't working. Don't worry, we've got you covered because there's
enough to worry about other than forgotten passwords.

So just visit this link to reset your password: {{ route('admin.auth.reset_form', ['token'=>$token]) }}

Best,
Magbe Team