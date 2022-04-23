<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Main Page</h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Main Page</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                <div class="row">
                <div class="col-md-4">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-male"></i></div>
                  <?php
                  $query = $conn->query("SELECT * FROM conversation order by 'id' DESC");
                  $fetch = $query->fetchAll(PDO::FETCH_OBJ);
                  $count = $query->rowCount();
                  $num = 1;
                  if ($count > 0) {
                  ?>
                  <div class="count"><?php echo "$count"; ?></div>
                  <h3>conversations(s)</h3>
                  <p>These are the people that had conversations on the website</p>
                  <?php
                }else{
                  ?>
                  <div class="count">0</div>
                  <h3>conversation</h3>
                  <p>These are the people that had conversations on the website</p>
                  <?php
                }


                  ?>
                  
                </div>
              </div>

                <div class="col-md-4">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-users"></i></div>
                  <?php
                  $query = $conn->query("SELECT * FROM void order by 'id' DESC");
                  $fetch = $query->fetchAll(PDO::FETCH_OBJ);
                  $count = $query->rowCount();
                  $num = 1;
                  if ($count > 0) {
                  ?>
                  <div class="count"><?php echo "$count"; ?></div>
                  <h3>Unanswered</h3>
                  <p>These are the people that were unable to get a reply</p>
                  <?php
                }else{
                  ?>
                  <div class="count">0</div>
                  <h3>Unanswered</h3>
                  <p>These are the people that were unable to get a reply</p>
                  <?php
                }


                  ?>
                  
                </div>
              </div>


              <div class="col-md-4">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-list"></i></div>
                  <?php
                  $query = $conn->query("SELECT * FROM registry order by 'id' DESC");
                  $fetch = $query->fetchAll(PDO::FETCH_OBJ);
                  $count = $query->rowCount();
                  $num = 1;
                  if ($count > 0) {
                  ?>
                  <div class="count"><?php echo "$count"; ?></div>
                  <h3>Answers</h3>
                  <p>These are the available answers online</p>
                  <?php
                }else{
                  ?>
                  <div class="count">0</div>
                  <h3>Answers</h3>
                  <p>These are the available answers online</p>
                  <?php
                }


                  ?>
                  
                </div>
              </div>


              <div class="col-md-4">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-question"></i></div>
                  <?php
                  $query = $conn->query("SELECT * FROM model order by 'id' DESC");
                  $fetch = $query->fetchAll(PDO::FETCH_OBJ);
                  $count = $query->rowCount();
                  $num = 1;
                  if ($count > 0) {
                  ?>
                  <div class="count"><?php echo "$count"; ?></div>
                  <h3>Questions</h3>
                  <p>These are the available questions online</p>
                  <?php
                }else{
                  ?>
                  <div class="count">0</div>
                  <h3>Questions</h3>
                  <p>These are the available questions online</p>
                  <?php
                }


                  ?>
                  
                </div>
              </div>

              <div class="col-md-4">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-dashboard"></i></div>
                  <?php
                  $query = $conn->query("SELECT * FROM users order by 'id' DESC");
                  $fetch = $query->fetchAll(PDO::FETCH_OBJ);
                  $count = $query->rowCount();
                  $num = 1;
                  if ($count > 0) {
                  ?>
                  <div class="count"><?php echo "$count"; ?></div>
                  <h3>users</h3>
                  <p>These are the users that made conversations</p>
                  <?php
                }else{
                  ?>
                  <div class="count">0</div>
                  <h3>users</h3>
                  <p>These are the users that made conversations</p>
                  <?php
                }


                  ?>
                  
                </div>
              </div>

              </div>


                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->