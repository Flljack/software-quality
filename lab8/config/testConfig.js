// option
module.exports.browser = "chrome";
module.exports.testingUrl = "http://52.136.215.164:9000";
module.exports.testingUrlShoppingCart = "http://52.136.215.164:9000/cart/view";

//common
module.exports.alertSuccessSelector = "alert alert-success";
module.exports.modalWindowSelector = "div#cart";
module.exports.modalCartSumSelector = ".text-right.cart-sum";

//auth
module.exports.accountSelector = "/html/body/div[1]/div/div/div[1]/div/div[2]/a";
module.exports.loginSelector = "/html/body/div[1]/div/div/div[1]/div/div[2]/ul/li[1]/a";
module.exports.authLoginSelector = "input#login";
module.exports.authPasswordSelector = "input#pasword";
module.exports.authSubmitSelector = "#login > button";
module.exports.authLogin = "uiTester";
module.exports.authPassword = "qwerty123";

//add product to shopping cart
module.exports.firstProductSelector = "body > div.content > div.product > div > div > div > div:nth-child(1) > div";
module.exports.productPriceSelector = "h4:nth-child(3) > .item_price";
module.exports.buttonAddToShoppingCartSelector = "h4:nth-child(3) > a:nth-child(1)";

// buy product
module.exports.toShoppingPageSelector = "//*[text() = 'Оформить заказ']";
module.exports.buyLoginSelector = "input#login";
module.exports.buyPasswordSelector = "input#pasword";
module.exports.buyNameSelector = "input#name";
module.exports.buyEmailSelector = "input#email";
module.exports.buyAddressSelector = "input#address";
module.exports.buySubmitSelector = ".account-left button[type='submit']";
// TODO: for test change login and email
module.exports.buyLogin = "useewq23234";
module.exports.buyPassword = "qwerty123";
module.exports.buyName = "User";
module.exports.buyEmail = "uqds1er@mail.ru";
module.exports.buyAddress = "Russia";

// search product
module.exports.searchInputSelector = "input[name='s']";
module.exports.searchText = "casio";
module.exports.searchResultTitle = "Поиск по";
