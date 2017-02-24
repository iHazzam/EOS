import './bootstrap'

var MyComponent = require('./components/VueTypeahead.vue');
Vue.component('vueTypeahead', MyComponent);

const app = new Vue({
    el: '#root',
    data: {
        total_price: 0,
        client_price: 0,
        defaultContact : false,
        deliveryChecked: false,
        defaultDelivery : false,
        label:'',
        value: '',
        value1: '',
        myTemplate: '<article class="media"><figure class="media-left"><p class="image is-64x64"><img :src="imageurl"></p></figure><p><strong>{{ code }}</strong> {{name}} <br>£{{ price }}</p></article>',
        // localValues: ['Dhaka', 'Rangpur', 'Rajshahi', 'Sylhet', 'Khulna']
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
        },
        updateTotalPrice: function(posneg){
            total_price += posneg;
        },
        updateClientPrice: function(posneg){
            client_price += posneg;
        }

    },
});

