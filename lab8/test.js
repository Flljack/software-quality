require('chromedriver');
const assert = require('assert');
const {Builder, Key, By, until} = require('selenium-webdriver');
const config = require('./config/testConfig.js');

describe('Checkout Google.com', function () {
    let driver;

    before(async function() {
        driver = await new Builder().forBrowser(config.browser).build();
    });

    it('Search on Google', async function() {
        await driver.get('http://52.136.215.164:9000/');
        await driver.findElement(By.xpath("/html/body/div[1]/div/div/div[1]/div/div[2]/a")).click();
        await driver.findElement(By.xpath("/html/body/div[1]/div/div/div[1]/div/div[2]/ul/li[1]/a")).click();
        await driver.findElement(By.css("input#login")).sendKeys(config.userLogin);
        await driver.findElement(By.css("input#pasword")).sendKeys(config.userPassword);
        await driver.findElement(By.css("#login > button")).click();
    });

    after(() => driver && driver.quit());
});