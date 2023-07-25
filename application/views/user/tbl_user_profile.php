<link href="<?= base_url() ?>assets/plugins/bootstrap-sweetalert/sweet-alert.css" rel="stylesheet" type="text/css">
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Profile</title>
</head>
<body>
<div class="content-wrapper">
    <section class="content">
        <div class="box box-warning box-solid">
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h4>Edit Profile</h4>
          </div>
          <div class="card-body">
          <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
              <!-- Full Name -->
              <div class="form-group" hidden>
                <label for="full_name">Full Name</label>
                <input type="text" class="form-control" id="id_users" name="id_users" value="<?php echo $id_users?>">
              </div>
              <div class="form-group">
                <label for="full_name">Full Name</label>
                <input type="text" class="form-control" id="full_name" name="full_name" value="<?php echo $full_name?>">
              </div>

              <!-- Phone Number -->
              <div class="form-group">
                <label for="no_hp">Phone Number</label>
                <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?php echo $no_hp?>">
              </div>

              <!-- Gender -->
              <div class="form-group">
                <label for="jenis_kelamin">Gender</label>
                <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                  <option value="Laki-laki">Laki-laki</option>
                  <option value="Perempuan">Perempuan</option>
                </select>
              </div>

              <!-- Email -->
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $email?>">
              </div>

              <!-- Password -->
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" value="<?php echo $password?>">
              </div>

              <!-- Images -->
              <div class="form-group">
                <label for="images">Upload Image</label>
                <input type="file" class="form-control-file" id="images" name="images">
              </div>

              <button type="submit" class="btn btn-primary">Save Changes</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</section>
</div>
</body>
</html>
