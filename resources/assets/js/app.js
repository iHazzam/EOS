import './bootstrap'

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
        myTemplate: '<article class="media"><figure class="media-left"><p class="image is-64x64"><img src="""></p></figure><p><strong>{{ code }}</strong> {{name}} <br>£{{ formatprice }}</p></article>',
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
        }

    },
    computed: {
    }
});

