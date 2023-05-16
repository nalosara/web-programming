var ChangeTab = {

    goToShopPage: function () {
        $("#ShopDiv").css({ "display": "block" });
        $("#HomeDiv").css({ "display": "none" });
        $("#AboutDiv").css({ "display": "none" });
        $("#ContactDiv").css({ "display": "none" });
        $("#ProductDiv").css({ "display": "none" });

    },
    goToHomePage: function () {
        $("#ShopDiv").css({ "display": "none" });
        $("#HomeDiv").css({ "display": "block" });
        $("#AboutDiv").css({ "display": "none" });
        $("#ContactDiv").css({ "display": "none" });
        $("#ProductDiv").css({ "display": "none" });
    },

    goToAboutPage: function () {
        $("#AboutDiv").css({ "display": "block" });
        $("#HomeDiv").css({ "display": "none" });
        $("#ShopDiv").css({ "display": "none" });
        $("#ContactDiv").css({ "display": "none" });
        $("#ProductDiv").css({ "display": "none" });
    },

    goToContactPage: function () {
        $("#ContactDiv").css({ "display": "block" });
        $("#AboutDiv").css({ "display": "none" });
        $("#HomeDiv").css({ "display": "none" });
        $("#ShopDiv").css({ "display": "none" });
        $("#ProductDiv").css({ "display": "none" });
    },

    goToProductPage: function (productid) {
        ProductService.showProduct(productid);
        $("#ProductDiv").css({ "display": "block" });
        $("#ContactDiv").css({ "display": "none" });
        $("#AboutDiv").css({ "display": "none" });
        $("#HomeDiv").css({ "display": "none" });
        $("#ShopDiv").css({ "display": "none" });
    }


}