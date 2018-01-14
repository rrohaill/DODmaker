<?php
	include 'sql_functions.php';
	include 'index_onload.php';

  session_start();
  if(!isset($_SESSION['login_user'])){
  header("location: login.php");
  }

  add_dod_item_modal();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>SB Admin - Start Bootstrap Template</title>
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  <!-- Bootstrap CSS -->
  <link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
  <!-- Bootstrap.min CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <script type="text/javascript">
      var sentence_dictionary = [];
      var current_selected_element;
      var selected_text;

      function escapehtml(input_text){
        var res = input_text.replace(/&lt;/g, "<");
        res = res.replace(/&gt;/g, ">");
        return res;
      }

      function update_textbox(input){
        console.log(input);
      }

      function update(option,inputvalue){
        var input_checkbox1;
        var input_checkbox2;
        if (option == 0)
        {
          selected_text = "All " + document.getElementById("select111").value + " are done";
        }
        else if (option == 1)
        {
          if (document.querySelector('.checkbox1').checked)
            input_checkbox1 = document.querySelector('.checkbox1').value + " ";
          else input_checkbox1 = "";
          selected_text = document.getElementById("select1211").value + " " + input_checkbox1 + document.getElementById("select122").value;
        }
        else if (option == 2)
        {
          if (document.getElementById("select131").value.includes("<Scope")){
            selected_text = document.getElementById("select1311").value + " has unit tests.";
          }
          else {
            selected_text = document.getElementById("select131").value + " has unit tests.";
          }
        }
        else if (option == 3)
        {
          selected_text = "Tasks describing identified technical debt are added";
        }
        else if (option == 4)
        {
          if (document.getElementById("select151").value.includes("<name>")){
            selected_text = document.getElementById("select1511").value + " is " + document.getElementById("select152").value + " to the repository.";
          }
          else{
           selected_text = document.getElementById("select151").value + " is " + document.getElementById("select152").value + " to the repository.";
          }
        }
        else if (option == 5)
        {
          if (document.querySelector('.checkbox2').checked)
            input_checkbox1 = document.querySelector('.checkbox2').value + " ";
          else input_checkbox1 = "";

          if (document.querySelector('.checkbox3').checked)
            input_checkbox2 = document.querySelector('.checkbox3').value + " ";
          else input_checkbox2 = "";

          if (document.getElementById("select161").value.includes("<name>")){
            selected_text = "Code has been reviewed by " + document.getElementById("select1611").value + " " + input_checkbox1 + "and all suggestions has been introduced " + input_checkbox2;
          }
          else{
            selected_text = "Code has been reviewed by "+document.getElementById("select161").value + " " + input_checkbox1 + "and all suggestions has been introduced " + input_checkbox2;
          }
        }
        document.getElementById(inputvalue.id).value = escapehtml(selected_text);
      }

      function create_dictionary(option){
        sentence_dictionary.push(escapehtml(option));
      }

      function current_element(option){
        current_selected_element = escapehtml(option);
      }

      function update_sentence(option,place,dropdown){
        if (dropdown.nextSibling.type === "text")
          document.getElementById(dropdown.id+"1").remove();
        if (dropdown.value.includes("<")){
            $('<input type="text" size="10" class="custom_text_box" id='+dropdown.id+'1 >' ).insertAfter( "#" + dropdown.id ); 
        }
        else
          sentence_dictionary[place] = sentence_dictionary[place].replace(current_selected_element, option);
      }

      function log_items(option){
        console.log(option);
      }



    </script>
</head>

