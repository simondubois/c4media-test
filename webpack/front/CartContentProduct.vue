
<template>

    <tr>
        <td>{{ item.name }}</td>
        <td>{{ item.code }}</td>
        <td class="text-right">{{ item.price_including_vat | price currency }}</td>
        <td class="form-group">
            <input type="text" class="form-control text-right" id="quantity-product-{{ item.id }}" value="{{ item.quantity }}" size="3">
        </td>
        <td class="text-right">{{ total_price_including_vat | price currency }}</td>
        <td>
            <orderbutton
                :product-id="item.id"
                :input-quantity="'#quantity-product-'+item.id"
                action='update'
            ></orderbutton>
        </td>
    </tr>

</template>



<script>

    var OrderButton = require('./OrderButton.vue')

    export default {
        props: ['item', 'currency'],
        computed: {
            total_price_including_vat: function () {
                return this.item.price_including_vat * this.item.quantity
            },
        },
        components: {
            orderbutton: OrderButton,
        },
    }

</script>
