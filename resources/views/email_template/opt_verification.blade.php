
<html xmlns:x-mail="http://www.w3.org/1999/html">
<x-mail::message>
    <h1> Verification code</h1>
    Please use the verification code below to sign in.
    <h1>{{$user->opt_number}}</h1>
    If you didn’t request this, you can ignore this email.
</x-mail::message>
<x-mail::footer>
    Thanks,<br>
    {{ config('app.name') }} team
</x-mail::footer>
</html>
