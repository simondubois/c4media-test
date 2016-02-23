
var CartWidget = require('./cart-widget/App.vue')

// mount a root Vue instance
new Vue({
    el: 'body',
    components: {
        cartwidget: CartWidget,
    },
})