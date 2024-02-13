<!-- resources/views/emails/setPasswordForm.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set Password</title>
</head>
<body>
    <h2>Set Your Password</h2>
    <form action="{{ route('savePassword') }}" method="GET">
        @csrf
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br>
        <input type="hidden" id="email" name="email"  value="{{$email}}" readonly><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br>
        {{-- <label for="password_confirmation">Confirm Password:</label><br>
        <input type="password" id="password_confirmation" name="password_confirmation" required><br><br> --}}
        <input type="submit" value="Set Password">
    </form>
</body>
</html>
