
var CartWidget = require('./front/CartWidget.vue')
var OrderButton = require('./front/OrderButton.vue')

// Setup vue-resource
Vue.use(require('vue-resource'))
Vue.http.options.root = '/api'
Vue.http.options.headers['X-CSRF-TOKEN'] = document.querySelectorAll('meta[name="csrf-token"]')[0].getAttribute('content')

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
        },
        'notify-success': function (msg) {
            this.notify(msg, 'success', 'fa fa-check')
        },
        'notify-danger': function (msg) {
            console.log(1)
            this.notify(msg, 'danger', 'fa fa-times')
        },
    },
    methods: {
        notify: function (msg, type, icon) {
            $.notify({
                icon: icon,
                message: msg,
            },{
                type: type,
                placement: {
                    from: 'bottom',
                    align: 'center',
                },
                delay: 3000
            });
        }

    },
})
