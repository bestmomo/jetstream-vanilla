@foreach (json_decode(decrypt($user->two_factor_recovery_codes), true) as $code)
    <div>{{ $code }}</div>
@endforeach

