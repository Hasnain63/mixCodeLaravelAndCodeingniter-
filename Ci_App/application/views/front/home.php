<?php $this->load->view('front/header'); ?>
<div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="<?php echo base_url('public/images/slide1.jpg'); ?>" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="<?php echo base_url('public/images/slide2.jpg'); ?>" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="<?php echo base_url('public/images/slide3.jpg'); ?>" class="d-block w-100" alt="...">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
<div class="container mt-4">
    <h3 class="pb-4">About Company</h3>
    <p class="text-muted">Many users already have downloaded jQuery from Google when visiting another site. As a
        result,
        it will be loaded from cache when they visit your site, which leads to faster loading time. Also, most
        CDN's will make sure that once a user requests a file from it, it will be served
        from the server closest to them, which also leads to faster loading time.</p>
    <p class="text-muted">Use data attributes to easily control the position of the carousel.
        data-bs-slide accepts the keywords prev or next, which alters the slide position relative to its current
        position. Alternatively, use data-bs-slide-to to pass a raw slide index to
        the carousel data-bs-slide-to="2", which shifts the slide position to a particular index beginning with
        0.</p>
</div>
<div class="bg-light">
    <div class="container pt-4">
        <h3 class="pb-4">Our Services</h3>
        <div class="row">
            <div class="col-md-3">
                <div class="card h-100">
                    <img src="<?php echo base_url('public/images/box1.jpg'); ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Web Development</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the
                            bulk of the card's content.</p>
                    </div>
                </div>

            </div>

            <div class="col-md-3">
                <div class="card h-100">
                    <img src="<?php echo base_url('public/images/box2.jpg'); ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Web Designing</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the
                            bulk of the card's content.</p>


                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card h-100">
                    <img src="<?php echo base_url('public/images/box3.jpg'); ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Mobile App Development</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the
                            bulk of the card's content.</p>


                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card h-100">
                    <img src="<?php echo base_url('public/images/box4.jpg'); ?>" class="card-img-top" alt="...">
                    <div class="card-body ">
                        <h5 class="card-title">Unity Games</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the
                            bulk of the card's content.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
<div class="bg-light">
    <div class="container pt-4">
        <h3 class="pb-4">Latest Blog</h3>
        <div class="row">
            <?php foreach ($rows as $row) { ?>
            <div class="col-md-3">
                <div class="card h-100">
                    <?php if ($row['image'] != "" && file_exists('./public/upload/article/' . $row['image'])) { ?>
                    <img src="<?php echo base_url() . 'public/upload/article/' . $row['image']; ?>">
                    <?php } else { ?>

                    <img src="<?php echo base_url() . 'public/upload/categories/no-image-icon-15.png'; ?>">

                    <?php   } ?>
                    <div class="card-body">

                        <p class="card-text"><?php echo $row['title']; ?></p>
                    </div>
                </div>

            </div>
            <?php     } ?>
        </div>
    </div>

</div>
<?php $this->load->view('front/footer'); ?>