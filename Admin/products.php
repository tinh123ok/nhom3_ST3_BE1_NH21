<?php include "header.php" ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Products</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Products</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Products <?php echo sizeof($product->getAllProducts()) ?></h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
            <i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
      <div class="card-body p-0">
        <table class="table table-striped projects">
          <thead>
            <tr>
              <th style="width: 1%">
                ID
              </th>
              <th style="width: 20%">
                Name
              </th>
              <th style="width: 30%">
                Image
              </th>
              <th>
                Price
              </th>
              <th>
                Manufacture
              </th>
              <th style="width: 8%" class="text-center">
                Protypr
              </th>
              <th style="width:20%;text-align: center;">
                Action
              </th>
            </tr>
          </thead>
          <tbody>
            <?php
            $getAllProducts = $product->getAllProducts();
            foreach ($getAllProducts as $value) {
            ?>
              <tr>
                <td>
                  <?php echo $value['ID'] ?>
                </td>
                <td>
                  <a>
                    <?php echo $value['Name'] ?>
                  </a>
                  <br />
                </td>
                <td>
                  <img src="../images/<?php echo $value['image'] ?>" width="100px" alt="">
                </td>
                <td class="project_progress">
                  <?php echo $value['price'] ?>
                </td>
                <td class="project-state">
                  <?php echo $value['manu_name'] ?>
                </td>
                <td class="">
                  <?php echo $value['type_name'] ?>
                </td>
                <td class="project-actions text-right">
                  <a class="btn btn-info btn-sm" href="products_edit.php?id=<?php echo $value['ID'] ?>">
                    <i class="fas fa-pencil-alt">
                    </i>
                    Edit
                  </a>
                  <a class="btn btn-danger btn-sm" href="delete.php?id=<?php echo $value['ID'] ?>">
                    <i class="fas fa-trash">
                    </i>
                    Delete
                  </a>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include "footer.html" ?>