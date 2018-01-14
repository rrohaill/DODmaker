<?php
	include 'sql_functions.php';
	session_start();

	function add_question()
	{
		$question_text = $_POST["Question_Field"];
		$question_checklist = $_POST["ID_Checklist"];

	    execute_non_query("INSERT INTO question (question_name,question_checklist) VALUES ('$question_text',$question_checklist);");
	}

	function add_checklist()
	{
		$checklist_field = $_POST["Checklist_Field"];
		$id_user = $_SESSION['id_user'];

	    execute_non_query("INSERT INTO checklist (checklist_name,id_person) VALUES ('$checklist_field',$id_user);");
	}

	function delete_dod()
	{
		$checklist_id = $_POST["ID_Checklist"];

		execute_non_query("DELETE FROM question WHERE question_checklist = $checklist_id;");
		execute_non_query("DELETE FROM checklist WHERE id_checklist = $checklist_id;");
	}

	function delete_dod_item()
	{
		$question_id = $_POST["ID_Question"];

		execute_non_query("DELETE FROM question WHERE id_question = $question_id;");
	}

	function modify_dod()
	{
		$checklist_text = $_POST["Checklist_Text"];
		$checklist_id = $_POST["ID_Checklist"];

		execute_non_query("UPDATE checklist SET checklist_name = '$checklist_text' WHERE $checklist_id = id_checklist;");
	}

	function modify_dod_item()
	{
		$question_text = $_POST["Question_Text"];
		$question_id = $_POST["ID_Question"];

		execute_non_query("UPDATE question SET question_name = '$question_text' WHERE $question_id = id_question;");
	}

	function export_dod(){
		$id_user = $_SESSION['id_user'];

		$query = execute_sql_function("SELECT * FROM checklist WHERE id_person = $id_user");

		if($query->num_rows > 0)
		{
			$nr_crt = 1;
    		$delimiter = ",";
    		$filename = "members_" . date('Y-m-d') . ".csv";
    
    		//create a file pointer
    		$f = fopen('php://memory', 'w');
    
    		//set column headers
    		$fields = array('Nr.', 'DoD');
    		fputcsv($f, $fields, $delimiter);
    
    		//output each row of the data, format line as csv and write to file pointer
    		while($row = $query->fetch_assoc())
    		{
    			$checklist = $row['id_checklist'];
        		$lineData = array($nr_crt, $row['checklist_name']);
        		fputcsv($f, $lineData, $delimiter);

        		$lineData = array("", "");
        		fputcsv($f, $lineData, $delimiter);

        		$nr_crt2 = 1;
        		$fields = array('','DoD Item Nr.', "DoD Item Content");
        		fputcsv($f, $fields, $delimiter);

        		$query2 = execute_sql_function("SELECT * FROM question WHERE question_checklist = $checklist");
        		while($row2 = $query2->fetch_assoc())
    			{
    				$lineData = array('', $nr_crt2, $row2['question_name']);
        			fputcsv($f, $lineData, $delimiter);

        			$nr_crt2++;
    			}

    			$lineData = array("", "");
        		fputcsv($f, $lineData, $delimiter);
    			$nr_crt++;
    		}
    
    		//move back to beginning of file
    		fseek($f, 0);
    
    		//set headers to download file rather than displayed
    		header('Content-Type: text/csv');
    		header('Content-Disposition: attachment; filename="' . $filename . '";');
    
    		//output all remaining data on a file pointer
    		fpassthru($f);
		}
		exit;
	}

	if (isset($_POST['submitnewquestion']))
    {
    	add_question();
  	}
  	if (isset($_POST['submitnewchecklist']))
  	{
  		add_checklist();
  	}
  	if (isset($_POST['submitdeletedod']))
  	{
  		delete_dod();
  	}
  	if (isset($_POST['submitdeletedoditem']))
  	{
  		delete_dod_item();
  	}
  	if (isset($_POST['submitmodifydod']))
  	{
  		modify_dod();
  	}
  	if (isset($_POST['submitmodifydoditem']))
  	{
  		modify_dod_item();
  	}
  	if (isset($_POST['exportdod']))
  	{
  		export_dod();
  	}
  	header("location: index.php");
?>