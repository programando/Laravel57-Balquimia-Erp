module.exports = {
    methods:{
            AnyError      ( ) {
                return Object.keys(this.ErrorsController).length > 0 ;
              },
            ErrorsClear ( field){
                  delete this.ErrorsController[field] ;
              },
            ErrorHas ( field  ) {
                  return this.ErrorsController.hasOwnProperty( field );
            },
            ErrorGet(field ){
               if ( this.ErrorsController[field]){
                return this.ErrorsController[field][0];
              }
            },
            ErrorOnFail( error ){
                 this.ErrorsController = error.response.data.errors;
            },
            ErrorclearAll () {
             this.ErrorsController      = {};
             }
    }
};

