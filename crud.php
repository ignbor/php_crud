<?php
include 'ajax.php';
   if(!empty($_GET)){
      if(!empty($_GET['delete'])){
         $id = $_GET['delete'];
         $query = 'DELETE FROM `students` WHERE `id`='.$id.';';
         $delete = db_connect($query,'uh371665_info');
           if($delete){
              $message = '<b class="color_green">Delete ok!</b>';
           }
      }
   }

   if(!empty($_POST)){
         if(!empty($_POST['student_name'])&&!empty($_POST['student_surname'])&&!empty($_POST['student_age'])&&!empty($_POST['student_university'])&&empty($_POST['update_id'])){
           $query = 'INSERT INTO `students`(`first_name`,`last_name`,`age`,`university`) VALUES("'.$_POST['student_name'].'","'.$_POST['student_surname'].'","'.$_POST['student_age'].'","'.$_POST['student_university'].'");';
           $insert = db_connect($query,'uh371665_info');
           if($insert){
              $message = '<b class="color_green">Insert ok!</b>';
           }
         }elseif(!empty($_POST['student_name'])&&!empty($_POST['student_surname'])&&!empty($_POST['student_age'])&&!empty($_POST['student_university'])&&!empty($_POST['update_id'])){
           $query = 'UPDATE `students` SET `first_name`="'.$_POST['student_name'].'",`last_name`="'.$_POST['student_surname'].'",`age`="'.$_POST['student_age'].'",`university`="'.$_POST['student_university'].'" WHERE `id`='.$_POST['update_id'].';';
           $update = db_connect($query,'uh371665_info');
           if($update){
              $message = '<b class="color_green">Update ok!</b>';
           }
         }else{
           $message = '<b class="color_red">Fill in all the fields!</b>';
         }
   }

$query = 'SELECT * FROM `students`';
$list = getList($query);
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="html_css_test_page_for_epam">
    <meta name="author" content="IgnBor">
    <title>PHP CRUD</title>
    <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="main.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  </head>
  <body class="text-center">
	<main role="main" class="flex-shrink-0">
	  <div class="container">
		<div class="row text-center">
                  <div class="col-12 mb-4">
	             <h2 class="mt-5">Manage records of students database</h2>
                  </div>
                  <div class="col-12" id="records_holder">
                  <?php if(!empty($message)){
                      echo '<div class="col-12 text-left mb-4">'.$message.'</div>'; } ?>
                  <div class="col-12 text-left mb-4">
                     <a class="icon_font" href="#" title="add new record"  data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus"></i></a>
                  </div>
                     <table class="table">
                       <thead>
                         <tr>
                           <th scope="col">#</th>
                           <th scope="col">First name</th>
                           <th scope="col">Last name</th>
                           <th scope="col">Age</th>
                           <th scope="col">University</th>
                           <th scope="col">Operations</th>
                         </tr>
                       </thead>
                      <tbody>
                        <?php 
                           if(!empty($list)){
                              foreach($list as $k=>$one_student){
                                 $id = $one_student[0];
                                 $first_name = $one_student[1];
                                 $last_name = $one_student[2];
                                 $age = $one_student[3];
                                 $university = $one_student[4];
                                 $key = $k +1;
                                 echo '<tr>';
                                    echo '<th scope="row">'.$key.'</th>';
                                    echo '<td>'.$first_name.'</td>';
                                    echo '<td>'.$last_name.'</td>';
                                    echo '<td>'.$age.'</td>';
                                    echo '<td>'.$university.'</td>';
                                    echo '<td><a class="mr-3 icon_font" href="#" onclick="edit_object('.$id.')"><i class="fas fa-pencil-alt" title="edit record"></i></a><a class="icon_font" href="crud.php?delete='.$id.'"><i class="far fa-trash-alt" title="delete record"></i></a></td>';
                                 echo '</tr>';                            
                              }
                           }
                        ?>
                       </tbody>
                     </table>
                  </div>
		</div>
	  </div>
	</main>

<!-- Add record modal-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <form action="crud.php" method="post" name="insert_record" id="insert_record">
          <div class="form-group text-left">
            <label for="student_name" class="col-form-label label_font">First name:</label>
            <input type="text" class="form-control" id="student_name" name="student_name">
          </div>
          <div class="form-group text-left">
            <label for="student_surname" class="col-form-label label_font">Last name:</label>
            <input type="text" class="form-control" id="student_surname" name="student_surname">
          </div>
          <div class="form-group text-left">
            <label for="student_age" class="col-form-label label_font">Age:</label>
            <input type="number" class="form-control" id="student_age" name="student_age">
          </div>
          <div class="form-group text-left mb-3">
            <label for="student_university" class="col-form-label label_font">University:</label>
            <input type="text" class="form-control" id="student_university" name="student_university">
          </div>
          <hr>
          <div class="form-group text-right">
             <input type="hidden" id="update_id" name="update_id">
             <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
             <button type="submit" class="btn btn-primary" id="submit_button">Insert</button>
           </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="func.js"></script>
  </body>
</html>