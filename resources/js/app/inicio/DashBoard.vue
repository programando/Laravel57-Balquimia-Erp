<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        Dashboard
                        <Compras :IdTercero="4167"></Compras>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
  import Compras      from '../../components/terceros/prd_comprados_ultmimos_anios';
    export default {

        components: { Compras },
    }
</script>
