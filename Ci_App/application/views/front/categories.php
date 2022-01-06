<?php $this->load->view('front/header'); ?>
<div class="container">
    <h3 class="pb-4 pt-4">
        Categories
    </h3>
    <div class="row">
        <?php foreach ($rows as $row) { ?>
        <div class="col-md-4 pb-4 pt-4">
            <div class="card h-100">
                <a href="<?php echo base_url('Blog/category/' . $row['id']); ?>">
                    <?php if ($row['image'] != "" && file_exists('./public/upload/categories/' . $row['image'])) { ?>
                    <img class="w-100 rounded"
                        src="<?php echo base_url() . 'public/upload/categories/' . $row['image']; ?>">
                    <?php } else { ?>

                    <img width="410" src="<?php echo base_url() . 'public/upload/categories/no-image-icon-15.png'; ?>">

                    <?php   } ?>
                </a>

                <div class="card-body pb-0 pt-2">
                    <a href="<?php echo base_url('Blog/category/' . $row['id']); ?>">
                        <h5 class="card-title"><?php echo $row['name']; ?></h5>
                    </a>
                </div>
            </div>
        </div>
        <?php } ?>

    </div>
</div>



<?php $this->load->view('front/footer'); ?>