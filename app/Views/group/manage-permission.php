<?= $this->extend('layouts/template'); ?>

<?= $this->Section('content'); ?>

<style>
    .card-body.p-0 table > thead > tr > th:first-of-type,
    .card-body.p-0 table > thead > tr > th:last-of-type,
    .card-body.p-0 table > tbody > tr > td:first-of-type,
    .card-body.p-0 table > tbody > tr > td:last-of-type {
        padding: .75rem !important;
    }

    .custom-control {
        padding-left: 2rem;
    }
</style>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">    </h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Manage Permisssion for <?= $group->title?></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="<?= url_to('group-manage-permission-update', $group->id) ?>" method="POST">
                            <?= csrf_field() ?>
                                <div class="row">
                                    <?php $key_checkbox = 1; ?>
                                    <?php foreach ($permission_by_categories as $key_category => $category) : ?>
                                    <div class="col-sm-6">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="card-title"><?= $category->category_name ?></h3>
                                            </div>
                                            <div class="card-body p-0">
                                                <table id="group_table" class="table table-bordered table-hover">
                                                    <thead>
                                                        <tr class="text-center">
                                                            <th width="50px;">No</th>
                                                            <th>Permission</th>
                                                            <th width="50px;">
                                                                <div class="form-group mb-0">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input 
                                                                            id="permission_group_checkbox_<?= $category->category_name ?>" 
                                                                            class="custom-control-input checkbox-group-control" 
                                                                            type="checkbox"
                                                                            <?=($category->is_checked) ? 'checked' : '' ?>
                                                                        >
                                                                        <label for="permission_group_checkbox_<?= $category->category_name ?>" class="custom-control-label"></label>
                                                                    </div>
                                                                </div>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($category->permissions as $key_permission => $permission) : ?>
                                                        <tr class="text-center">
                                                            <td><?= $key_permission + 1 ?></td>
                                                            <td class="text-left"><?= $permission->name ?></td>
                                                            <td>
                                                                <div class="form-group">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input 
                                                                            id="permission_checkbox_<?=$key_checkbox ?>" 
                                                                            name="selected_permission[]" 
                                                                            class="custom-control-input checkbox-permission-control" 
                                                                            type="checkbox" 
                                                                            value="<?=$permission->id ?>" 
                                                                            <?=($permission->is_group_has_permisssion) ? 'checked' : '' ?>
                                                                        >
                                                                        <label for="permission_checkbox_<?=$key_checkbox ?>" class="custom-control-label"></label>
                                                                        <?php $key_checkbox++; ?>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <?php endforeach ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach ?>
                                </div>

                                <div class="row mt-5">
                                    <div class="col-sm-12">
                                        <div class="text-right">
                                            <a href="<?= url_to('group') ?>" type="button" class="btn btn-secondary">Cancel</a>
                                            <button type="submit" class="btn btn-success" id="btn_save_permission">Save</button>
                                        </div>
                                    </div>
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


<?= $this->Section('page_script'); ?>
<script type="text/javascript">
    $('.checkbox-group-control').on('click', function(e) {
        let is_checked = $(this).prop('checked');
        let table = $(this).parents('table');
        table.find('.checkbox-permission-control').prop('checked',is_checked);

    })
</script>
<?= $this->endSection('page_script'); ?>


