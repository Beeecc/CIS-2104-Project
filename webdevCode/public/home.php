<?php
//1. Session code here
  session_start();
?>
<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="../src/css/main.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <title>Todo List Home</title>
  <style>
    main {
      position: relative;
      height: 100vh;
      width: 100%;
    }

    .content {
      position: absolute;
      height: 100%;
      width: 100%;
      right: 0;
      background-color: white;
      overflow-y: scroll;
    }

    aside {
      position: absolute;
      height: 100%;
      width: 20%;
      left: 0;
      background-color: #3598dc;
    }

    * {
      color: black;
    }

    .card {
      width: 18rem;
      display: inline-block;
      margin: 2px;
    }

    .icons {
      float: right;
      padding-bottom: 10px;
    }

    .pad {
      padding-left: 5px;
    }
  </style>
</head>

<body onload="ready()">
  <div>
    <main>
      <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #3598dc;">
        <a class="navbar-brand" href="#" style="color: white;">To Do List</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active" style="color: white;">
              <?php echo $_SESSION["user_name"]; ?>
            </li>
          </ul>

          <button name="btnsignout" class="btn btn-secondary btn-lg" onclick="signoutClick(event)">Sign Out</button>
        </div>
      </nav>
      <div class="content">
        <center>
          <div class="modal-body">
            <form id="addItemForm" method="post" onsubmit="addItem(event)">
              <div class="form-group">
                <label>Item name</label>
                <input required type="text" class="form-control" id="item_name" name="item_name" />
              </div>
              <div class="form-group">
                <label>Item description</label>
                <textarea required class="form-control" id="item_description" name="item_description" rows="3" maxlength="240"></textarea>
              </div>
              <button type="submit" class="btn btn-primary">Add To Do Item</button>
            </form>
          </div>
        </center>
        <div style="padding-left: 20px; padding-right: 20px;">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="active-tab" data-toggle="tab" href="#active" role="tab" aria-controls="active" aria-selected="true" onclick="activeClicked()">Active</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="inactive-tab" data-toggle="tab" href="#inactive" role="tab" aria-controls="inactive" aria-selected="false" onclick="inactiveClicked()">Inactive</a>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" role="tabpanel" aria-labelledby="active-tab">
              <div id="activeCards">
                <!-- active cards are displayed inside here -->

              </div>
            </div>
            <div class="tab-pane fade" role="tabpanel" aria-labelledby="inactive-tab">
              <div id="inactiveCards">
                <!-- inactive cards are displayed inside here -->

              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

    <!-- Item Edit Modal -->
    <div class="modal fade" id="itemModal" tabindex="-1" role="dialog" aria-labelledby="itemModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="itemModalLabel">Edit Item</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form id="editItemForm" method="post" onsubmit="editItem(event)">
            <div class="modal-body">

              <div class="form-group">
                <label>Item name</label>
                <input required type="text" class="form-control" id="item_name_edit" name="item_name_edit" maxlength="50" />
              </div>
              <div class="form-group">
                <label>Item description</label>
                <textarea required class="form-control" id="item_description_edit" name="item_description_edit" rows="3" maxlength="240"></textarea>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Edit Item</button>
            </div>
          </form>
        </div>
      </div>
    </div>

  </div>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script type="text/javascript">
    var userID = <?php echo $_SESSION["user_id"]; ?>;
    var xhttp = new XMLHttpRequest();
    var tabClicked = 0; //0 - active, 1 - inactive
    var selectedItemID = -1;

    function addCard(id, title, content) { // Displaying purposes
      $("#activeCards").append('         <div class="card">\
          <div class="card-body">\
            <h5 class="card-title">' + title + '</h5>\
              <p class="card-text">' + content + '</p>\
              <div class="icons"><i class="pad fa-solid fa-pause" onclick="changeStatusItem(' + id + ')"></i><i class="pad fa-solid fa-pen-to-square" onclick="openEditItem(' + id + ',\'' + title + '\',\'' + content + '\')"></i><i class="pad fa-solid fa-trash" onclick="deleteItem(' + id + ')"></i></div>\
            </div>\
        </div>');
    }

    function removeAllCards() {
      $("#activeCards").empty();
      console.log("Test");
    }


    function addItem(e) {
      e.preventDefault();
      var data = $("#addItemForm").serialize();
      var url = "../src/php/addItem_action.php";
      var urlData = url + "?" + data + "&user_id=" + userID;
      xhttp.open("POST", urlData, true);
      xhttp.send();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          var res = JSON.parse(this.responseText);
          if (res["status"] == 200) {
            getItems();
            $("#addItemForm")[0].reset();
          }
        }
      };
    }

    function ready() {
      getItems(true);
    }

    function getItems(isActive = tabClicked === 0) {
      removeAllCards();
      var url = "../src/php/getItems_action.php";
      var urlData = url + "?user_id=" + userID + "&status=" + (isActive ? "active" : "inactive");
      xhttp.open("GET", urlData, true);
      xhttp.send();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          var res = JSON.parse(this.responseText);
          if (res["status"] == 200) {
            for (var i = 0; i < res["count"]; i++) {
              addCard(res["data"][i]["item_id"], res["data"][i]["item_name"], res["data"][i]["item_description"]);
            }
          }
        }
      };
    }

    function activeClicked() {
      tabClicked = 0;
      getItems(true);
    }

    function inactiveClicked() {
      tabClicked = 1;
      getItems(false);
    }

    function deleteItem(id) {
      var url = "../src/php/deleteItem_action.php";
      var urlData = url + "?item_id=" + id;
      xhttp.open("POST", urlData, true);
      xhttp.send();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          getItems();
        }
      };
    }

    function changeStatusItem(id) {
      var url = "../src/php/statusItem_action.php";
      var urlData = url + "?item_id=" + id + "&status=" + (tabClicked === 0 ? 'inactive' : 'active');
      xhttp.open("POST", urlData, true);
      xhttp.send();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          var res = JSON.parse(this.responseText);
          alert(res["message"]);
          if (res["status"] == 200) {
            getItems();
          }
        }
      };
    }

    function openEditItem(id, name, desc) {
      selectedItemID = id;
      $("#itemModal").modal('show');
      document.getElementById("item_name_edit").value = name;
      document.getElementById("item_description_edit").value = desc;
    }

    function editItem(e) {
      e.preventDefault();
      var data = $("#editItemForm").serialize();
      var url = "../src/php/editItem_action.php";
      var urlData = url + "?" + data + "&item_id=" + selectedItemID;
      xhttp.open("POST", urlData, true);
      xhttp.send();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          console.log(this.responseText);
          var res = JSON.parse(this.responseText);
          // alert(res["message"]);
          $("#itemModal").modal('hide');
          if (res["status"] == 200) {
            getItems();
          }
        }
      };
    }
  </script>
  <script type="text/javascript" src="../src/js/auth.js"></script>
</body>
</html>