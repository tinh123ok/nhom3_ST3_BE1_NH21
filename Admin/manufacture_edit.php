<?php
include "header.php";
$manu_id = -1;
if (isset($_GET['manu_id'])) {
  $manu_id = $_GET['manu_id'];
}
function disabled($manu_id)
{
  if ($manu_id == -1) {
    echo "disabled";
  }
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Manufacture Add</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active">Edit Manufacture</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <form action="Edit.php" method="post">

      <div class="row">
        <div class="col-md">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">General</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <?php if ($manu_id != -1) { ?>
                <div class="form-group">
                  <label for="inputName">Manufacture ID</label>
                  <input value="<?php echo $product->getmanufacturesbyid($manu_id)[0]['manu_id'] ?>" disabled type="text" id="inputName" class="form-control">
                  <input type="hidden" name="manu_id" value="<?php echo $product->getmanufacturesbyid($manu_id)[0]['manu_id'] ?>">
                </div>
                <div class="form-group">
                  <label for="inputName">Manufacture Name</label>
                  <input name="type_name" type="text" value="<?php echo $product->getprotypebyid($manu_id)[0]['type_name'] ?>" id="inputName" class="form-control">
                </div>
              <?php } ?>


            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>

      </div>

      <div class="row">
        <div class="col-12">
          <a href="Manufacture.php" class="btn btn-secondary">Cancel</a>
          <input type="submit" <?php disabled($manu_id); ?> name="submit_manufacture" value="Update" class="btn btn-success float-right">
        </div>
      </div>
    </form>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include "footer.html" ?>