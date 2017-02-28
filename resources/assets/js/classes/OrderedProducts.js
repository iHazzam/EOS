/**
 * Created by harry on 24/02/2017.
 */

export default class OrderedProducts{


    constructor(){
        this.products = [];
    }

    addProductToOrder(product){
        this.products.push(product);
    }
    removeFromOrder(product){
        this.products.pop(product)
    }

    getTotalPrice(){
        var totalprice = 0;
        for(var i=0; i<this.products.length; i++){
            totalprice += (this.products[i].price * this.products[i].quantity);
        }
        return totalprice.toFixed(2);
    }

    getDiscountedPrice(){
        var totalprice = 0;
        for(var i=0; i<this.products.length; i++){
            totalprice += (this.products[i].discountedprice * this.products[i].quantity);
        }
        return totalprice.toFixed(2);
    }



}

