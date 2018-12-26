<?php 
require_once 'function.php';
$modal = new XuLy;

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	if(isset($_POST['changeinfo'])){
		$modal->ChangeInfo($_POST['fullname'],$_POST['phone'],$_SESSION['idUser']);
		$ban="Thay đổi thành công";
	}
	if(isset($_FILES['avatar'])){
		$avatar = new XuLy();
		$fileTemp = $_FILES['avatar']['tmp_name'];
		$fileName = "avatar/" . $_FILES['avatar']['name'];
		$result = move_uploaded_file($fileTemp, $fileName);
		if ($result) {
			$name = $_FILES['avatar']['name'];
			$avatar->AddAvatar($_SESSION['idUser'],$name);
		}
	}
}
$currentuser = $modal->SelectUserById($_SESSION['idUser']);
?>
<?php require 'header.php'; ?>

<div class="container">
	<?php require 'navBarHome.php'; ?>
	<br>
	<h2>THÔNG TIN CÁ NHÂN</h2>
	<br>
	<br>
	<center>
		<div class="card" style="width: 40rem;">
			<img src="avatar/<?php if($currentuser->avatar!=null){
				echo $currentuser->avatar;
				}else{
					echo "default.jpg";
				} ?>" height="150" class="rounded" alt="..." >
				

				<div class="card-body">
					<h5 class="card-title"><?php echo $currentuser->fullname ?></h5>
					<p class="card-text">Email: <?php echo $currentuser->email ?></p>
					<p class="card-text">Phone: <?php echo $currentuser->phone ?></p>
					<!-- Button trigger modal -->
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
						Cập nhật thông tin
					</button>

					<!-- Modal -->

					<!-- Button trigger modal -->
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
						Cập nhật ảnh đại diện
					</button>

					<!-- Modal -->

				</div>
			</div>
		</center>
		<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalCenterTitle">Cập nhật thông tin</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form action="info.php" method="POST">
						<div class="modal-body">
							<div class="input-group input-group-sm mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text" id="inputGroup-sizing-sm">FullName</span>
								</div>
								<input type="text" name="fullname" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
							</div>
							<div class="input-group input-group-sm mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text" id="inputGroup-sizing-sm">Phone</span>
								</div>
								<input type="text" name="phone" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
							</div>
							<button type="submit" name="changeinfo" class="btn btn-outline-primary">Save Changes</button>
						</div>
					</form>

				</div>
			</div>
		</div>
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Ảnh đại diện</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form action="info.php" method="POST" enctype="multipart/form-data">
							<div class="form-group">
								<label>Ảnh đại diện</label>
							</div>
							<input type="file" class="form-control" name="avatar">
							<br>
							<button type="submit" class="btn btn-outline-info" name="upAvatar">Changes</button>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-9">
			  	
			</div>
			<div class="col-3">
			</div>
		</div>
	</div>
	<?php require 'Footer.php'; ?>