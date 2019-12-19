const config = require('../config/testConfig.js');
const { By, until } = require("selenium-webdriver/lib/by");

class BuyProduct {
    constructor(driver) {
        this.driver = driver;
    }
    async addFirstProductToShoppingCart() {
        let firstProduct = await this.driver.findElement(By.css(config.firstProductSelector));
        await firstProduct.findElement(By.css(config.buttonAddToShoppingCartSelector)).click();
    }

    async toShoppingCartPage(shoppingCart) {
        await shoppingCart.findElement(By.xpath(config.toShoppingPageSelector)).click();
        await this.driver.get(config.testingUrlShoppingCart);
    }

    async fillingAndSumbitForm() {
        await this.driver.findElement(By.css(config.buyLoginSelector)).sendKeys(config.buyLogin);
        await this.driver.findElement(By.css(config.buyPasswordSelector)).sendKeys(config.buyPassword);
        await this.driver.findElement(By.css(config.buyNameSelector)).sendKeys(config.buyName);
        await this.driver.findElement(By.css(config.buyEmailSelector)).sendKeys(config.buyEmail);
        await this.driver.findElement(By.css(config.buyAddressSelector)).sendKeys(config.buyAddress);
        await this.driver.findElement(By.css(config.buySubmitSelector)).click();
    }
}
module.exports = BuyProduct;