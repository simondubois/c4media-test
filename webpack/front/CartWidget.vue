
<template>

    <a href="/cart">
        <i class="fa fa-fw fa-shopping-cart"></i>
        {{ title }}
        <template v-if="totalPrice">
            ({{ totalPrice | price currency }})
        </template>
    </a>

</template>



<script>

    export default {
        data: function () {
            return {
                productQuantity: 1,
                totalPrice: 150,
                currency: 'SEK',
            }
        },
        computed: {
            title: function () {
                if (this.productQuantity == 0) {
                    return 'No product'
                }
                if (this.productQuantity == 1) {
                    return this.productQuantity + ' product'
                }
                return this.productQuantity + ' products'
            },
            resource: function () {
                return this.$resource('cart');
            },
        },
        events: {
            'update-cart': function (msg) {
                // on update-cart event, update cart on server
                if (msg.action === 'add') {
                    this.addProduct(msg.productId, msg.quantity)
                }
            },
        },
        methods: {
            addProduct: function (productId, quantity) {
                var entity = {
                    productId: productId,
                    quantity: quantity,
                }
                this.resource.save({}, entity).then(function (response) {
                    // success callback
                    console.log(response)
                }, function (response) {
                    // error callback
                    console.log(response)
                });
            }
        },
    }

</script>