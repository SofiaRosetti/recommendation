<html>
  <head>
    <meta charset="UTF-8">
    <script src="jquery-3.3.1.js"></script>

    <!-- <link rel="stylesheet" type="text/css" href="style.css"> -->
    <title>Tesi</title>
  </head>

  <body>
    <div>
      <h2>Recommendations algorithms</h2>
    </div>
    <div>
      <label for="algorithms">Select algorithm:</label>
      <select id="algorithms" name="algorithms">
        <option value="1">Collaborative item-based</option>
        <option value="2">Collaborative user-based</option>
        <option value="3">Knowledge-based</option>
        <option value="4">Hybrid item-based and knowledge-based</option>
        <option value="5">Hybrid user-based and knowledge-based</option>
      </select>
    </div>
    <br /><br />
    <div>
      <label for="users">Select user:</label>
      <select id="users" name="users">
      </select>
    </div>
    <br /><br />
    <div id="item_div">
      <label for="items">Select service:</label>
      <select id="items" name="item">
      </select>
    </div>
    <br /><br />
    <div>
      <button id="submit_button" type="button" onclick="">Get recommendations</button>
    </div>
    <div id="rec_div">
      <ul>

      </ul>
    </div>

    <script>
      $(document).ready(function(){

        $.ajax({
         type: "POST",
         url: "get_users.php",
         data: "",
         success: function(msg)
         {
           // console.log(msg);
            updateUsers(JSON.parse(msg));
         },
         error: function(msg) {
           console.log(msg);
         }
        });

        $.ajax({
         type: "POST",
         url: "get_services.php",
         data: "",
         success: function(msg)
         {
           // console.log(msg);
            updateServices(JSON.parse(msg));
         },
         error: function(msg) {
           console.log(msg);
         }
        });

       function updateUsers(msg) {
         msg.forEach(function(item) {
           // console.log(item['id_utente']);
           var list = document.getElementById("users");
           var option = document.createElement("option");
           option.text = item['id_utente'];
           list.add(option);
         });
       }

       function updateServices(msg) {
         msg.forEach(function(item) {
           // console.log(item['id_servizio']);
           var list = document.getElementById("items");
           var option = document.createElement("option");
           option.text = item['id_servizio'];
           list.add(option);
         });
       }

      var alg = null;
      var user = null;
      var item = null;
      var myUrl = null;
      $("#submit_button").click(function() {
        user = $('#users').val();
        item = $('#items').val();
        alg = $('#algorithms').val();
        console.log(alg);
        console.log(user);
        console.log(item);

        switch (alg) {
          case "1":
            myUrl = "get_item_based.php"
            break;
          case "2":
            myUrl = "get_user_based.php"
            break;
          case "3":
            myUrl = "get_knowledge_based.php"
            break;
          case "4":
            myUrl = "get_item_knowledge_based.php"
            break;
          case "5":
            myUrl = "get_user_knowledge_based.php"
            break;
          default:
            myUrl = ""
        }

        var json_data = {
          "id_utente" : user,
          "id_servizio" : item
        }
        $.ajax({
         type: "POST",
         url: myUrl,
         data: json_data,
         success: function(msg)
         {
           console.log(msg);
         },
         error: function(msg) {
           console.log(msg);
         }
       });
      });
    });


    </script>

  </body>
</html>
