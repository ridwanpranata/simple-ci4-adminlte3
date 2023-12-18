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
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="<?= url_to('permission-update')?>" method="POST">
                                <?= csrf_field() ?>
                                <input type="hidden" name="permission_id" value="<?= $permission->id ?>">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="name">Permission Name</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Permission Name" value="<?= $permission->name ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea class="form-control" name="description" id="description" cols="30" rows="3"><?= $permission->description ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="permission-category">Permission Category</label>
                                            <select name="permission_category" id="permission-category" class="form-control">
                                                <option value=""> Select Category </option>
                                                <?php foreach ($permission_categories as $permission_category) : ?>
                                                    <?php $selected = ($permission_category->id == $permission->permission_category_id) ? 'selected' : ''; ?>
                                                    <option value="<?= $permission_category->id ?>" <?= $selected ?> > <?= $permission_category->name ?></option>
                                                <?php endforeach ?> 
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 text-right">
                                    <a href="<?= url_to('permission') ?>" type="button" class="btn btn-secondary">Cancel</a>
                                    <button type="submit" class="btn btn-primary" id="btn_submit">Update Permission</button>
                                </div>
                            </form>
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

