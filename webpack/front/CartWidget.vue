
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
            }
        },
        events: {
            'update-cart': function (msg) {
                // on button click, send update-cart event to parent
                console.log(msg)
            },
        },
    }

</script>