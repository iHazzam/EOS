export default class Product{

    constructor(code, name, price, discountprice, imageurl ){
        this.code = code;
        this.name = name;
        this.price = price.toFixed(2);
        this.discountedprice = discountprice.toFixed(2);
        this.imageurl = imageurl;
        this.quantity = 1;
    }

    incrementQuantity()
    {
        this.quantity += 1;
    }

    decrementQuantity()
    {
        this.quantity -= 1;
    }


}