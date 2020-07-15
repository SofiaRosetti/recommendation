<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <script src="jquery-3.3.1.js"></script> -->

    <title>Recommendation Algorithms</title>
		<link rel="stylesheet" href="css/bootstrap.css">
		<link rel="stylesheet" href="css/style.css">
    <script src="js/jquery.min.js"></script>
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.0/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.0/js/bootstrap-toggle.min.js"></script>

  </head>

  <body>
    <!-- <div id="title">
      <h2>Recommendation Algorithms</h2>
    </div>
    <div id="select_div">
      <div>
        <label class="label_select" for="algorithms">Select algorithm:</label>
        <select id="algorithms" name="algorithms">
          <option value="1">Collaborative item-based</option>
          <option value="2">Collaborative user-based</option>
          <option value="3">Knowledge-based</option>
          <option value="4">Hybrid item-based and knowledge-based</option>
          <option value="5">Hybrid user-based and knowledge-based</option>
        </select>
      </div>
      <br /><br />
      <div class="num">
        <label class="label_select" for="users">Select user:</label>
        <select id="users" name="users">
        </select>
      </div>
      <br /><br />
      <div id="item_div" class="num">
        <label class="label_select" for="items">Select service:</label>
        <select id="items" name="item">
        </select>
      </div>
    </div>

    <br /><br />
    <div id="btn_div">
      <button id="submit_button" type="button" onclick="">Get recommendations</button>
    </div>
    <div id="rec_div">
      <ul>

      </ul>
    </div> -->

    <header>
			<div id="tit" class="text-center h1">Recommendation Algorithms</div>
		</header>
		<div class="container ext">

			<div class="row">
				<div class="col-sm-12">
					<div id="accordion">
						<div class="card">
							<div class="card-header" id="headingOne">
								<h5 class="mb-0">
									<button id="btn1" class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
									Collaborative item-based
									</button>
								</h5>
							</div>

							<div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
								<div class="card-body">
									<div class="row">
										<div class="col-sm-4 d-flex flex-row">
											<select id="sel1" class="select_user form-control form-control-sm">
											  <option selected>Select user</option>

											</select>
											<div class="container">
												<div class="text-right">
													<button id="button1" class="btn btn-primary mybtn" type="button">GO!</button>
												</div>
											</div>

										</div>
										<div id="spinner1" class="spinner-grow" role="status" style="display: none; height: 100px">
											<span class="sr-only">Loading...</span>
										</div>
										<div id="result1" class="col-sm-8 overflow-auto" style="max-height: 100px; height: 100px">

											I servizi raccomandati per l'utente sono:<br/>

										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<div id="accordion">
						<div class="card">
							<div class="card-header" id="headingTwo">
								<h5 class="mb-0">
									<button id="btn2" class="btn btn-link" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
									Collaborative user-based
									</button>
								</h5>
							</div>

							<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
								<div class="card-body">
									<div class="row">
										<div class="col-sm-4 d-flex flex-row">
											<select id="sel2" class="select_user form-control form-control-sm">
											  <option>Select user</option>
											</select>
											<div class="container">
												<div class="text-right">
													<button id="button2" class="btn btn-primary mybtn" type="button">GO!</button>
												</div>
											</div>
										</div>
										<div class="col-sm-8">
											<div id="spinner1" class="spinner-grow" role="status" style="display: none; height: 100px">
												<span class="sr-only">Loading...</span>
											</div>
											<div>Risultati:</div>
											<div id="result2" class="overflow-auto" style="max-height: 100px; height: 100px">
												I servizi raccomandati per l'utente sono:<br/>

											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<div id="accordion">
						<div class="card">
							<div class="card-header" id="headingTwo">
								<h5 class="mb-0">
									<button id="btn3" class="btn btn-link" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
									Knowledge-based
									</button>
								</h5>
							</div>

							<div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
								<div class="card-body">
									<div class="row">
										<div class="col-sm-4 d-flex flex-row">
											<select id="sel3" class="select_user form-control form-control-sm">
											  <option selected>Select user</option>

											</select>
											<div class="container">
												<div class="text-right">
													<button id="button3" class="btn btn-primary mybtn" type="button">GO!</button>
												</div>
											</div>
										</div>
										<div class="col-sm-8">
											<div id="spinner1" class="spinner-grow" role="status" style="display: none; height: 100px">
												<span class="sr-only">Loading...</span>
											</div>
											<div id="result3" class="overflow-auto" style="max-height: 100px; height: 100px">
												I servizi raccomandati per l'utente sono:<br/>
												<!-- <div class="d-flex justify-content-start"> -->
												<!-- <div class="item"><b>servizio:</b> 2</div>
												<div class="item cat"><b>categoria:</b> Sport</div><br/> -->
												<!-- </div> -->
												<!-- <div class="d-flex justify-content-start">
												<div class="item"><b>servizio:</b> 10</div>
												<div class="item cat"><b>categoria:</b> Sport</div><br/>
												</div>
												<div class="d-flex justify-content-start">
												<div class="item"><b>servizio:</b> 17</div>
												<div class="item cat"><b>categoria:</b> Alloggio</div><br/>
												</div> -->

											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<div id="accordion">
						<div class="card">
							<div class="card-header" id="headingTwo">
								<h5 class="mb-0">
									<button id="btn4" class="btn btn-link" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
									Hybrid item-based and knowledge-based
									</button>
								</h5>
							</div>

							<div id="collapseFour" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
								<div class="card-body">
									<div class="row">
										<div class="col-sm-4 d-flex flex-row">
											<select id="sel4" class="select_user form-control form-control-sm">
											  <option>Select user</option>
											</select>
											<div class="container">
												<div class="text-right">
													<button id="button4" class="btn btn-primary mybtn" type="button">GO!</button>
												</div>
											</div>
										</div>
										<div class="col-sm-8">
											<div id="spinner1" class="spinner-grow" role="status" style="display: none; height: 100px">
												<span class="sr-only">Loading...</span>
											</div>
											<div>Risultati:</div>
											<div id="result4" class="overflow-auto" style="max-height: 100px; height: 100px">
												I servizi raccomandati per l'utente sono:<br/>

											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<div id="accordion">
						<div class="card">
							<div class="card-header" id="headingTwo">
								<h5 class="mb-0">
									<button id="btn5" class="btn btn-link" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
									Hybrid user-based and knowledge-based
									</button>
								</h5>
							</div>

							<div id="collapseFive" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
								<div class="card-body">
									<div class="row">
										<div class="col-sm-4 d-flex flex-row">
											<select id="sel5" class="select_user form-control form-control-sm">
											  <option>Select user</option>
											</select>
											<div class="container">
												<div class="text-right">
													<button id="button5" class="btn btn-primary mybtn" type="button">GO!</button>
												</div>
											</div>
										</div>
										<div class="col-sm-8">
											<div id="spinner1" class="spinner-grow" role="status" style="display: none; height: 100px">
												<span class="sr-only">Loading...</span>
											</div>
											<div>Risultati:</div>
											<div id="result5" class="overflow-auto" style="max-height: 100px; height: 100px">
												I servizi raccomandati per l'utente sono:<br/>

											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
  </body>


  <script>


  $(() => {



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

    var count1 = 0;
    $("#btn1").click(function(){
      if(count1%2==0) {
        $('#collapseOne').show();
      } else {
        $('#collapseOne').hide();
      }
      count1 ++;
    })

    var count2 = 0;
    $("#btn2").click(function(){
      if(count2%2==0) {
        $('#collapseTwo').show();
      } else {
        $('#collapseTwo').hide();
      }
      count2 ++;
    })

    var count3 = 0;
    $("#btn3").click(function(){
      if(count3%2==0) {
        $('#collapseThree').show();
      } else {
        $('#collapseThree').hide();
      }
      count3 ++;
    })

    var count4 = 0;
    $("#btn4").click(function(){
      if(count4%2==0) {
        $('#collapseFour').show();
      } else {
        $('#collapseFour').hide();
      }
      count4 ++;
    })

    var count5 = 0;
    $("#btn5").click(function(){
      if(count5%2==0) {
        $('#collapseFive').show();
      } else {
        $('#collapseFive').hide();
      }
      count5 ++;
    })

    $("#button1").click(function(){
      startComputing(1);
    })
    $("#button2").click(function(){
      startComputing(2);
    })
    $("#button3").click(function(){
      startComputing(3);
    })
    $("#button4").click(function(){
      startComputing(4);
    })
    $("#button5").click(function(){
      startComputing(5);
    })
  });
  function startComputing(type){
    var id_us = "#sel".concat(type);
    var user = $(id_us).val();
    var json_data = null;
    var myUrl = null;
    switch (type) {
          case 1:

            myUrl = "get_item_knowledge_based.php";
            json_data = {
              "id_utente" : user,
              "id_servizio" : "",
              "knowledge" : 0
            }
            break;
          case 2:
            myUrl = "get_user_knowledge_based.php";
            json_data = {
              "id_utente" : user,
              "id_servizio" : "",
              "knowledge" : 0
            }
            break;
          case 3:
            myUrl = "get_knowledge_based.php";
            json_data = {
              "id_utente" : user,
              "id_servizio" : "",
              "knowledge" : 1
            }
            break;
          case 4:
            myUrl = "get_item_knowledge_based.php";
            json_data = {
              "id_utente" : user,
              "id_servizio" : "",
              "knowledge" : 1
            }
            break;
          case 5:
            myUrl = "get_user_knowledge_based.php";
            var k = 1;
            json_data = {
              "id_utente" : user,
              "id_servizio" : "",
              "knowledge" : k
            }
            break;
          default:
            myUrl = ""
        }

        $.ajax({
             type: "POST",
             url: myUrl,
             data: json_data,
             success: function(msg)
             {
               console.log(msg);
               var str1 = "#result";
               var res = str1.concat(type);
               // console.log(res);


               // var res = document.getElementById("rec_div");
               // var newDiv = document.createElement("div");
               // newDiv.innerHTML = msg;
               // res.appendChild(newDiv);
               var categories = ["Evento", "Itinerario culturale e museale permanente", "Guida turistica", "Alloggio", "Associazione o ente", "Sport", "Struttura turistica", "Trasporto privato", "Negozio", "Ristorazione"]
               var myArr = JSON.parse(msg);
               $(res).html("");
               $.each( myArr, function( key, value ) {
                 var cat_index = Math.floor(Math.random() * 10);
                 var div_cat = document.createElement("div");
                 div_cat.classList.add("item");
                 div_cat.classList.add("cat");
                 var b = document.createElement("B");
                 var textnode3 = document.createTextNode("Categoria: ");
                 b.appendChild(textnode3);
                 var textnode4 = document.createTextNode(categories[cat_index]);
                 div_cat.appendChild(b);
                 div_cat.appendChild(textnode4);
                // alert( key + ": " + value );
                console.log(value);
                var ext_div = document.createElement("div");
                // ext_div.css("class","d-flex justify-content-start");
                ext_div.classList.add("d-flex");
                ext_div.classList.add("justify-content-start");
                var div_item = document.createElement("div");
                div_item.classList.add("item");
                var b = document.createElement("B");
                var textnode1 = document.createTextNode("Servizio: ");
                b.appendChild(textnode1);
                var textnode2 = document.createTextNode(value);
                div_item.appendChild(b);
                div_item.appendChild(textnode2);
                ext_div.appendChild(div_item);
                ext_div.appendChild(div_cat);
                $(res).append(ext_div);
              });
               // console.log(msg);
             },
             error: function(msg) {
               console.log(msg);
             }
           });
  }
  function updateUsers(msg) {
       msg.forEach(function(item) {
         // console.log(item['id_utente']);
         var option = document.createElement("option");
         option.text = item['id_utente'];
         $( ".select_user" ).append(option);
         $("[data-toggle='toggle']").bootstrapToggle('destroy')
         $("[data-toggle='toggle']").bootstrapToggle();
       });
     }





  //   $(document).ready(function(){
  //
  //     $.ajax({
  //      type: "POST",
  //      url: "get_users.php",
  //      data: "",
  //      success: function(msg)
  //      {
  //        // console.log(msg);
  //         updateUsers(JSON.parse(msg));
  //      },
  //      error: function(msg) {
  //        console.log(msg);
  //      }
  //     });
  //
  //     // $.ajax({
  //     //  type: "POST",
  //     //  url: "get_services.php",
  //     //  data: "",
  //     //  success: function(msg)
  //     //  {
  //     //    // console.log(msg);
  //     //     updateServices(JSON.parse(msg));
  //     //  },
  //     //  error: function(msg) {
  //     //    console.log(msg);
  //     //  }
  //     // });
  //
  //    function updateUsers(msg) {
  //      msg.forEach(function(item) {
  //        // console.log(item['id_utente']);
  //        var option = document.createElement("option");
  //        option.text = item['id_utente'];
  //        $( ".select_user" ).add(option);
  //      });
  //    }
  //
  //    // function updateServices(msg) {
  //    //   msg.forEach(function(item) {
  //    //     // console.log(item['id_servizio']);
  //    //     var list = document.getElementById("items");
  //    //     var option = document.createElement("option");
  //    //     option.text = item['id_servizio'];
  //    //     list.add(option);
  //    //   });
  //    // }
  //
  //   var alg = null;
  //   var user = null;
  //   var item = null;
  //   var myUrl = null;
  //   $("#submit_button").click(function() {
  //     user = $('#users').val();
  //     item = $('#items').val();
  //     alg = $('#algorithms').val();
  //     // console.log(alg);
  //     // console.log(user);
  //     // console.log(item);
  //
  //     var json_data = null;
  //
  //     switch (alg) {
  //       case "1":
  //         myUrl = "get_item_knowledge_based.php";
  //         json_data = {
  //           "id_utente" : user,
  //           "id_servizio" : item,
  //           "knowledge" : 0
  //         }
  //         break;
  //       case "2":
  //         myUrl = "get_user_knowledge_based.php";
  //         json_data = {
  //           "id_utente" : user,
  //           "id_servizio" : item,
  //           "knowledge" : 0
  //         }
  //         break;
  //       case "3":
  //         myUrl = "get_knowledge_based.php";
  //         json_data = {
  //           "id_utente" : user,
  //           "id_servizio" : item,
  //           "knowledge" : 1
  //         }
  //         break;
  //       case "4":
  //         myUrl = "get_item_knowledge_based.php";
  //         json_data = {
  //           "id_utente" : user,
  //           "id_servizio" : item,
  //           "knowledge" : 1
  //         }
  //         break;
  //       case "5":
  //         myUrl = "get_user_knowledge_based.php";
  //         var k = 1;
  //         json_data = {
  //           "id_utente" : user,
  //           "id_servizio" : item,
  //           "knowledge" : k
  //         }
  //         break;
  //       default:
  //         myUrl = ""
  //     }
  //
  //
  //     $.ajax({
  //      type: "POST",
  //      url: myUrl,
  //      data: json_data,
  //      success: function(msg)
  //      {
  //        var res = document.getElementById("rec_div");
  //        var newDiv = document.createElement("div");
  //        newDiv.innerHTML = msg;
  //        res.appendChild(newDiv);
  //        console.log(msg);
  //      },
  //      error: function(msg) {
  //        console.log(msg);
  //      }
  //    });
  //   });
  // });


  </script>

</html>
