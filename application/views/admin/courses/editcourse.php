<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">
        
        <?php $this->load->view('includes/admin/topbar'); ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800"></h1>
            
            <!-- Page Heading -->
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Update [<?php echo $course->name; ?>] Course <?php if($msg) : ?><small><span class="badge badge-success"><?php echo $msg; ?></span></small><?php endif; ?></h2>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="<?php echo base_url()?>portal/courses" class="btn btn-success"><i class="material-icons">&#xE147;</i> <span>Go Back To Courses</span></a>
                    </div>
                </div>
            </div>
            
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Here you can update a course</h6>
                </div>
                <div class="card-body">
                    <div class="table-wrapper">
                        <form action="<?= base_url() ?>portal/edit_course/<?php echo $course->id; ?>" method="post">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" name="name" class="form-control" value="<?php echo $course->name; ?>" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Abbreviation</label>
                                        <input type="text" name="shortname" class="form-control" value="<?php echo $course->shortname; ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="description" class="form-control" required><?php echo $course->description; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="id" value="<?php echo $course->id; ?>" />
                                <input type="submit" name="update_course" class="btn btn-success" value="Update">
                                <a href="<?php echo base_url('portal/courses')?>" class="btn btn-danger">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <?php $this->load->view('includes/admin/copyright'); ?>
    
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

</div>
<!-- End of Content Wrapper -->