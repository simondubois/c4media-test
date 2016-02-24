
<template>

    <tr>
        <td>{{ item.name }}</td>
        <td>{{ item.code }}</td>
        <td>{{ item.price_including_vat | price currency }}</td>
        <td class="form-group">
            <input type="text" class="form-control" id="quantity-product-{{ item.id }}" value="{{ item.quantity }}" size="3">
        </td>
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
        'components': {
            'orderbutton': OrderButton,
        }
    }

</script>
