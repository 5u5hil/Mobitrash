<div>
<table cellspacing="0" cellpadding="0" border="0" bgcolor="#93AC49" align="center" style="max-width:600px;min-width:200px;border:1px solid #93ac49">
  <tbody>
    <tr>
      <td width="600" style="padding:10px 0px"><table width="217" cellspacing="0" cellpadding="0" border="0" align="left">
          <tbody>
            <tr>
              <td style="padding:14px;font-family:calibri;font-size:15px;color:#1b1b1b;text-align:justify;line-height:20px">Hello {{$user->name}},</td>
            </tr>
          </tbody>
        </table></td>
    </tr>
    <tr>
      <td height="10" bgcolor="#FFFFFF" style="border-top:1px solid #93ac49"></td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF"><table width="90%" border="0" cellspacing="0" cellpadding="0">
          <tbody>
            <tr>
              <td width="10"></td>
              <td style="font-family:calibri;font-size:15px;color:#1b1b1b;text-align:justify;line-height:20px"> Looks like you've forgotten your password. To complete password reset process, click on the link below:<br>
                  <a href="{{route('user.password.reset')}}?id={{$user->var_code_enc}}" target="_BLANK" >Reset Password</a>
                <br>
                <strong>Thanks,<br>
                Mobitrash Team</strong>. </td>
              <td width="10"></td>
            </tr>
          </tbody>
        </table></td>
    </tr>
    <tr>
      <td height="10" bgcolor="#FFFFFF" style="border-bottom:1px solid #93ac49"></td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF"></td>
    </tr>
    <tr>
      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tbody>
            <tr>
              <td width="10"></td>
              <td height="10"></td>
              <td width="10"></td>
            </tr>
            <tr>
              <td></td>
              <td style="font-family:calibri;font-size:14px;color:#1b1b1b;text-align:center">
                 Visit <a href="{{route('/')}}" target="_blank">MobiTrash</a> now.<br>
                 Feel free to write to us @ <a href="mailto:getit@mobitrash.in" target="_blank">getit@mobitrash.in</a> for any queries.</td>
              <td></td>
            </tr>
            <tr>
              <td></td>
              <td height="10"></td>
              <td></td>
            </tr>
          </tbody>
        </table></td>
    </tr>
  </tbody>
</table>
</div>