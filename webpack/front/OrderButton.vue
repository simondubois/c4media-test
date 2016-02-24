
<template>

    <button class='btn btn-primary' v-on:click="updateCart">
        <i class='fa fa-fw fa-cart-plus'></i>
        {{ title }}
    </button>

</template>



<script>

    export default {
        props: ['productId', 'inputQuantity', 'action'],
        computed: {
            title: function () {
                if (this.action === 'add') {
                    return 'Add to card'
                }
                if (this.action === 'update') {
                    return 'Update card'
                }
            },
            quantity: {
                cache: false,
                get: function () {
                    // get quantity from input element
                    console.log($(this.inputQuantity).val())
                    return $(this.inputQuantity).val()
                },
            },
            message: {
                cache: false,
                get: function () {
                    // message to send to parent on button click
                    return {
                        action: this.action,
                        productId: this.productId,
                        quantity: this.quantity,
                    }
                },
            },
        },
        methods: {
            updateCart: function () {
                // on button click, send update-cart event to parent
                this.$dispatch('update-cart', this.message);
            },
        },
    }
</script>