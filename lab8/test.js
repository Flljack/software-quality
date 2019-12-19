require('chromedriver');
const assert = require('assert');
const {Builder, Key, By, until} = require('selenium-webdriver');
const config = require('./config/testConfig.js');
const AuthTest = require('./pages/Auth.js');
const ShoppingCartTest = require('./pages/ShoppingCart.js');
const BuyProductTest = require('./pages/BuyProduct.js');
const SearchTest = require('./pages/Search.js');

describe('Authorization check', function () {
    let driver;

    before(async function() {
        driver = await new Builder().forBrowser(config.browser).build();
    });

    it('Authorization check', async function() {
        await driver.get(config.testingUrl);
        let tester = new AuthTest(driver);
        await tester.test();
        // проверка на вспл. сообщение
        let successfulMessage = await driver.wait(until.elementLocated(By.className(config.alertSuccessSelector)), 10000);
        await driver.wait(until.elementIsVisible(successfulMessage), 10000);
    });

    after(() => driver && driver.quit());
});



describe('add product to shopping cart', function () {
    let driver;

    before(async function() {
        driver = await new Builder().forBrowser(config.browser).build();
    });

    it('add product to shopping cart', async function(){
        await driver.get(config.testingUrl);

        let shoppingCartTester = new ShoppingCartTest(driver);
        let productPrice = await shoppingCartTester.getFirstProductPrice();
        await shoppingCartTester.openModalShoppingCart();

        // проверка на открытия модального окна
        let shoppingCart = await driver.wait(until.elementLocated(By.css(config.modalWindowSelector)), 10000);
        await driver.wait(until.elementIsVisible(shoppingCart), 10000);

        let modalPrice = await ShoppingCartTest.getModalPriceSum(shoppingCart);
        assert(productPrice === modalPrice);
    });

   after(() => driver && driver.quit());
});

describe('Buy product', function () {
    let driver;

    before(async function() {
        driver = await new Builder().forBrowser(config.browser).build();
    });

    it('Buy product', async function(){
        await driver.get(config.testingUrl);
        let buyProductTester = new BuyProductTest(driver);
        await buyProductTester.addFirstProductToShoppingCart();

        // проверка на открытия модального окна
        let shoppingCart = await driver.wait(until.elementLocated(By.css(config.modalWindowSelector)), 10000);
        await driver.wait(until.elementIsVisible(shoppingCart), 10000);

        await buyProductTester.toShoppingCartPage(shoppingCart);
        //let newPage = await driver.wait(until.elementsLocated(By.css('.account-left form')), 10000);
        //await driver.wait(until.elementIsVisible(newPage), 10000);
        await buyProductTester.fillingAndSumbitForm();
        // проверка на вспл. сообщение
        await driver.wait(until.elementLocated(By.className(config.alertSuccessSelector)), 10000);
    });

    after(() => driver && driver.quit());
});



describe('search product', function () {
    let driver;

    before(async function() {
        driver = await new Builder().forBrowser(config.browser).build();
    });

    it('search product', async function(){
        await driver.get(config.testingUrl);
        let searchTester = new SearchTest(driver);
        let searchInput = await searchTester.test();
        await searchInput.sendKeys(Key.ENTER);
        let titleText = await searchTester.getPageTitle();
        assert(titleText.indexOf(config.searchResultTitle) !== -1);
    });

    after(() => driver && driver.quit());
});