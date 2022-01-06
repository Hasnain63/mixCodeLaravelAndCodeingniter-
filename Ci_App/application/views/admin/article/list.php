<?php $this->load->view('admin/header'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Articles </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Articles</li>
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
                                            <input class="form-control form-control-navbar" name="q" type="search"
                                                value="<?php echo $q; ?>" placeholder="Search" aria-label="Search">
                                            <div class="input-group-append">
                                                <button class="btn btn-navbar" type="submit">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-tools">
                                    <a href="<?php echo base_url() . 'admin/Article/create/'; ?>"
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
                                                <th scope="col ">id</th>
                                                <th scope="col">Tittle</th>
                                                <th width="200" scope="col">Discription</th>
                                                <th width="200" scope="col">Image</th>
                                                <th scope="col">Author</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Action</th>

                                            </tr>
                                        </thead>
                                        <?php foreach ($rows as $row) { ?>
                                        <tbody>
                                            <tr>
                                                <td><?php echo $row['id']; ?></td>
                                                <td><?php echo $row['title']; ?></td>
                                                <td><?php echo base_url() . 'public/upload/article' . $row['discription']; ?>
                                                </td>
                                                <td>
                                                    <?php if ($row['image'] != "" && file_exists('./public/upload/article/' . $row['image'])) { ?>
                                                    <img width="150px"
                                                        src="<?php echo base_url() . 'public/upload/article/' . $row['image']; ?>">
                                                    <?php } else { ?>

                                                    <img width="150px"
                                                        src="<?php echo base_url() . 'public/upload/categories/no-image-icon-15.png'; ?>">

                                                    <?php   } ?>
                                                </td>
                                                <td><?php echo $row['author']; ?></td>
                                                <td>
                                                    <?php if ($row['status'] == 1) { ?>
                                                    <span class="badge badge-success">Active</span>
                                                    <?php } else { ?>
                                                    <span class="badge badge-danger">Block</span>
                                                    <?php  } ?>
                                                </td>

                                                <td>
                                                    <a class="btn btn-sm btn-primary"
                                                        href="<?php echo base_url() . 'admin/Article/edit/' . $row['id']; ?>"><i
                                                            class="fas fa-edit"></i>Edit</a>
                                                    <a class="btn btn-sm btn-danger"
                                                        href="<?php echo base_url() . 'admin/Article/delete/' . $row['id']; ?>"><i
                                                            class="fas fa-trash-alt"></i>Delete</a>
                                                </td>

                                            </tr>
                                        </tbody>
                                        <?php } ?>

                                    </table>

                                </div>
                                <?php echo $pagination_links; ?>
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
<!-- <script type="text/javascript">
function deleteArticle($id) {
    if (confirm("Are your sure to delete Aritcle?")) {
        window.location.href = '<?php echo  base_url() . '/admin/Article/delete'; ?>' + id;
    }

}
</script> -->