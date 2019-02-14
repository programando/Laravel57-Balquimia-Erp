module.exports = {
    methods:{
        Success      ( Titulo, Message ) {
             toastr.options.closeButton = true;
             toastr.options.progressBar = true;
             toastr.success(Message, Titulo  )
          },
        Warning      ( Titulo, Message ) {
             toastr.options.closeButton = true;
             toastr.options.progressBar = true;
             toastr.warning(Message, Titulo  )
          },
        Info      ( Titulo, Message ) {
             toastr.options.closeButton = true;
             toastr.options.progressBar = true;
             toastr.info(Message, Titulo  )
          },
        Danger      ( Titulo, Message ) {
             toastr.options.closeButton = true;
             toastr.options.progressBar = true;
             toastr.danger(Message, Titulo  )
          },


    }
};

