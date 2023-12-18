<?= $this->extend('layouts/template'); ?>

<?= $this->Section('content'); ?>

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
                            <h3 class="card-title">Manage Permisssion</h3>
                            <div class="d-flex justify-content-end mb-1">
                                <a href="<?= url_to('group-create') ?>" class="btn btn-success mb-2" id="btn_modal_create">Create</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <?php $key_checkbox = 1; ?>
                                <?php foreach ($permission_by_categories as $key_category => $category) : ?>
                                <div class="col-sm-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title"><?= $key_category?></h3>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <table id="group_table" class="table table-bordered table-hover">
                                            <thead>
                                                <tr class="text-center">
                                                    <th>No</th>
                                                    <th>Permission</th>
                                                    <th>
                                                        <div class="form-group mb-0">
                                                            <div class="custom-control custom-checkbox">
                                                                <input 
                                                                    id="permission_group_checkbox_<?=$key_category ?>" 
                                                                    class="custom-control-input checkbox-group-control" 
                                                                    type="checkbox" 
                                                                >
                                                                <label for="permission_group_checkbox_<?=$key_category ?>" class="custom-control-label"></label>
                                                            </div>
                                                        </div>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($category as $key_permission => $permission) : ?>
                                                <tr class="text-center">
                                                    <td><?= $key_permission + 1 ?></td>
                                                    <td class="text-left"><?= $permission->name ?></td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="custom-control custom-checkbox">
                                                                <input 
                                                                    id="permission_checkbox_<?=$key_checkbox ?>" 
                                                                    name="selected_permission" 
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
                                    <?php foreach ($category as $key_permission => $permission) : ?>

                                    
                                    <?php endforeach ?>
                                </div>
                                <?php endforeach ?>
                            </div>
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
        console.log(table.find('.checkbox-permission-control').length);
    })
</script>
<?= $this->endSection('page_script'); ?>


