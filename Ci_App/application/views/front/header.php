<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>

<body>
    <!doctype html>
    <html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <link rel="stylesheet" href="<?php echo base_url('public/css/style.css'); ?>">
        <title>Hello, world!</title>
    </head>

    <body>
        <header class="bg-light pt-4">
            <div class="container ">
                <nav class="navbar navbar-expand-lg navbar-light ml-auto">

                    <a class="navbar-brand" href="<?php echo base_url(); ?>">CI_Web_App</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse right-align" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="<?php echo base_url(); ?>">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo base_url('Page/about'); ?>">About Us</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo base_url('Page/services'); ?>">Services </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="<?php echo base_url('Blog/index'); ?>">Blog</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="<?php echo base_url('Blog/categories'); ?>">Categories</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="<?php echo base_url('Page/contactus'); ?>">Contact Us</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="<?php echo base_url('admin/Login/index'); ?>">Admin login</a>
                            </li>

                        </ul>


                    </div>

                </nav>
            </div>
        </header>