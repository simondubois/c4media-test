
var CartWidget = require('./cart-widget/App.vue')

// custome filters
Vue.filter('price', function (price, currency) {
  return price.toFixed(2) + ' ' + currency
})

// mount a root Vue instance
new Vue({
    el: 'body',
    components: {
        cartwidget: CartWidget,
    },
})