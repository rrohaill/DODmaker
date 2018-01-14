<?php

function delete_dod_modal($id_dod)
{
	echo
	'<div id="deleteChecklistModal'.$id_dod.'" class="modal fade" role="dialog">
	  	<div class="modal-dialog modal-content">
	    	<!-- Modal content-->
      		<div class="modal-header">
     			<h4 class="modal-title">Do you want to delete this DoD?</h4>
        		<button type="button" class="close" data-dismiss="modal">&times;</button>
      		</div>
      		<div class="modal-footer">
      			<form action="indexbackend.php" method="POST" id="form1'.$id_dod.'">
      				<input type="hidden" name="ID_Checklist" value="'.$id_dod.'"/>
      			</form>
      			<button type="submit" class="btn btn-primary" form="form1'.$id_dod.'" value="Submit" name="submitdeletedod">Delete</button>
        		<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      		</div>
	    </div>
	</div>';
}

function modify_dod_modal($id_dod,$dod_name)
{
	echo
	'<div id="modifyChecklistModal'.$id_dod.'" class="modal fade" role="dialog">
	  	<div class="modal-dialog modal-content">
	    	<!-- Modal content-->
      		<div class="modal-header">
     			<h4 class="modal-title">Modify DoD</h4>
        		<button type="button" class="close" data-dismiss="modal">&times;</button>
      		</div>
      		<div class="modal-body">
	      		<form action="indexbackend.php" method="POST" id="form2'.$id_dod.'">
	      			<label class="col-sm-4 col-form-label" for="Checklist_Field">DoD Name:</label>
	      			<input class="form-control col-sm-8" type="text" name="Checklist_Text" value="'.$dod_name.'"/>
	      			<input type="hidden" name="ID_Checklist" value="'.$id_dod.'"/>
	      		</form>
      		</div>
      		<div class="modal-footer">
      			<button type="submit" class="btn btn-primary" form="form2'.$id_dod.'" value="Submit" name="submitmodifydod">Modify</button>
        		<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      		</div>
	    </div>
	</div>';
}

function delete_dod_item_modal($id_dod_item)
{
	echo
	'<div id="deleteQuestionModal'.$id_dod_item.'" class="modal fade" role="dialog">
	  	<div class="modal-dialog modal-content">
	    	<!-- Modal content-->
      		<div class="modal-header">
     			<h4 class="modal-title">Do you want to delete this DoD Item?</h4>
        		<button type="button" class="close" data-dismiss="modal">&times;</button>
      		</div>
      		<div class="modal-footer">
      			<form action="indexbackend.php" method="POST" id="form3'.$id_dod_item.'">
      				<input type="hidden" name="ID_Question" value="'.$id_dod_item.'"/>
      			</form>
      			<button type="submit" class="btn btn-primary" form="form3'.$id_dod_item.'" value="Submit" name="submitdeletedoditem">Delete</button>
        		<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      		</div>
	    </div>
	</div>';
}

function modify_dod_item_modal($id_dod_item,$dod_item_name)
{
	echo
	'<div id="modifyQuestionModal'.$id_dod_item.'" class="modal fade" role="dialog">
	  	<div class="modal-dialog modal-content">
	    	<!-- Modal content-->
      		<div class="modal-header">
     			<h4 class="modal-title">Modify DoD Item</h4>
        		<button type="button" class="close" data-dismiss="modal">&times;</button>
      		</div>
      		<div class="modal-body">
      			<form action="indexbackend.php" method="POST" id="form5'.$id_dod_item.'">
      				<label class="col-sm-4 col-form-label" for="Question_Field">DoD Item Name:</label>
						<input class="form-control col-sm-8" type="text" name="Question_Text" value="'.$dod_item_name.'"/>
      				<input type="hidden" name="ID_Question" value="'.$id_dod_item.'"/>
      			</form>
      		</div>
      		<div class="modal-footer">
      			<button type="submit" class="btn btn-primary" form="form5'.$id_dod_item.'" value="Submit" name="submitmodifydoditem">Modify</button>
        		<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      		</div>
	    </div>
	</div>';
}

function add_dod_item_modal()
{
  echo '
  <div id="addChecklistModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-content">
      <!-- Modal content-->
        <div class="modal-header">
        <h4 class="modal-title">Add DoD</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <form class="modal-body" action="indexbackend.php" method="POST" id="checklist_form">
          <label for="Checklist_Field" class="col-sm-4 col-form-label">DoD Name:</label>
          <input class="form-control col-sm-8" type="text" name="Checklist_Field">
        </form>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" form="checklist_form" value="Submit" name="submitnewchecklist">Submit</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>';
}

function getStringBetween($str,$from,$to)
{
    $sub = substr($str, strpos($str,$from)+strlen($from),strlen($str));
    return substr($sub,0,strpos($sub,$to));
}

function check_for_radio($input,&$count)
{
  while (getStringBetween($input,'[',']'))
  {
    echo substr($input, 0, strpos($input, '['));
    echo "(";
    $str_radio = getStringBetween($input,'[',']');
    $str_radio = substr($str_radio,0,(strlen($str_radio)));
    echo '<input class="checkbox'.$count.'" type="checkbox" value="'.$str_radio.'">'.$str_radio.'</input>';
    echo ")";
    $count++;

    $input = substr($input, strpos($input, ']')+1);
  }

  echo $input;
}

?>