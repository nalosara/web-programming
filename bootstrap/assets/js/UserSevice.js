var UserService = {
    init: function () {
      var token = localStorage.getItem("user_token");
      if (token) {
        window.location.replace("index.html");
      }
      $("#login-form").validate({
        submitHandler: function (form, validator) {
          var entity = {
            email : $("#email_login").val(),
            password : $("#password_login").val(),
          }
          UserService.login(entity);
        },
      });
      $("#signup-form").validate({
        submitHandler: function (form) {
            var entity = {
                email : $("#email_signup").val(),
                password : $("#password_signup").val(),
                full_name : $("#full_name").val(),
                phone : $("#phone").val(),
              }
          UserService.signup(entity);
        },
      });
    },
    login: function (entity) {
        console.log(entity);
      $.ajax({
        url: "rest/login",
        type: "POST",
        data: JSON.stringify(entity),
        contentType: "application/json",
        dataType: "json",
        success: function (result) {
          localStorage.setItem("user_token", result.token);
          window.location.replace("index.html");
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
           
          toastr.error(XMLHttpRequest.responseJSON.message);
        },
      });
    },

    signup: function (entity) {
        $.ajax({
          url: "rest/signup",
          type: "POST",
          data: JSON.stringify(entity),
          contentType: "application/json",
          dataType: "json",
          success: function (result) {
            localStorage.setItem("user_token", result.token);
            window.location.replace("index.html");
          },
          error: function (XMLHttpRequest, textStatus, errorThrown) {
            toastr.error(XMLHttpRequest.responseJSON.message);
          },
        });
      },
  
    logout: function () {
      localStorage.clear();
      window.location.replace("register.html");
    },

    addAdress: function(entity){
      $.ajax({
        url: "rest/adresses",
        type: "POST",
        data: JSON.stringify(entity),
        contentType: "application/json",
        dataType: "json",
        success: function (result) {
          toastr.success('Address has been added to your account successfully.');
          localStorage.setItem("user_token", result.token);
          window.location.replace("index.html");
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
          toastr.error("Error! Address has not been added to your account.");
        },
      });
    },

    getUserData: function(user_id) {
      $.ajax({
        url: "rest/users/" + user_id,
        type: "GET",
        contentType: "application/json",
        dataType: "json",
        success: function(data) {
          var html = '';
          html += `<br>
                    <div class="col"> 
                      <div class="row align-items-center">
                        <div class="col" style="font-size: 24px; font-weight: bold;">
                          <p style="width: auto" class="mb-0">Hello ${data[0].name}!</p>
                        </div>
                        <div class="col">
                          <button type="button" onclick="UserService.logout()" class="btn btn-success">Logout</button>
                        </div>
                      </div>
                      <br>
                      <br>
                    </div>`;
              if (data[0].authorization == "unauthorized") {
                UserService.getUserAddresses(data[0].id, function(userAddressesHtml) {
                  html += userAddressesHtml;
                  UserService.getUserOrders(data[0].id, function(userOrdersHtml) {
                    html += userOrdersHtml;
                    $("#UserContainer").html(html);
                    $("#UserContainer").css({ "display": "block" });
                  });
                });
          } else {
            $("#UserContainer").html(html);
            $("#UserContainer").css({ "display": "block" });
          }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
          toastr.error("Error! User could not be fetched.");
        },
      });
    },
    
    getUserOrders: function(user_id, callback) {
      $.ajax({
        url: "rest/orders_by_user_id/" + user_id,
        type: "GET",
        contentType: "application/json",
        dataType: "json",
        success: function(data) {
          var html = `<div class="col"> 
            <div class="col" style="font-size: 24px; font-weight: bold;">
                Your Past Orders
            </div>`;
          for (var i = 0; i < data.length; i++) {
            html += `<div class="row">
              <div class="card mb-4 rounded-0">
                  <div>
                      <div class="col">
                          <p style="width: 200px" class="mb-0">Order Date: ` + data[i].order_date + `</p>
                          <p style="width: auto" class="mb-0">Products Purchased:` + data[i].products_bought + `</p>
                      </div>
                  </div>
              </div>
          </div>`;
          }
          html += '</div>';
          callback(html);
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
          toastr.error("Error! User orders could not be fetched.");
        },
      });
    },

    getUserAddresses: function(user_id, callback) {
      $.ajax({
        url: "rest/addresses_by_user_id/" + user_id,
        type: "GET",
        contentType: "application/json",
        dataType: "json",
        success: function(data) {
          var html = `<div class="col"> 
                    <div class="col" style="font-size: 24px; font-weight: bold;">
                        Your Addresses
                    </div>
                  </div>
                  <button style="width: auto" type="button" onclick="showAddAddressDialog(${user_id})" class="btn btn-success">Add Address</button>
                  <br>
                  <br>
                </div>
            </div>`;
          for (var i = 0; i < data.length; i++) {
            html += `<div class="row">
              <div class="card mb-4 rounded-0">
                  <div class="row align-items-center">
                      <div class="col">
                          <p style="width: auto" class="mb-0">Address Name: ` + data[i].alias + `</p>
                      </div>
                      <div class="col">
                          <p style="width: auto" class="mb-0">Steet: ` + data[i].street + `</p>
                      </div>
                      <div class="col">
                          <p style="width: auto" class="mb-0">Zip Code: ` + data[i].zip_code + `</p>
                      </div>
                      <div class="col">
                          <p style="width: auto" class="mb-0">Country: ` + data[i].country + `</p>
                      </div>
                      <div class="col">
                          <p style="width: auto" class="mb-0">City: ` + data[i].city + `</p>
                      </div>
                      <div class="col">
                        <button style="width: 200px" type="button" onclick="showEditAddresDialog(`+ data[i].id +`)" class="btn btn-success">Edit Address</button>
                        <button style="width: 200px" type="button" onclick="UserService.deleteAddress(`+ data[i].id +`)" class="btn btn-success">Delete Address</button>
                      </div>
                  </div>
              </div>
          </div>
          <br>`;
          }
          html += '</div>';
          callback(html);
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
          toastr.error("Error! User orders could not be fetched.");
        },
      });
    },

    addUserAddress: function(){
      $("#addAddressForm").validate({
        submitHandler: function (form, validator) {
            data = {
            alias: $("#add_address_alias").val(),
            street: $("#add_address_street").val(),
            zip_code: $("#add_address_zip_code").val(),
            country: $("#add_address_country").val(),
            city: $("#add_address_city").val(),
            user_id: $("#add_address_user_id").val(),
            };
            console.log(data);
            $.ajax({
            url: "rest/addresses",
            type: "POST",
            data: JSON.stringify(data),
            contentType: "application/json",
            dataType: "json",
            success: function (result) {
                toastr.success("Address has been added successfully");
                $("#addAddressModal").modal("toggle");
                ChangeTab.goToUserPage(localStorage.getItem('user_token'));
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                toastr.error("Error! Address has not been added.");
            },
            });
        },
    });
    },

    editUserAddress: function(id){
      $("#editAddressForm").validate({
        submitHandler: function (form, validator) {
            data = {
            alias: $("#edit_address_alias").val(),
            street: $("#edit_address_street").val(),
            zip_code: $("#edit_address_zip_code").val(),
            country: $("#edit_address_country").val(),
            city: $("#edit_address_city").val()
            };
            $.ajax({
            url: "rest/addresses/" + $("#edit_address_id").val(),
            type: "PUT",
            data: JSON.stringify(data),
            contentType: "application/json",
            dataType: "json",
            success: function (result) {
                toastr.success("Address has been updated successfully");
                $("#editAddressModal").modal("toggle");
                ChangeTab.goToUserPage(localStorage.getItem('user_token'));
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                toastr.error("Error! Address has not been updated.");
            },
            });
        },
      });
    },

    deleteAddress: function(id){

      $.ajax({
          url: 'rest/addresses/' + id,
          method: "DELETE",
          contentType: "application/json",
        
  
          success: function (result) {
              toastr.success("Address has been deleted successfully");
              ChangeTab.goToUserPage(localStorage.getItem('user_token'));
          },
          error: function (XMLHttpRequest, textStatus, errorThrown) {
              toastr.error("Error! Address has not been deleted.");
          },
      });

  }

};