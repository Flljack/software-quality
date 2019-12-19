const {Browser, By, Key, until} = require("selenium-webdriver");
const {suite} = require("selenium-webdriver/testing");
const assert = require('assert');
const DragAndDropPage = require('../pages/drag_and_drop.js');
const config = require('../config/testConfig');

suite(function(env) {
    describe('Check service', function() {
        let driver;

        before(async function() {
            driver = await new Builder().forBrowser('chrome').build();
        });

        it('Check adding process', async function() {
            await driver.get(config.testingUrl);
            //await driver.wait(until.elementLocated(By.xpath("//*[text()='Account']")), 10000);
            await  driver.findElement(By.xpath("//*[text()='Account']")).click();
        });

        after(() => driver && driver.quit());
    });
});