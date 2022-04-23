<?php
if (isset($_POST['add'])) {
$message = $_POST['message2'];
$regno = $_POST['regno'];
$ident = $_POST['ident'];
$words = explode(" ", $message);
$sound = " ";
foreach ($words as $word) {
  $word = str_replace(" ", "", $word);
  $sound.= metaphone($word)." ";
}

if (empty($message) || empty($regno)) {
  echo "<script> alert('Fill all fields') </script>";
}else{

  $in = array('question' => $message,
      'indexing' => $sound, 
      'answer' => $regno, 
);
  create('model',$in);
  $conn->query("DELETE FROM void WHERE id = '$ident'");
  echo "<script> alert('Model Created') </script>";
  echo "<script> alert('$ident') </script>";
}
}
?>

<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Add Answer to Unanswered</h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Add Answer to Unanswered</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>S/N</th>
                          <th>User</th>
                          <th>Question</th>
                          <th>Date</th>
                          <th>Prefered Registry</th>
                        </tr>
                      </thead>
                      <tbody>

<?php
$query = $conn->query("SELECT * FROM void order by 'id' DESC");
$fetch = $query->fetchAll(PDO::FETCH_OBJ);
$count = $query->rowCount();
$num = 1;
if ($count > 0) {
  foreach ($fetch as $key) {
    $id = $key->id;
    $userid = $key->userid;
    $question = $key->question;
    $dates = $key->dates;
    
    ?>
 
                      
                        <tr>
                          <td><?php echo $num; ?></td>
                          <td><?php echo $userid; ?></td>
                          <td><?php echo $question; ?></td>
                          <td><?php echo $dates; ?></td>
                          <td>
                            <form method="post">
                              <div class="form-group">
                                <select class="form-control" name="regno">
                                  <option value="" selected="">Select Registry..</option>
                                  <?php
                                  $select = $conn->query("SELECT * FROM registry ORDER BY id DESC");
                                  $fetch = $select->fetchALL(PDO::FETCH_OBJ);
                                  $count = $select->rowCount();
                                  if ($count > 0) {
                                      foreach ($fetch as $key) {
                                          $regno = $key->regno;
                                          $answer = $key->answer;
                                    ?>
                                    <option value="<?php echo $regno; ?>"><?php echo "$answer"; ?></option>
                                    <?php
                                  }
                                }
                                  ?>
                                  
                                </select>
                            </div>
                            <input type="hidden" name="message2" value="<?php echo $question; ?>">
                            <input type="hidden" name="ident" value="<?php echo $id; ?>">
                            <button class="btn btn-success btn-xs" name="add" type="submit">Add</button>
                            </form>
                          </td>
                        </tr>
                     </tbody>

      <?php
      $num++;
   }
   
}
?>
                     
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->