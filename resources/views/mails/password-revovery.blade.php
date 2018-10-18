@php
     $Email_Contenido       = trans('_app.email_pass_recovey_text');
     $Email_Btn_Action_Text = trans('_app.btn_email_new_pass');
     $Email_Contenido_2     = trans('_app.email_pass_no_recovey_text');
     $Footer                = trans('_app.email_pass_recovey_footer');
@endphp

@include('templates.mails.main')

@section('Prefooter')
  <tr>
    <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 0px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 25px;" >
      <p style="margin: 0;">{{ $Email_Contenido_2 }}</p>
    </td>
  </tr>
@endsection

