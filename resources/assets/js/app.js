import './bootstrap'

Vue.component('product-search', require('./components/Productsearch'));


var MyComponent = require('./components/VueTypeahead.vue');
Vue.component('vueTypeahead', MyComponent);

const app = new Vue({
    el: '#root',
    data: {
        defaultContact : false,
        deliveryChecked: false,
        defaultDelivery : false,
        label:'',
        value: '',
        value1: '',
        myTemplate: '<div><h3>{{team}}</h3><h4>Custom Template</h4></div>',
        localValues: ['Dhaka', 'Rangpur', 'Rajshahi', 'Sylhet', 'Khulna']
    },
    methods:{
        toggleDefaultContact: function(){
            this.defaultContact = !this.defaultContact;
        },
        toggleDefaultDelivery: function(){
            this.defaultDelivery = !this.defaultDelivery;
        },
        toggleDeliveryChecked: function(){
            this.deliveryChecked = !this.deliveryChecked;
        },
        unsetDelivery: function(){
            this.deliveryChecked = false;
        },

        done: function(data) {
            console.log(data);
        }

    },
    computed: {
    }
});

