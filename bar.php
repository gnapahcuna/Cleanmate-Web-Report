
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="brand">
    <a href="Summary-All-F.php"><img src="assets/img/logo.png" alt="Klorofil Logo" class="img-responsive logo"></a>
  </div>
  <div class="container-fluid">
    <div class="navbar-btn">
      <button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
    </div>


    <div class="navbar-btn navbar-btn-right">
      <a class="btn btn-default" onclick="logout()"><i class="lnr lnr-exit"></i> <span>Logout</span></a>
    </div>
    <div id="navbar-menu">
      <ul class="nav navbar-nav navbar-right">

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="assets/img/icon.png" class="img-circle" alt="Avatar"> <span><?php echo $_SESSION['FirstName'].' '.$_SESSION['LastName'].' ('.$_SESSION['BranchNameTH'].')';?></span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
          <ul class="dropdown-menu">
            <li><a onclick="logout()"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
<script src="assets/vendor/jquery/jquery.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
<script src="assets/vendor/chartist/js/chartist.min.js"></script>
<script src="assets/scripts/klorofil-common.js"></script>
<script>
    function logout() {
        $.get("path.txt", function (data) {
            var resourceContent = data;
            var id="<?php echo $_SESSION['id'];?>";
            $.ajax({
                url: resourceContent + "/getLogout.php?IsSignOn=0&id="+id,
                type: "POST",
                data: ''
            })
                .success(function (result) {
                    //
                    window.location = 'Logout.php';
                });
        });
    }
</script>
