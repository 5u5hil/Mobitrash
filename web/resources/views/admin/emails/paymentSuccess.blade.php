<div style="max-width:700px; min-width: 320px; margin:0 auto; border:solid 2px #fff;background:url('{{ asset('public/Admin/dist/img/mobitrashback.jpg')}}')no-repeat; ">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding:10px;background-color: #333333;border-bottom: solid 9px #a2da15;">
        <tbody>
            <tr>
                <td align="left"><h1 style="color: #93AC49;font-size:23px;font-weight: 400;margin: 11px 13px 11px;">Hello {{$user['name']}},</h1></</td>
                <td align="right"><a href="{{ route('/') }}" target="_blank"><img src="{{ asset('public/Admin/dist/img/mobitrashlogo.png')}}" /></a></td>
            </tr>
        </tbody>
    </table>

    <div style="padding:10px; font-family:Arial, Helvetica, sans-serif; color:#484848; font-size:12px;  line-height:19px;height: 219px;">
        <div style="width: 100%; display: table;">
            <div style="font-family:sans-serif;color: #333333;text-align:center;font-size: 13px;">
                <span style="font:'Arial Black', Gadget, sans-serif;"><h2>Greetings from MobiTrash!</h2><h4>
                        <span>
                            We've successfully received your payment of Rs.{{$amt}}</span><br><br><span>Thanks,</span><br><span>Team MobiTrash</span></h4></span>

            </div>
        </div>
    </div>



    <div style="font-family:sans-serif;color: #fff; background: #333333;padding: 12px; text-align:center;font-size: 13px;">
        <span style="font:'Arial Black', Gadget, sans-serif;">Visit <a style="color: #fff; text-decoration: none;" href="{{route('/')}}" target="_blank">MobiTrash</a> Now.<br>Feel free to write to us at getit@mobitrash.in for any queries.</span>

    </div><br>
</div>