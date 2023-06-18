var ProductService = {
    editProduct: function() {
        $("#editProductForm").validate({
            submitHandler: function (form, validator) {
                data = {
                name: $("#edit_name").val(),
                description: $("#edit_description").val(),
                price: $("#edit_price").val(),
                category_id: $("#edit_category").val(),
                supplier_id: $("#edit_supplier").val(),
                quantity_in_stock: $("#edit_quantity_in_stock").val(),
                image: $("#edit_image").val(),
                };
                console.log(data);
                $.ajax({
                url: "rest/products/" + $("#edit_product_id").val(),
                type: "PUT",
                data: JSON.stringify(data),
                contentType: "application/json",
                dataType: "json",
                success: function (result) {
                    toastr.success("Product has been updated successfully");
                    $("#editProductModal").modal("toggle");
                    ChangeTab.goToShopPage();
                    ProductService.getProducts();
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    toastr.error("Error! Product has not been updated.");
                },
                });
            },
        });
    },

    getProducts: function () {
        //make an ajax request to get the products
        $.ajax({
            url: 'rest/products',
            method: "GET",
            contentType: "application/json",
    
            success: function (data) {
                var html = "<div class='row'>";
                for (var i = 0; i < data.length; i++) {
                        html+= ` 
                        <div class="col-sm-4">
                            <div class="card mb-4 product-wap rounded-0">
                                <div class="card rounded-0">
                                    <img class="card-img rounded-0 img-fluid custom-img-size" src=` + data[i].image + `>
                                    <div class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                                        <ul class="list-unstyled">
                                            <li><a class="btn btn-success text-white mt-2" onclick="showEditDialog(` + data[i].id + `);"><i class="far fa-eye"></i></a></li>
                                            <li><a class="btn btn-success text-white mt-2" onclick="ChangeTab.goToProductPage(` + data[i].id + `);"><i class="fas fa-cart-plus"></i></a></li>
                                            <li><button class="btn btn-success text-white mt-2" style="background-color: #fa6666 !important;" onclick="ProductService.deleteProduct(` + data[i].id + `);"><i class="fas fa-minus"></i></button></li>
                                        </ul>
                                    </div>
                                    <div class="card-body text-center">
                                        <a href="shop-single.html" class="h3 text-decoration-none">` + data[i].name + `</a>
                                        <p class="mb-0">$` + data[i].price +`</p>
                                    </div>
                                </div>
                            </div>
                        </div>`;
                    }
                $("#productContainer").html(html);
                $("#productContainer").css({ "display": "block" })
            },
            error: function (err) {
                console.log(err.status);
                console.log("We have an error");
            }
        });
    
    },

    getProductsWithFilters: function () {
        //make an ajax request to get the products
        var category = $("#dropdown-category").val();
        var supplier = $("#dropdown-suppliers").val();
        var order = $("#dropdown-order").val();
        
        $.ajax({
            url: 'rest/products?category=' + category + '&supplier=' + supplier + '&order=' + order,
            method: "GET",
            contentType: "application/json",
    
            success: function (data) {
                var html = "<div class='row'>";
                // TO DO: You have to clear the previous html first!
                for (var i = 0; i < data.length; i++) {
                    html+= ` 
                        <div class="col-sm-4">
                            <div class="card mb-4 product-wap rounded-0">
                                <div class="card rounded-0">
                                    <img class="card-img rounded-0 img-fluid custom-img-size" src=` + data[i].image + `>
                                    <div class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                                        <ul class="list-unstyled">
                                            <li><a class="btn btn-success text-white mt-2" onclick="showEditDialog(` + data[i].id + `);"><i class="far fa-eye"></i></a></li>
                                             <li><a class="btn btn-success text-white mt-2" onclick="ChangeTab.goToProductPage(` + data[i].id + `);"><i class="fas fa-cart-plus"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="card-body text-center">
                                        <a href="shop-single.html" class="h3 text-decoration-none">` + data[i].name + `</a>
                                        <p class="mb-0">$` + data[i].price +`</p>
                                    </div>
                                </div>
                            </div>
                        </div>`
                }
                $("#productContainer").html(html);
                $("#productContainer").css({ "display": "block" })
            },
            error: function (err) {
                console.log(err.status);
                console.log("We have an error");
            }
        });
    
    },
    
    showProduct: function (productid) {
        // Make an AJAX request to get the product
        $.ajax({
            url: 'rest/products/' + productid,
            method: 'GET',
            contentType: 'application/json',
    
            success: function (data) {
                console.log(data[0].name);
                var html = '';
    
                html += `<div class="d-flex justify-content-center align-items-center h-100">
                            <div class="card" style="margin-left: 50px; margin-right: 50px; margin-bottom: 50px; margin-top: -70px;">
                                <div class="row">
                                    <div class="col-md-5">
                                        <img class="card-img-top" src="${data[0].image}" alt="${data[0].name}">
                                    </div>
                                    <div class="col-md-7">
                                        <div class="card-body">
                                            <h1 class="h2">${data[0].name}</h1>
                                            <p class="h3 py-2">$${data[0].price}</p>
                                            <ul class="list-inline">
                                                <li class="list-inline-item">
                                                    <h6>Category:</h6>
                                                </li>
                                                <li class="list-inline-item">
                                                    <p class="text-muted"><strong>${data[0].category}</strong></p>
                                                </li>
                                            </ul>
    
                                            <h6>Description:</h6>
                                            <p>${data[0].description}</p>
                                            <ul class="list-inline">
                                                <li class="list-inline-item">
                                                    <h6>Brand :</h6>
                                                </li>
                                                <li class="list-inline-item">
                                                    <p class="text-muted"><strong>${data[0].supplier}</strong></p>
                                                </li>
                                            </ul>
    
                                            <form action="" method="GET">
                                                <input type="hidden" name="product-title" value="Activewear">
                                                <div class="row">
                                                    <div class="col-auto">
                                                        <ul class="list-inline pb-3">
                                                            <li class="list-inline-item text-right">
                                                                Quantity
                                                                <input type="hidden" name="product-quantity" id="product-quantity-mod" value="1">
                                                            </li>
                                                            <li class="list-inline-item"><span class="btn btn-success" id="btn-minusminus">-</span></li>
                                                            <li class="list-inline-item"><span class="badge bg-secondary" id="var-valuevalue">1</span></li>
                                                            <li class="list-inline-item"><span class="btn btn-success" id="btn-plusplus">+</span></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="row pb-3">
                                                    <div class="col d-grid">
                                                        <button id="buy_button" style="border-color: white;" class="btn btn-success btn-lg">Buy</button>
                                                    </div>
                                                    <div class="col d-grid">
                                                        <button id="add_to_cart" style="border-color: white;" class="btn btn-success btn-lg">Add To Cart</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>`;
    
                $("#singleProductContainer").html(html);
                $("#singleProductContainer").css({ "display": "block" });
    
                // Retrieve the elements and add event listeners
                var quantityInput = document.getElementById("product-quantity-mod");
                var minusButton = document.getElementById("btn-minusminus");
                var plusButton = document.getElementById("btn-plusplus");
                var quantityValue = document.getElementById("var-valuevalue");
    
                // Add event listener to the minus button
                minusButton.addEventListener("click", function() {
                    var currentValue = parseInt(quantityInput.value);
                    if (currentValue > 1) {
                        quantityInput.value = currentValue - 1;
                        quantityValue.textContent = quantityInput.value;
                    }
                });
    
                // Add event listener to the plus button
                plusButton.addEventListener("click", function() {
                    var currentValue = parseInt(quantityInput.value);
                    quantityInput.value = currentValue + 1;
                    quantityValue.textContent = quantityInput.value;
                });
    
                // Add event listener to the "Add to Cart" button
                var addToCartButton = document.getElementById("add_to_cart");
                addToCartButton.addEventListener("click", function(event) {
                    event.preventDefault();
                    ProductService.addProductToCart(data[0].id);
                });

                var buyButton = document.getElementById("buy_button");
                buyButton.addEventListener("click", function(event) {
                    event.preventDefault();
                    showSelectAddressDialog(data[0].id);
                });
            },
            error: function (err) {
                console.log(err.status);
                console.log("We have an error");
            }
        });
    },
    
    addProductToCart: function (product_id) {
        var data = {
          user_id: localStorage.getItem('user_token'),            
          product_id: product_id,
          quantity: document.getElementById('product-quantity-mod').value
        };
    
    
        $.ajax({
          url: 'rest/carts',
          method: 'POST',
          data: JSON.stringify(data),
          contentType: 'application/json',
          dataType: 'json',
          success: function (result) {
            ProductService.getProducts(); 
            ChangeTab.goToShopPage(); 
            toastr.success('Product has been added to your cart successfully');
          },
          error: function (XMLHttpRequest, textStatus, errorThrown) {
            toastr.error('Error! Product has not been added to your cart.');
            ChangeTab.goToShopPage(); // Redirect to the shop page
            ProductService.getProducts(); // Update the product list
          }
        });
    },

    selectAddress: function() {
        let user_id = localStorage.getItem('user_token');
        let options = "";
    
        $.ajax({
          url: "rest/addresses_by_user_token/" + user_id,
          type: "GET",
          success: function(data) {
            for (let i = 0; i < data.length; i++) {
              options += `<option value="${data[i].id}">${data[i].alias}</option>`;
            }
            document.getElementById("select-address").innerHTML = options;
    
            // Update the address ID when the user selects an option
            document.getElementById("select-address").addEventListener("change", function() {
              const selectedAddressId = this.value;
              document.getElementById("selected-address-id").value = selectedAddressId;
            });
    
            // Check if the user has addresses
            if (data.length === 0) {
              document.getElementById("selectAddressForm").onsubmit = function(event) {
                event.preventDefault(); // Prevent form submission
                alert("You have no addresses saved. Go to the user profile and add an address you would like your purchase to be shipped to.");
              };
            } else {
              // Check if the event listener is already added
              if (!document.getElementById("completePurchaseBtn").hasEventListener) {
                // Add event listener to the "Complete Purchase" button
                document.getElementById("completePurchaseBtn").addEventListener("click", ProductService.completePurchase);
    
                // Set flag to indicate the event listener is added
                document.getElementById("completePurchaseBtn").hasEventListener = true;
              }
            }
          },
        });
      },
    
      completePurchase: function(event) {
        event.preventDefault(); // Prevent form submission
        const selectedAddressId = document.getElementById("select-address").value;
        const product_id = document.getElementById("selected_product_id").value;
        ProductService.buyProduct(selectedAddressId, product_id);
      },
    
      buyProduct: function(selectedAddressId, product_id) {
        var data = {
          user_id: localStorage.getItem('user_token'),
          product_id: product_id,
          quantity: document.getElementById('product-quantity-mod').value,
          order_date: new Date().toJSON().slice(0, 10),
          address_id: selectedAddressId
        };
    
        $.ajax({
          url: 'rest/orders',
          method: 'POST',
          data: JSON.stringify(data),
          contentType: 'application/json',
          dataType: 'json',
          success: function(result) {
            ProductService.getProducts();
            ChangeTab.goToShopPage();
            toastr.success('Your purchase has been successful!');
            $('#selectAddressModal').modal('hide'); // Close the modal
    
            // Remove the event listener after a successful purchase
            document.getElementById("completePurchaseBtn").removeEventListener("click", ProductService.completePurchase);
            delete document.getElementById("completePurchaseBtn").hasEventListener;
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) {
            toastr.error('Error! There was a problem with your purchase. Please try again.');
            ChangeTab.goToShopPage(); // Redirect to the shop page
            ProductService.getProducts(); // Update the product list
            $('#selectAddressModal').modal('hide'); // Close the modal
    
            // Remove the event listener after an error in the purchase
            document.getElementById("completePurchaseBtn").removeEventListener("click", ProductService.completePurchase);
            delete document.getElementById("completePurchaseBtn").hasEventListener;
          }
        });
    },

    deleteProduct: function (product_id) {
        $.ajax({
          url: "rest/products/" + product_id,
          method: "DELETE",
          contentType: "application/json",
    
          success: function (result) {
            toastr.success("Product has been deleted successfully");
            ProductService.getProducts();
          },
          error: function (XMLHttpRequest, textStatus, errorThrown) {
            toastr.error("Error! Product has not been deleted.");
          },
        });
      },
}
