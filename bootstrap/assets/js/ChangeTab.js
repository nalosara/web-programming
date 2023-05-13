var ChangeTab = {

    goToShopPage: function () {
        $("#ShopDiv").css({ "display": "block" });
        $("#HomeDiv").css({ "display": "none" });
        $("#AboutDiv").css({ "display": "none" });
        $("#ContactDiv").css({ "display": "none" });

    },
    goToHomePage: function () {
        $("#ShopDiv").css({ "display": "none" });
        $("#HomeDiv").css({ "display": "block" });
        $("#AboutDiv").css({ "display": "none" });
        $("#ContactDiv").css({ "display": "none" });
    },

    goToAboutPage: function () {
        $("#AboutDiv").css({ "display": "block" });
        $("#HomeDiv").css({ "display": "none" });
        $("#ShopDiv").css({ "display": "none" });
        $("#ContactDiv").css({ "display": "none" });
    },

    goToContactPage: function () {
        $("#ContactDiv").css({ "display": "block" });
        $("#AboutDiv").css({ "display": "none" });
        $("#HomeDiv").css({ "display": "none" });
        $("#ShopDiv").css({ "display": "none" });
    }


}