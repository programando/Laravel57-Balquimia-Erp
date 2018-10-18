<!DOCTYPE html>
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />

 @include('templates.mails.css')

</head>
<body style="background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;">
  <table border="0" cellpadding="0" cellspacing="0" width="100%">
      @include('templates.mails.logo')
      @include('templates.mails.titulo')
      @include('templates.mails.contenido')
      @include('templates.mails.footer')
  </table>

  </body>
</html>
