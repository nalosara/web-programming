var ProductService = {
    getProducts: function () {
        //make an ajax request to get the products
        $.ajax({
            url: 'rest/products',
            method: "GET",
            contentType: "application/json",

            success: function (data) {
                var html = "";
                for (var i = 0; i < data.length; i++) {
                    html+= ` <div class="row">
                        <div class="col-md-4">
                                <div class="card mb-4 product-wap rounded-0">
                                <div class="card rounded-0">
                                    <img class="card-img rounded-0 img-fluid" src=` + data[i].image + `>
                                    <div class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                                        <ul class="list-unstyled">
                                            <li><a class="btn btn-success text-white mt-2" href="shop-single.html"><i class="far fa-eye"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <a href="shop-single.html" class="h3 text-decoration-none">` + data[i].name + `</a>
                                    <p class="text-center mb-0">$` + data[i].price +`</p>
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
    }
}