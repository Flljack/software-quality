const config = require('../config/testConfig.js');
const { By, until } = require("selenium-webdriver/lib/by");

class ShoppingCart {
    constructor(driver) {
        this.driver = driver;
        this.firstProduct = null;
    }

    async getFirstProductPrice() {
        this.firstProduct = await this.driver.findElement(By.css(config.firstProductSelector));
        return await this.firstProduct.findElement(By.css(config.productPriceSelector)).getText();
    }

    async openModalShoppingCart() {
        await this.firstProduct.findElement(By.css(config.buttonAddToShoppingCartSelector)).click();
    }

    static async getModalPriceSum(shoppingCart) {
        return await shoppingCart.findElement(By.css(config.modalCartSumSelector)).getText();
    }
}
module.exports = ShoppingCart;