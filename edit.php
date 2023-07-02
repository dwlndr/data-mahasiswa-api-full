<!DOCTYPE html>
<html lang="en">
    <?php
    require_once "model.php";
    ?>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Data Mahasiswa</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
<script>
$(document).ready(function(){
	// Activate tooltip
	$('[data-toggle="tooltip"]').tooltip();
});
</script>
</head>
<body>
<nav class="navbar fixed-top bg-dark border-bottom border-bottom-dark " role="navigation" style="padding:20px;">
    <div class="container-fluid">
      <span class="navbar-brand mb-0 h1 center" style="font-size:30px; color:white;">CRUD Data Mahasiswa</span>
    </div>
</nav>
<div class="container-lg" style="margin-top:8%; margin-bottom: 20px;">
      <div class="card" style="border:0;">
        <div>
          <h3 class="display-6">Edit Data Mahasiswa</h3>
        </div>
      </div>
</div>
<div class="container-xl">
	<div class="table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<!-- <div class="col-sm-6">
						<a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New</span></a>
						<a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Delete</span></a>						
					</div> -->
				</div>
			</div>
            <?php
			$nim = $_GET['nim'];
			$data = model::callAPI('GET','localhost:8080/api/students/'.$nim, false);
			$data = json_decode($data,true);
			?>
            <form action="simpanedit.php" method="POST">					
                <div class="form-group">
						<label>NIM</label>
						<input type="text" class="form-control" required name="nim" value="<?php echo $data[0]['nim'];?>">
					</div>
					<div class="form-group">
						<label>Nama</label>
						<input type="text" class="form-control" required name="nama" value="<?php echo $data[0]['nama'];?>">
					</div>
					<div class="form-group">
						<label>Angkatan</label>
						<input type="text" class="form-control" required name="angkatan" value="<?php echo $data[0]['angkatan'];?>">
					</div>
                    <div class="form-group">
						<label>Semester</label>
						<input type="text" class="form-control" required name="semester" value="<?php echo $data[0]['semester'];?>">
					</div>
                    <div class="form-group">
						<label>IPK</label>
						<input type="text" class="form-control" required name="ipk" value="<?php echo $data[0]['IPK'];?>">
					</div>
                    <div class="form-group">
						<label>Email</label>
						<input type="email" class="form-control" required name="email" value="<?php echo $data[0]['email'];?>">
					</div>
                    <div class="form-group">
						<label>Telepon</label>
						<input type="text" class="form-control" required name="telepon" value="<?php echo $data[0]['telepon'];?>">
					</div>					
				</div>
				<div class="modal-footer">
                    <a href="index.php" class="btn btn-outline-dark" data-dismiss="modal" value="Cancel">Cancel</a>&nbsp;&nbsp;
					<input type="submit" class="btn btn-outline-info" value="Save">
				</div>
			</form>
        </div>
    </div>
</div>
<script src="https://kit.fontawesome.com/73be1eb700.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="assets/js/jquery-3.7.0.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
</body>
</html>