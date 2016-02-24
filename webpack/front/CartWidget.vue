
<template>

    <a href="/cart">
        <i class="fa fa-fw fa-shopping-cart"></i>
        {{ title }}
        <template v-if="item.price_including_vat">
            ({{ item.price_including_vat | price item.currency }})
        </template>
    </a>

</template>



<script>

    export default {
        data: function () {
            return {
                item : {
                    quantity: 0,
                    price_including_vat: 0,
                    currency: null,
                },
            }
        },
        computed: {
            title: function () {
                if (this.item.quantity == 0) {
                    return 'No product'
                }
                if (this.item.quantity == 1) {
                    return this.item.quantity + ' product'
                }
                return this.item.quantity + ' products'
            },
            resource: function () {
                return this.$resource('cart{/id}');
            },
        },
        watch: {
            item: function () {
                this.$dispatch('cart-has-changed')
            },
        },
        ready: function() {
            this.resource.get().then(function (response) {
                this.item = response.data
            }, function (response) {
                this.$dispatch('notify-danger', "Impossible to get cart information.<br>Error message : " + response.statusText)
            });
        },
        events: {
            'update-cart': function (msg) {
                // on update-cart event, update cart on server
                if (msg.action === 'add') {
                    this.addProduct(msg.productId, msg.quantity)
                } else if (msg.action === 'update') {
                    this.updateProduct(msg.productId, msg.quantity)
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
                    this.item = response.data
                    this.$dispatch('notify-success', "The product has been added to your cart.")
                }, function (response) {
                    this.$dispatch('notify-danger', "Impossible to add this product to your cart.<br>Error message : " + response.statusText)
                });
            },
            updateProduct: function (productId, quantity) {
                var entity = {
                    productId: productId,
                    quantity: quantity,
                    _method: 'PUT',
                }
                this.resource.save({id: productId}, entity).then(function (response) {
                    this.item = response.data
                    this.$dispatch('notify-success', "The product has been updated in your cart.")
                }, function (response) {
                    this.$dispatch('notify-danger', "Impossible to update this product in your cart.<br>Error message : " + response.statusText)
                });
            }
        },
    }

</script>