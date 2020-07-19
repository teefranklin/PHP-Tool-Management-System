    <!-- /#page-content-wrapper -->
    </div>
    <!-- /#wrapper -->
    <!-- Modal -->
    <div class="modal fade" id="change_password" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Change Password</h4>
          </div>
          <div class="modal-body">
            <form action="gf/change_password.php" method="post">
              <div class="input">
                <input class="form-control" type="password" name="old_password" placeholder="Old Password" required="">
                <span class="fa fa-unlock"></span>
              </div>
              <div class="input">
                <input class="form-control" type="password" name="password" placeholder="New Password" required="">
                <span class="fa fa-unlock"></span>
              </div>
              <div class="input">
                <input class="form-control" type="password" name="new_password" placeholder="Confirm Old Password" required="">
                <span class="fa fa-unlock"></span>
              </div>
              <input type="submit" class="btn btn-primary" name="change_password" value="Change Password">
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <!-- Menu Toggle Script -->
    <script>
      $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
      });
      $(document).ready(function() {
        $(".filters").hide();
        $('#borrowed_tools').DataTable();
        $('#users').DataTable();
        $('#tools').DataTable();
        $('#generated').DataTable();
        $("#report_type").change(function() { 
          var choices = $("#report_type").val();
          if (choices == 'borrow') {
            $(".filters").show();
          } else {
            $(".filters").hide();
          }
        });
        $( "#search2" ).click(function() { 
          create_table();
        });
        
      });

      function create_table() {
          $.ajax({
            url: "table_generator.php",
            method: "POST",
            success: function(data) {
              $('#my_table').html(data);
              alert('success');
            }
          })
        }
    </script>

    </body>

    </html>