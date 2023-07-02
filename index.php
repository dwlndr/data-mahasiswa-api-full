<!DOCTYPE html>
<html>
<head>
    <?php
    require_once "model.php";
    ?>
	<title>Data Mahasiswa</title>
</head>
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
<body>
  <nav class="navbar fixed-top bg-dark border-bottom border-bottom-dark" style="padding:20px;">
    <div class="container-fluid">
      <span class="navbar-brand mb-0 h1 center" style="font-size:30px; color:white;">CRUD Data Mahasiswa</span>
    </div>
  </nav>
  <div class="container-lg" style="margin-top:8%;">
      <div class="card" style="border:0;">
        <div>
          <h3 class="display-6">Data Mahasiswa</h3>
        </div>
        <div>
          <a href="#addMahasiswaModal" class="btn btn btn-outline-dark float-end" data-toggle="modal">Tambah Data</a>
        </div>
        <div class="card-body">
				<table class="table table-bordered">
					<thead>
						<tr>
              <th>No</th>
              <th>NIM</th>
              <th>Nama</th>
              <th>Angkatan</th>
              <th>Semester</th>
              <th>IPK</th>
              <th>Email</th>
              <th>Telepon</th>
              <th>Actions</th>
						</tr>
					</thead>
					<tbody>
            <tr>
                <?php
                $no = 1;
                $data = model::callAPI('GET', 'http://localhost:8080/api/students/', false);
                $data = json_decode($data, true);
                foreach ($data as $x) {
                ?>
                <td><?= $no; ?></td>            
                <td><?php echo $x['nim']; ?></td>
                <td><?php echo $x['nama']; ?></td>
                <td><?php echo $x['angkatan']; ?></td>
                <td><?php echo $x['semester']; ?></td>
                <td><?php echo $x['IPK']; ?></td>
                <td><?php echo $x['email']; ?></td>
                <td><?php echo $x['telepon']; ?></td>
              <td>
                <!-- <div class="col">
                  <form action="edit.php" method="GET">
                    <input type="hidden" name="nim" value="<?php  ?>">
                    <button class="btn btn-warning"><i class="fa-thin fa-pen-to-square"></i></button>
                  </form> -->
                <!-- <div class="col">
                  <form action="hapus.php" method="GET">
                    <input type="hidden" name="nim" value="<?php ?>">
                    <button class="btn btn-block btn-danger" onclick="return confirm('Anda yakin ingin menghapus data ini ?')">Hapus</button>
                  </form>
                </div> -->
              <a href="edit.php?nim=<?php echo $x['nim']; ?>"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
              <a href="hapus.php?nim=<?php echo $x['nim']; ?>"><i class="material-icons" data-toggle="tooltip" title="Hapus" style="color:red;" onclick="return confirm('Anda yakin ingin menghapus data ini ?')">&#xE872;</i></a>
              </td>
            </tr>
                <?php $no++; } ?>
              </td>
					</tbody>
				</table>
			</div>
  </div>
<!-- Add Modal HTML -->
<div id="addMahasiswaModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="tambah.php" method="POST">
				<div class="modal-header">						
					<h4 class="modal-title">Tambah Mahasiswa</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<div class="form-group">
						<label>NIM</label>
						<input type="text" class="form-control" required name="nim">
					</div>
					<div class="form-group">
						<label>Nama</label>
						<input type="text" class="form-control" required name="nama">
					</div>
					<div class="form-group">
						<label>Angkatan</label>
						<input type="text" class="form-control" required name="angkatan">
					</div>
          <div class="form-group">
						<label>Semester</label>
						<input type="text" class="form-control" required name="semester">
					</div>
          <div class="form-group">
						<label>IPK</label>
						<input type="text" class="form-control" required name="ipk">
					</div>
          <div class="form-group">
						<label>Email</label>
						<input type="email" class="form-control" required name="email">
					</div>
          <div class="form-group">
						<label>Telepon</label>
						<input type="text" class="form-control" required name="telepon">
					</div>					
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" class="btn btn-success" value="Add">
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