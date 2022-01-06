<?php $this->load->view('front/header'); ?>

<div class="container">
    <h3 class="pb-4 pt-4">
        Blog
    </h3>
    <div class="row">
        <div class="col-md-12">
            <h3>
                <?php echo $rows['title']; ?>
            </h3>
            <div class="d-flex justify-content-between">
                <p class="text-muted">Posted By <strong><?php echo $rows['author'];
                                                        ?></strong> on
                    <strong><?php echo $rows['created_at'];
                            ?></strong>
                </p>
                <a class="pt-2 bg-light text-muted text-uppercase"
                    href="<?php echo base_url('Blog/index'); ?>"><strong><?php echo $rows['category_name']; ?></strong></a>

            </div>

            <?php if ($rows['image'] != "" && file_exists('./public/upload/article/' . $rows['image'])) { ?>
            <img width="1100" src="<?php echo base_url() . 'public/upload/article/' . $rows['image']; ?>">
            <?php } else { ?>

            <img src="<?php echo base_url() . 'public/upload/categories/no-image-icon-15.png'; ?>">

            <?php   } ?>
            <P> <?php echo $rows['discription']; ?></P>
        </div>
        <div class="col-md-6">
            <?php if ($this->session->flashdata()) { ?>
            <div class="alert alert-success">
                <?= $this->session->flashdata('message') ?>
            </div>
            <?php } ?>

            <h3 class="pb-4 ml-5 pt-4">Conemnts</h3>
            <div class="card pb-4 pt-4">
                <div class="card-body">

                    <form action="<?php echo base_url('Blog/detail/' . $rows['id']); ?>" method="post">
                        <label>Name</label>
                        <div class="form-group">
                            <input class="form-control" type="text" value="<?php echo set_value('name'); ?>" name="name"
                                id="name" placeholder=" Name">
                        </div>
                        <?php echo form_error('name'); ?>
                        <div class="form-group pb-4 pt-4">
                            <label>Comment</label>
                            <textarea class="form-control" name="comment" id="comment" placeholder=" write your comment"
                                value="<?php echo set_value('comment'); ?>"></textarea>
                        </div>
                        <?php echo form_error('comment'); ?>

                        <button class="btn btn-primary" type="submit" name="submit">
                            submit</button>
                </div>
                </form>
                <h3 class="pb-4 ml-5 text-muted pt-4">Latest Comment</h3>
                <?php foreach ($comment as $cmnt) {
                ?>
                <h5 class="text-muted"><?php echo $cmnt['name']; ?></h5>
                <p class="text-muted"><?php echo $cmnt['comment']; ?></p>
                <p class="text-muted"> posted on <strong><?php echo $cmnt['created_at']; ?></strong></p>
                <?php  }
                ?>
            </div>

        </div>

    </div>
</div>
<?php $this->load->view('front/footer'); ?>