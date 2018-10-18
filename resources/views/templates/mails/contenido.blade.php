<tr>
  <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;">
<!--[if (gte mso 9)|(IE)]>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="600">
<tr>
<td align="center" valign="top" width="600">
<![endif]-->
<table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 700px;" >
  <!-- COPY -->
  <tr>
    <td bgcolor="#ffffff" align="left" style="padding: 20px 30px 40px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 25px;" >
      <p style="margin: 0;">
        @if ( isset( $Email_Contenido ))
        {{ $Email_Contenido }}
        @endif
      </p>
    </td>
  </tr>
  <!-- BULLETPROOF BUTTON -->
  @if ( isset( $Email_Btn_Action_Text ))
  <tr>
    <td bgcolor="#ffffff" align="left">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td bgcolor="#ffffff" align="center" style="padding: 20px 30px 60px 30px;">
            <table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="center" style="border-radius: 3px;" bgcolor="#F44336">
                  <a href="{{ URL('update-password',$Token )}}"
                  target="_blank" style="font-size: 20px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; padding: 15px 25px; border-radius: 2px; border: 1px solid #FFA73B; display: inline-block;">
                  {{ $Email_Btn_Action_Text  }}
                </a></td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </td>
  </tr>
  @endif

  @if ( isset($Email_Contenido_2))
    @yield('Prefooter')
  @endif
  <br><br>
</table>
<!--[if (gte mso 9)|(IE)]>
</td>
</tr>
</table>
<![endif]-->
</td>
</tr>
