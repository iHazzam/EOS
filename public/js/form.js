

var app = new Vue({
    el: '#root',
    data: {
        defaultContact : false,
        deliveryChecked: false,
        defaultDelivery : false,

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
        }
    },
    computed: {
    }

});