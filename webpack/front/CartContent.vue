
<template>

    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
                <th>Name</th>
                <th>Code</th>
                <th>VAT</th>
                <th>Price (incl. VAT)</th>
                <th>Quantity</th>
                <th>Order</th>
            </thead>
            <tbody>
                <template v-for="product in item.products">
                    <product :item="product" :currency="item.currency"></product>
                </template>
            </tbody>
        </table>
    </div>

</template>



<script>

    var Product = require('./CartContentProduct.vue')

    export default {
        data: function () {
            return {
                item : {
                    quantity: 0,
                    price: 0,
                    currency: null,
                    products: [],
                },
            }
        },
        computed: {
            resource: function () {
                return this.$resource('cart');
            },
        },
        ready: function() {
            this.resource.get().then(function (response) {
                this.item = response.data
            }, function (response) {
                this.$dispatch('notify-danger', "Impossible to get cart information.<br>Error message : " + response.statusText)
            });
        },
        components: {
            product: Product,
        },
    }

</script>
