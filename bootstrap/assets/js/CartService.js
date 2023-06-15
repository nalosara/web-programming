var CartService = {
    getUserProducts: function (user_id) {
        //make an ajax request to get the products
        $.ajax({
            url: 'rest/carts_by_user_id/' + user_id,
            method: "GET",
            contentType: "application/json",
    
            success: function (data) {
                var html = `<div class="shopping-cart"> 
                <div class="cart-title">
                    Your Cart
                </div>`;
                 for (var i = 0; i < data.length; i++) {
                    html+= ` 
                    <div class="row">
                        <div class="card mb-4 rounded-0">
                            <div class="row align-items-center" style="width: auto">
                                <div class="col">
                                    <img style="width: auto" class="card-img rounded-0 img-fluid cart-img-size" src=` + data[i].product_image + `>
                                </div>
                                <div class="col">
                                    <p style="width: auto" class="mb-0">` + data[i].product_name + `</p>
                                </div>
                                <div class="col">
                                    <p style="width: auto" class="mb-0">$` + data[i].product_price + `</p>
                                </div>
                                <div class="col">
                                    <p style="width: auto" class="mb-0">Quantity: ` + data[i].quantity + `</p>
                                </div>
                                <div class="col">
                                    <button type="submit" style="width: auto" onclick="CartService.deleteCartItem(${data[i].id})" class="btn btn-success">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>`
                }
                $("#cartContainer").html(html);
                $("#cartContainer").css({ "display": "block" })
            },
            error: function (err) {
                console.log(err.status);
                console.log("We have an error");
            }
        });
    
    },

    deleteCartItem: function(cart_id){

        $.ajax({
            url: 'rest/carts/' + cart_id,
            method: "DELETE",
            contentType: "application/json",
          
    
            success: function (result) {
                toastr.success("Item has been deleted successfully");
                ChangeTab.goToCartPage(localStorage.getItem('user_token'));
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                toastr.error("Error! Item has not been deleted.");
            },
        });

    }
}