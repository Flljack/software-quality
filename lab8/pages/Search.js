require('chromedriver');
const config = require('../config/testConfig.js');
const { By, until, Key } = require("selenium-webdriver/lib/by");

class Search {
    constructor(driver) {
        this.driver = driver;
    }
    async test() {
        let searchInput = await this.driver.findElement(By.css(config.searchInputSelector));
        await searchInput.sendKeys(config.searchText);
        return searchInput;
    }

    async getPageTitle() {
       return await this.driver.getTitle();
    }
}
module.exports = Search;