<template>
      <div class="card-footer" v-if="Pagination.last_page > 1">
            <div class="row justify-content-center">
            <nav aria-label="Page navigation ">
              <ul class="pagination">
                <li class="page-item" v-for="page in Pagination.last_page">
                  <router-link :to="{
                      name :'cargos',
                      query : {
                          page : page
                        }
                      }" class="page-link" :class="GetActiveClass( page )" >
                    {{ page}}
                  </router-link>
                </li>
              </ul>
            </nav>
            </div>
      </div> <!-- /footer -->
</template>

<script >
    export default {
        props : [ 'Pagination'],
        methods:{
            GetActiveClass( page ){
               return [
                    ! this.$route.query.page && page ==1 ? 'active': ''
                  ]
          }

        }
    };

</script>

<style>
   .active{
        color: red;
  }
</style>
