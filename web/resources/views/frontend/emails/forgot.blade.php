<div style="color: blue">
    Dear {{$user->name}},<br><br>
    Your Password Reset link are as follows:<br><br>
    <a href="{{route('user.password.reset')}}?id={{$user->var_code_enc}}">{{route('user.password.reset')}}?id={{$user->var_code_enc}}</a>
    
</div>