
<template>

    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
                <th>Name</th>
                <th>Code</th>
                <th>Unit price (incl. VAT)</th>
                <th>Quantity</th>
                <th>Total price (incl. VAT)</th>
                <th>Update order</th>
            </thead>
            <tbody>
                <template v-for="product in item.products">
                    <product :item="product" :currency="item.currency"></product>
                </template>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4">Total excl. VAT</td>
                    <td>{{ item.price - item.vat }}</td>
                    <td></td>
                </tr>

                <tr>
                    <td colspan="4">Total VAT</td>
                    <td>{{ item.vat }}</td>
                    <td></td>
                </tr>

                <tr>
                    <td colspan="4">Total incl. VAT</td>
                    <td>{{ item.price }}</td>
                    <td></td>
                </tr>
            </tfoot>
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
                    vat: 0,
                    products: [],
                },
            }
        },
        computed: {
            resource: function () {
                return this.$resource('cart');
            },
        },
        events: {
            'cart-has-changed': function () {
                this.reloadItem()
            },
        },
        ready: function() {
            this.reloadItem()
        },
        methods: {
            reloadItem: function () {
                this.resource.get().then(function (response) {
                    this.item = response.data
                }, function (response) {
                    this.$dispatch('notify-danger', "Impossible to get cart information.<br>Error message : " + response.statusText)
                });
            },
        },
        components: {
            product: Product,
        },
    }

</script>



<style scoped>

    tfoot td {
        text-align: right;
        font-weight: bold;
    }

</style>
