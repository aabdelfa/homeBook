<?php include_once('../includes/layouts/header.php') ?>
<!-- Page Content -->
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Profile</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Edit your profile information
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <form id="profileForm">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input required id="username" class="form-control" value="<?php echo $username ?>" placeholder="Enter Username">
                                </div>
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input required id="first_name" class="form-control" value="<?php echo $firstName ?>" placeholder="Enter First Name">
                                </div>
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input required id="last_name" class="form-control" value="<?php echo $lastName ?>" placeholder="Enter Last Name">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input id="password" type="password" class="form-control" placeholder="Update Password">
                                </div>
                                <div id="passwordCheck" class="form-group">
                                    <label>Confirm Password</label>
                                    <input id="password2" type="password" class="form-control" placeholder="Enter Password Again">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input required id="email" type="email" value="<?php echo $email; ?>" class="form-control" placeholder="Enter Email">
                                </div>
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <input required id="phone" type="tel" class="form-control" value="<?php echo $phone; ?>" placeholder="Enter Phone Number">
                                </div>
                                <button id="submitButton" type="submit" class="btn btn-primary" >Submit</button>
                                <a href="welcome" type="reset" class="btn btn-default">Cancel</a>
                            </form>
                        </div>
                        <!-- /.col-lg-6 (nested) -->
                         <div class="col-md-6">
                            <div class="form-group">
                            <label>Current Profile Picture</label>
                                <img src="../images/<?php echo $image; ?>" class="img-thumbnail" alt="Responsive image">
                            </div>
                            <form id="profileImage" role="form" enctype="multipart/form-data" action="../Controllers/profileController.php?imageUpload=true" method="post">
                                <div class="form-group">
                                    <label>Change Profile Picture</label>
                                    <input name="image" id="image" accept="image/*" type="file">
                                </div>
                                <button id="imageSubmit" type="submit" class="btn btn-primary hidden">Upload</button>
                            </form>   
                         </div>
                         <!-- /.col-lg-6 (nested) -->
                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->

<?php include_once('../includes/layouts/footer.php'); ?>
<script type="text/javascript" src="../vendor/igorescobar/jquery.mask.min.js"></script>
<script type="text/javascript" src="../vendor/pNotify/js/pNotify.js"></script>
<script type="text/javascript" src="../js/profile.js"></script>