<body class="fixed-nav sticky-footer bg-dark" style="padding-top: 0px;" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.html">Dod Maker</a>
    <div>
      <p style="color: white;"><?php echo "User: ".$_SESSION['login_user']; ?></p>
      <form action="login_process.php" method="POST">
        <button type="submit" class="btn btn-outline-white" value="Submit" name="user_logout">Log Out</button>
      </form>
    </div>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="index.php">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Dashboard</span>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
    </div>
  </nav>

  <div class="content-wrapper">

    <div class="container">

    	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addChecklistModal">
    		<i class="glyphicon glyphicon-plus"></i>
        <span class="nav-link-text">Add DoD</span>
		  </button>

      <form action="/indexbackend.php" method="POST">
        <button type="submit" class="btn btn-primary" value="Submit" name="exportdod">
          <i class="glyphicon glyphicon-plus"></i>
          <span class="nav-link-text">Export DoD</span>
        </button>
      </form>

    	<table class="table">
    		<thead>
    			<tr>
    				<td>Name</td>
    				<td>No. of DoD Items</td>
    				<td>Actions</td>
    			</tr>
    		</thead>
    		<tbody>
    		<?php
        $id_person = $_SESSION['id_user'];
    		$results = execute_sql_function("SELECT * FROM checklist WHERE id_person = $id_person");
    		while($row = $results->fetch_assoc())
        {
        	delete_dod_modal($row['id_checklist']);
		      modify_dod_modal($row['id_checklist'],$row['checklist_name']);

        	echo '
        	<tr>
        		<td>
        		  <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti'.$row['id_checklist'].'">
                <i class="glyphicon glyphicon-chevron-down"></i>'.$row['checklist_name'].'
      			  </a>
			      </td>
            <td>'.return_dod_items_number($row['id_checklist']).'</td>
            <td>
    				  <a data-toggle="modal" href="#deleteChecklistModal'.$row['id_checklist'].'">Delete</a> | 
    				  <a data-toggle="modal" href="#modifyChecklistModal'.$row['id_checklist'].'">Modify</a>
    		    </td>
				  </tr>
				<tr style="background-color: WhiteSmoke;">
          <td colspan="3" style="border-top:0px; padding:0px;">
						<div id="collapseMulti'.$row['id_checklist'].'" class="collapse">

							<!--Dropdown Content-->
					    <b>DoD Items</b>
					    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addQuestionModal'.$row['id_checklist'].'">
					    	<i class="glyphicon glyphicon-plus"></i>
        				<span class="nav-link-text">Add new DoD item</span>
        			</button>
    					<br>
    					<br>
    					<br>
    					<table class="table" style="background-color: WhiteSmoke;">
			    		<tbody>';
					    $count = 1;
					    $results2 = execute_sql_function("SELECT * FROM question WHERE question_checklist = ".$row['id_checklist']);
					    while($row2 = $results2->fetch_assoc())
    					{
    						delete_dod_item_modal($row2['id_question']);
    						modify_dod_item_modal($row2['id_question'],$row2['question_name']);

    						echo '
    						<tr>
    							<td class="col-sm-2">'.$count.'</td>
    							<td class="col-sm-8">'.$row2['question_name'].'</td>
    							<td class="col-sm-2">
    								<a data-toggle="modal" href="#deleteQuestionModal'.$row2['id_question'].'">Delete</a> | 
    								<a data-toggle="modal" href="#modifyQuestionModal'.$row2['id_question'].'">Modify</a>
    							</td>
    						</tr>';

    						$count++;
    					}
			    		echo '
			    		</tbody>
    					</table>
    					<!--Dropdown Content-->

    					<!--addQuestionModal Content-->
    					<div id="addQuestionModal'.$row['id_checklist'].'" class="modal fade" role="dialog">
					  	  <div class="modal-dialog modal-content">
					    	<!-- Modal content-->
				      		<div class="modal-header">
				     			  <h4 class="modal-title">Add DoD Item</h4>
				        		<button type="button" class="close" data-dismiss="modal">&times;</button>
				      		</div>
				      		<div class="modal-body">
				        		<form action="indexbackend.php" method="POST" id="form'.$row['id_checklist'].'">
	                    <label for="Question_Field" class="col-sm-4 col-form-label">DoD Item: </label>
	                    <textarea id="input'.$row['id_checklist'].'" class="form-control col-sm-8" type="text" name="Question_Field"></textarea>
	                    <input type="hidden" name="ID_Checklist" value="'.$row['id_checklist'].'"/>
				            </form>
		                <table>';
	                  $count2=1;
                    $count4=1;
		                $results3 = execute_sql_function("SELECT * FROM template_dod");
			    			    while($row3 = $results3->fetch_assoc())
		                {
		    						  $count_parameter = 1;
		    						  $id_templatedod = $row3['id_templatedod'];
                      $text_selected = "";
                      $text_displayed = "";

			    					  echo '
			    					  <tr>
                        <td>'.$count2.'</td>
		                    <td>';

				    						while (strpos($row3['template_text'],'*') !== FALSE)
				    						{
                          $text_selected .= $text_displayed .= htmlspecialchars(substr($row3['template_text'],0,strpos($row3['template_text'],'*')));
                          check_for_radio($text_displayed,$count4);
			    							  echo'
                          <select id="select'.$row3['id_templatedod'].$count_parameter.'" onmouseover="current_element(this.value)" onchange="update_sentence(this.value,'.($count2-1).',select'.$row3['id_templatedod'].$count_parameter.')">';
						              $results4 = execute_sql_function("SELECT * FROM parameter WHERE id_templatedod = $id_templatedod AND $count_parameter = parameter_position");
                          $last_option="";
				            	    while($row4 = $results4->fetch_assoc())
	    								    {
	    		                  echo '<option selected="selected" value="'.$row4['parameter_name'].'">'.htmlspecialchars($row4['parameter_name']).'</option>';
                            $last_option = htmlspecialchars($row4['parameter_name']);
                          }
                          echo '</select>';
                          $text_selected .= $last_option;
		    								  $row3['template_text'] = substr($row3['template_text'],strpos($row3['template_text'],'*')+1);

		    								  $count_parameter++;
			    			        }
                        $text_selected .= htmlspecialchars($row3['template_text']);
			    	            check_for_radio(htmlspecialchars($row3['template_text']),$count4);

			    					    echo'
                        </td>
                        <script> create_dictionary("'.$text_selected.'");</script>
                        <td><input type="hidden" id="option'.$row3['id_templatedod'].'" name="Text_Selected" value="'.$text_selected.'"/></td>
			    					    <td><input onclick="update('.($count2-1).',input'.$row['id_checklist'].')" type="radio" name="gender"></td>
			    					  </tr>';
			    					  $count2++;
				            }
				            echo '
				            </table>
                  </div>
				      		<div class="modal-footer">
				      			<button type="submit" class="btn btn-primary" form="form'.$row['id_checklist'].'" value="Submit" name="submitnewquestion">Submit</button>
				        		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				      		</div>
                </div>
              </div>
              <!--addQuestionModal Content-->

            </div>
          </td>
				</tr>';
        }?>
    		</tbody>
    	</table>

    </div>

    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © Team 2017</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Jquery and Treeviewscripts-->
    <script src="vendor/jquery/jquery.js"></script>

  </div>

</body>

</html>
