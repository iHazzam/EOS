import './bootstrap'
import OrderedProducts from './classes/OrderedProducts.js';
import Product from './classes/Product.js';


var MyComponent = require('./components/VueTypeahead.vue');
Vue.component('vueTypeahead', MyComponent);
const app = new Vue({
    el: '#root',
    data: {
        defaultContact : false,
        orderedproducts: new OrderedProducts(),
        orderedproducts2: op2,
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
        clearAll: function(){
          this.orderedproducts = new OrderedProducts();
        },
        removeRow: function(){

        },
        done: function(data) {
            console.log(data);
            var discountprice = data.price * data.discountmod;
            var newprod = new Product(data.code,data.name,data.price,discountprice,data.imageurl)
            this.orderedproducts.addProductToOrder(newprod);
        },
        updateTotalPrice: function(posneg){
            total_price += posneg;
        },
        updateClientPrice: function(posneg){
            client_price += posneg;
        }

    }

});

