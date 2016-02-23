
<template>

    <button class='btn btn-primary' v-on:click="updateCart">
        <i class='fa fa-fw fa-cart-plus'></i>
        Add to card
    </button>

</template>



<script>

    export default {
        props: ['productId', 'inputQuantity', 'action'],
        computed: {
            quantity: function () {
                // get quantity from input element
                return $(this.inputQuantity).val()
            },
            message: function () {
                // message to send to parent on button click
                return {
                    action: this.action,
                    productId: this.productId,
                    quantity: this.quantity,
                }
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