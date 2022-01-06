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
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
        <div class="content">
            <div class="row">
                <div class="container-fluid">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">
                                    <form class="form-inline ml-3" method="get" action="">
                                        <div class="input-group input-group-sm">
                                            <input class="form-control form-control-navbar" name="q"
                                                value="<?php echo $querysting; ?>" type="search" placeholder="Search"
                                                aria-label="Search">
                                            <div class="input-group-append">
                                                <button class="btn btn-navbar" type="submit">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-tools">
                                    <a href="<?php echo base_url() . 'admin/category/create/'; ?>"
                                        class="btn btn-primary"> <i class="fas fa-plus"></i> Create</a>
                                </div>
                                <div class="col-md-6 offset-md-3">
                                    <?php if ($this->session->flashdata()) { ?>
                                    <div class="alert alert-success">
                                        <?= $this->session->flashdata('message') ?>
                                    </div>
                                    <?php } ?>
                                </div>
                                <div class="card-body">

                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col ">#</th>
                                                <th scope="col">Name</th>
                                                <th width="150" scope="col">Status</th>
                                                <th width="200" scope="col">Action</th>

                                            </tr>
                                        </thead>

                                        <?php foreach ($rows as $row) { ?>
                                        <tbody>
                                            <tr>
                                                <td><?php echo $row['id']; ?></td>
                                                <td><?php echo $row['name']; ?></td>


                                                <td>
                                                    <?php if ($row['status'] == 1) { ?>
                                                    <span class="badge badge-success">Active</span>
                                                    <?php } else { ?>
                                                    <span class="badge badge-danger">Block</span>
                                                    <?php  } ?>
                                                </td>
                                                <td>
                                                    <a class="btn btn-primary"
                                                        href="<?php echo base_url() . 'admin/Category/edit/' . $row['id']; ?>"><i
                                                            class="fas fa-edit"></i>Edit</a>
                                                    <a class="btn btn-danger"
                                                        href="<?php echo base_url() . 'admin/Category/delete/' . $row['id']; ?>"><i
                                                            class="fas fa-trash-alt"></i>Delete</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <?php } ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- /.row -->

</div><!-- /.container-fluid -->






<?php $this->load->view('admin/footer'); ?>