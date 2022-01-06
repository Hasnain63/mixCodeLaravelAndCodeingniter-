<?php $this->load->view('admin/header'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Categories </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Categories</li>
                    </ol>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
        <div class="content">
            <div class="row">
                <div class="container-fluid">
                    <div class="col-md-12">
                        <div class="card-primary">
                            <div class="card-header">
                                <div class="card-title">
                                    Create New Category
                                </div>

                                <div class="card-tools">
                                    <a href="<?php echo base_url() . 'admin/category/create/'; ?>"
                                        class="btn btn-primary">
                                        <i class="fas fa-plus"></i> Create</a>
                                </div>
                            </div>
                            <div class="card-body">

                                <form name="categoryName" id="categoryForm" method="post" enctype="multipart/form-data"
                                    action="<?php echo base_url() . 'admin/Category/create'; ?>">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" name="name" value="<?php echo set_value('name'); ?>"
                                            id="name" value="" class="form-control">

                                    </div>
                                    <?php echo (!empty($error)) ? $error : ""; ?>


                                    <div> <?php echo form_error('name'); ?></div>
                                    <div class="form-group">
                                        <label>Image</label>
                                        <input type="file" name="image" class='form-control'
                                            value="<?php echo set_value('image'); ?>" id="image">
                                    </div>

                                    <div class="custom-control custom-radio float-left">
                                        <input class="form-check-input" value="1" type="radio" id="statusActive"
                                            name="status" checked="">
                                        <label for="statusActive" class="custom-control-lable">Active</label>
                                    </div>
                                    <div class="custom-control custom-radio float-left">
                                        <input class="form-check-input" value="0" type="radio" id="statusBlock"
                                            name="status">
                                        <label for="statusBlock" class="custom-control-lable">Block</label>
                                    </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="<?php echo base_url() . 'admin/Category/'; ?>"
                                    class="btn btn-secondary">Back</a>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- /.row -->

</div><!-- /.container-fluid -->






<?php $this->load->view('admin/footer'); ?>