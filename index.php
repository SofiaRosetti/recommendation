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
        <option value="item">Collaborative item-based</option>
        <option value="user">Collaborative user-based</option>
        <option value="knowledge">Knowledge-based</option>
        <option value="item-knowledge">Hybrid item-based and knowledge-based</option>
        <option value="user-knowledge">Hybrid user-based and knowledge-based</option>
      </select>
    </div>
    <br /><br />
    <div>
      <label for="users">Select user:</label>
      <select id="users" name="users">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
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
        var user = null;
        var users_id_list = null;
        $("#submit_button").click(function() {
          user = $('#users').val();
          console.log(user);
          var json_data = {
            "id_utente" : user
          }
          $.ajax({
           type: "POST",
           url: "get_item_based.php",
           data: json_data,
           success: function(msg)
           {
             console.log(msg);
             users_id_list = msg;   // ORA HO GLI ID DEGLI UTENTI
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
