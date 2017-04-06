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
        currency: 'GBP',
        defaultDelivery : false,
        deliveryCost: 0,
        currencies: [],
        label:'',
        value: '',
        value1: '',
        myTemplate: '<article class="media"><figure class="media-left"><p class="image is-64x64"><img :src="imageurl"></p></figure><p><strong>{{ code }}</strong> {{name}} <br> £{{ price }}</p></article>',
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
            this.updateDeliveryCost();
        },
        unsetDelivery: function(){
            this.deliveryChecked = false;
            this.updateDeliveryCost();
        },
        clearAll: function(){
          this.orderedproducts = new OrderedProducts();
            this.updateDeliveryCost();
        },
        removeRow: function(){

        },
        done: function(data) {
            console.log(this.currencies[this.currency]);
            var currencymod = this.currencies[this.currency];
            var discountprice = data.price * data.discountmod * currencymod;
            var currprice = data.price * currencymod;
            var newprod = new Product(data.code,data.name,currprice,discountprice,data.imageurl);
            this.orderedproducts.addProductToOrder(newprod);
            this.updateDeliveryCost();
        },
        updateTotalPrice: function(posneg){
            total_price += posneg;
            this.updateDeliveryCost();
        },
        updateClientPrice: function(posneg){
            client_price += posneg;
            this.updateDeliveryCost();
        },
        clickProtocol: function (event) {
                this.clearAll();
                this.updateDeliveryCost();
        },

        calculatedPrice: function (price) {
            return price * this.currencies[this.currency];
        },
        updateDeliveryCost: function()
        {
            var dm = [];
            dm[0] = 0.205;
            dm[1] = 0.175;
            dm[2]  = 0.15;
            dm[3] = 0.125;
            dm[4] = 240;

            var doccharge = [];
            doccharge['USD'] = 0;
            doccharge['EUR'] = 65;
            doccharge['GBP'] = 50;

            var delcost = 0;
            if(this.deliveryChecked)
            {
                var totalPrice = this.orderedproducts.getTotalPrice();
                if(totalPrice > 9000)
                {
                    delcost = totalPrice*dm[3];
                }
                else if(totalPrice > 3600)
                {
                    delcost = totalPrice*dm[2];
                }
                else if(totalPrice > 1800)
                {
                    delcost = totalPrice*dm[1];
                }
                else
                {
                    delcost = totalPrice * dm[0];
                    if(delcost < dm[4])
                    {
                        delcost = dm[4];
                    }
                }
            }
            else{
                delcost = doccharge[this.currency];
            }


            this.deliveryCost = delcost.toFixed(2);
        }

    },
    computed:{
        getDeliveryCost: function () {
            return this.deliveryCost;
        },
        currencySymbol: function () {
            switch(this.currency){
                case "GBP":
                    return "£";
                    break;
                case "EUR":
                    return "€";
                    break;
                case "USD":
                    return "$";
                    break;
                default:
                    return "";
            }
        },
    },
    created: function () {
        axios.get('http://playdale.me/api/currencies/get').then(response=>{
          this.currencies = response.data
        })
    }

});

