<?php include 'layouts/session.php'; ?>
<?php include 'layouts/main.php'; ?>

    <head>

        <?php includeFileWithVariables('layouts/title-meta.php', array('title' => 'Candidate Grid View')); ?>

        <?php include 'layouts/head-css.php'; ?>

    </head>

    <body>

        <!-- Begin page -->
        <div id="layout-wrapper">

            <?php include 'layouts/menu.php'; ?>

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <?php includeFileWithVariables('layouts/page-title.php', array('pagetitle' => 'Candidate Lists', 'title' => 'Grid View')); ?>

                        <div class="row g-4 mb-3">
                            <div class="col-sm-auto">
                                <div>
                                    <a href="#!" class="btn btn-primary"><i class="ri-add-line align-bottom me-1"></i> Add Candidate</a>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="d-md-flex justify-content-sm-end gap-2">
                                    <div class="search-box ms-md-2 flex-shrink-0 mb-3 mb-md-0">
                                        <input type="text" class="form-control" id="searchJob" placeholder="Search for candidate name or designation..." autocomplete="off">
                                        <i class="ri-search-line search-icon"></i>
                                    </div>

                                    <select class="form-control w-md" data-choices data-choices-search-false>
                                        <option value="All">All</option>
                                        <option value="Today">Today</option>
                                        <option value="Yesterday" selected>Yesterday</option>
                                        <option value="Last 7 Days">Last 7 Days</option>
                                        <option value="Last 30 Days">Last 30 Days</option>
                                        <option value="This Month">This Month</option>
                                        <option value="Last Year">Last Year</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row job-list-row" id="candidate-list">
                            
                        </div>

                        <div class="row g-0 justify-content-end mb-4" id="pagination-element">
                            <!-- end col -->
                            <div class="col-sm-6">
                                <div class="pagination-block pagination pagination-separated justify-content-center justify-content-sm-end mb-sm-0">
                                    <div class="page-item">
                                        <a href="javascript:void(0);" class="page-link" id="page-prev">Previous</a>
                                    </div>
                                    <span id="page-num" class="pagination"></span>
                                    <div class="page-item">
                                        <a href="javascript:void(0);" class="page-link" id="page-next">Next</a>
                                    </div>
                                </div>
                            </div><!-- end col -->
                        </div>
                        <!-- end row -->

                    </div>
                    <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                <?php include 'layouts/footer.php'; ?>
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        <?php include 'layouts/customizer.php'; ?>

        <?php include 'layouts/vendor-scripts.php'; ?>

        <!-- job-candidate-grid js -->
        <script src="assets/js/pages/job-candidate-grid.init.js"></script>

        <!-- App js -->
        <script src="assets/js/app.js"></script>
    </body>

</html>