<?= $this->extend('layouts/template'); ?>

<?= $this->Section('content'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><?= $page_title ?></h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Manage Permission Categories</h3>
                            <div class="d-flex justify-content-end mb-1">
                                <a href="<?= url_to('permission-category-create') ?>" class="btn btn-success mb-2" id="btn_modal_create">Create</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="permission_category_table" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th width="10%">No</th>
                                        <th width="20%">Name</th>
                                        <th width="40%">Description</th>
                                        <th width="150">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($permission_categories as $key => $permission_category) : ?>
                                    <tr>
                                        <td><?= $key + 1 ?></td>
                                        <td><?= $permission_category->name ?></td>
                                        <td><?= $permission_category->description ?></td>
                                        <td>
                                            <a href="<?= url_to('permission-category-edit', $permission_category->id)?>" class="btn btn-primary btn-sm">Edit</a>
                                            <a href="<?= url_to('permission-category-delete', $permission_category->id)?>" class="btn btn-danger btn-sm">Delete</a>
                                        </td>
                                    </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

</div>



<?= $this->endSection('content'); ?>

