<?php $this->load->view('front/header'); ?>
<div class="container">
    <h3 class="pb-4 pt-4">
        Blog
    </h3>
    <div class="row">
        <?php foreach ($rows as $row) { ?>

        <div class="col-md-4 pt-4 pb-4 mt-4">

            <?php if ($row['image'] != "" && file_exists('./public/upload/article/' . $row['image'])) { ?>
            <img class="w-100 rounded" src="<?php echo base_url() . 'public/upload/article/' . $row['image']; ?>">
            <?php } else { ?>

            <img width="300" src="<?php echo base_url() . 'public/upload/categories/no-image-icon-15.png'; ?>">

            <?php   } ?>
        </div>
        <div class="col-md-8">
            <p class="pb-2 pl-2n bg-light">
                <a href="<?php echo base_url('Blog/categories'); ?>"
                    class="text-muted text-uppercase"><?php echo $row['category_name']; ?></a>
            </p>
            <h3>
                <a href="<?php echo base_url('Blog/detail/' . $row['id']); ?>"><?php echo $row['title']; ?></a>
            </h3>
            <p class="text-muted"><?php echo word_limiter(strip_tags($row['discription']), 30); ?>
                <a href="<?php echo base_url('Blog/detail/' . $row['id']); ?>">Readmore</a>
            </p>
            <p class="text-muted">Posted By <strong><?php echo $row['author']; ?></strong> on
                <strong><?php echo $row['created_at']; ?></strong>
            </p>

        </div>
        <?php } ?>
    </div>
    <div class="col-md-12 pull-left">
        <?php echo $pagination_links; ?>
    </div>
</div>

<?php $this->load->view('front/footer'); ?>