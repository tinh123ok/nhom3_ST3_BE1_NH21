<?php include "header.php";
$id = isset($_GET['id']) ? $_GET['id'] : -1;
$the_product = $id != -1 ? $product->getProductById($id)[0] : [];

function selected($value, $kieu, $x)
{
  if ($value[$kieu] == $x) {
    echo 'selected';
  }
}
function disabled($id)
{
  if ($id == -1) {
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
          <h1>Project Add</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Edit Product</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <form action="Edit.php" method="post" enctype="multipart/form-data">
      <?php if ($id != -1) { ?>
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
                  <label for="inputName">Product Id</label>
                  <input type="hidden" name="id" value="<?php echo $product->getProductById($id)[0]['ID'] ?>">
                  <input name="id" value="<?php echo $product->getProductById($id)[0]['ID'] ?>" disabled type="text" id="inputName" class="form-control" required>
                </div>
                <div class="form-group">
                  <label for="inputName">Product Name</label>
                  <input name="name" value="<?php echo $product->getProductById($id)[0]['Name'] ?>" type="text" id="inputName" class="form-control" required>
                </div>

                <div class="form-group">
                  <label for="inputStatus">Manu_id</label>
                  <select name="manu_id" id="inputStatus" class="form-control custom-select" required>
                    <?php foreach ($product->getAllmenu() as $value) {
                    ?>
                      <option <?php selected($the_product, 'manu_id', $value['manu_id']) ?> value="<?php echo $value['manu_id'] ?>"><?php echo $value['manu_name'] ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="inputStatus">Type_id</label>
                  <select name="type_id" id="inputStatus" class="form-control custom-select" required>
                    <?php foreach ($product->getAllprotypes() as $value) {
                    ?>
                      <option <?php selected($the_product, 'type_id', $value['type_id']) ?> value="<?php echo $value['type_id'] ?>"><?php echo $value['type_name'] ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="inputName">Price</label>
                  <input type="number" value="<?php echo $the_product['price'] ?>" name="price" id="inputName" class="form-control" required>
                </div>
                <div class="form-group">
                  <label for="inputDescription">Description</label>
                  <textarea name="description" id="inputDescription" class="form-control" rows="4" required><?php echo $the_product['description'] ?></textarea>
                </div>
                <div class="form-group">
                  <label for="inputStatus">Feature</label>
                  <select name="feature" id="inputStatus" class="form-control custom-select">
                    <option <?php selected($the_product, 'feature', 0) ?> value="0">0</option>
                    <option <?php selected($the_product, 'feature', 1) ?> value="1">1</option>
                  </select>
                </div>

              </div>

            </div>

          </div>
          <div class="col-md-5">
            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Image</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <input name="fileupload" accept="image/*" type='file' id="imgInp" />
                <img id="blah" src="../images/<?php echo $the_product['image'] ?>" alt="your image" width="100%" />

              </div>
            </div>
          </div>
        </div>
      <?php } else {
        echo 'Nhấn Cancel rồi chọn lại...';
      } ?>
      <div class="row">
        <div class="col-12">
          <a href="products.php" class="btn btn-secondary">Cancel</a>
            <input <?php disabled($id)?> type="submit" name="submit_product" value="Update" class="btn btn-success float-right">
        </div>
      </div>
    </form>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script>
  imgInp.onchange = evt => {
    const [file] = imgInp.files
    if (file) {
      blah.src = URL.createObjectURL(file)
    }
  }
</script>
<?php include "footer.html" ?>