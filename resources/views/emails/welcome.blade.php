heelo {{ $user->name }}

to verify the link ::
{{ route('verify',$user->verification_token) }}
