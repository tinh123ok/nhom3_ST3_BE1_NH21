<?php include "header.php" ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Protypes</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active">Protypes</li>
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
        <h3 class="card-title">Protypes <?php echo sizeof($product->getAllprotypes()) ?></h3>

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
              <th style="width:10%">
                Bill id
              </th>
              <th style="width: 10%">
                Barcode
              </th>
              <th>
                Full name
              </th>
              <th>
                User name
              </th>
              <th>
                Address
              </th>
              <th>
                phone
              </th>
              <th>
                ordernotes
              </th>
              <th style="width:20%;text-align: center;">
                Action
              </th>

            </tr>
          </thead>
          <tbody>
            <?php
            $allbill = $product->getallbill();
            foreach ($allbill as $value) {
            ?>
              <tr>
                <td>
                  <?php echo $value['bill_id'] ?>
                </td>
                <td>
                  <a>
                    <?php echo $value['Barcode'] ?>
                  </a>
                </td>
                <td>
                  <?php echo $value['fullname'] ?>
                </td>
                <td>
                  <?php echo $value['username'] ?>
                </td>
                <td>
                  <?php echo $value['address'] ?>
                </td>
                <td>
                  <?php echo $value['phone'] ?>
                </td>
                <td>
                  <?php echo $value['ordernotes'] ?>
                </td>
                <td style="text-align: center;" class="project-actions">
                  <a class="btn btn-danger btn-sm" href="delete.php?bill_id=<?php echo $value['bill_id'] ?>">
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