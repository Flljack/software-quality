const config = require('../config/testConfig.js');
const { By, until } = require("selenium-webdriver/lib/by");

class Auth {
    constructor(driver) {
        this.driver = driver;
    }
    async test() {
        await this.driver.findElement(By.xpath(config.accountSelector)).click();
        await this.driver.findElement(By.xpath(config.loginSelector)).click();
        await this.driver.findElement(By.css(config.authLoginSelector)).sendKeys(config.authLogin);
        await this.driver.findElement(By.css(config.authPasswordSelector)).sendKeys(config.authPassword);
        await this.driver.findElement(By.css(config.authSubmitSelector)).click();
    }
}
module.exports = Auth;