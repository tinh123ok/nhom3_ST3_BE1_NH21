<?php include "header.php" ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Project Add</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Add Product</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <form action="upload.php" method="post" enctype="multipart/form-data">

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
              <div class="form-group">
                <label for="inputName">Product Name</label>
                <input name="name" type="text" id="inputName" class="form-control" required>
              </div>

              <div class="form-group">
                <label for="inputStatus">Manu_id</label>
                <select name="manu_id" id="inputStatus" class="form-control custom-select" required>
                  <option selected disabled>Select one</option>
                  <?php foreach ($product->getAllmenu() as $value) {
                  ?>
                    <option value="<?php echo $value['manu_id'] ?>"><?php echo $value['manu_name'] ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group">
                <label for="inputStatus">Type_id</label>
                <select name="type_id" id="inputStatus" class="form-control custom-select" required>
                  <option selected disabled>Select one</option>
                  <?php foreach ($product->getAllprotypes() as $value) {
                  ?>
                    <option value="<?php echo $value['type_id'] ?>"><?php echo $value['type_name'] ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group">
                <label for="inputName">Price</label>
                <input type="number" name="price" id="inputName" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="inputDescription">Image: </label>
                <input type="file" id="fileupload" name="fileupload" >
              </div>
              <div class="form-group">
                <label for="inputDescription">Description</label>
                <textarea name="description" id="inputDescription" class="form-control" rows="4" required></textarea>
              </div>
              <div class="form-group">
                <label for="inputStatus">Feature</label>
                <select name="feature" id="inputStatus" class="form-control custom-select">
                  <option selected value="0">0</option>
                  <option value="1">1</option>
                </select>
              </div>

            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>

      </div>
      <div class="row">
        <div class="col-12">
          <a href="#" class="btn btn-secondary">Cancel</a>
          <input type="submit" name="submit_product" value="Create new Porject" class="btn btn-success float-right">
        </div>
      </div>
    </form>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include "footer.html" ?>