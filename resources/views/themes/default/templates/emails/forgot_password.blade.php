<html>
    <head>
        <style>

        </style>
    </head>
    <body>
        Hi {{ $user->first_name }},
        <br/>
        Someone recently requested that the password be reset for {{ $user->username }}
        <br/>
        To reset your password, Please visit the following URL:
        <a href="{{ $reset_url }}">Reset Password</a>
        <br/>
        If this is a mistake just ignore this email - Your password will not be changed.
        <br/>
        Best Regards.
    </body>
</html>