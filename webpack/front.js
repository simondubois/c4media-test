
var CartWidget = require('./front/CartWidget.vue')
var OrderButton = require('./front/OrderButton.vue')

// custome filters
Vue.filter('price', function (price, currency) {
  return price.toFixed(2) + ' ' + currency
})

// mount a root Vue instance
var frontVm = new Vue({
    el: 'body',
    components: {
        cartwidget: CartWidget,
        orderbutton: OrderButton,
    },
    events: {
        'update-cart': function (msg) {
            // on update-cart event from OrderButton, send back message to CartWidget
            this.$broadcast('update-cart', msg)
        }
    }
})
