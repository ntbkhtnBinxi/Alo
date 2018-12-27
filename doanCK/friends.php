<?php 
require_once 'function.php';
$modal = new XuLy;
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	if(isset($_POST['accept'])){
		$user2Id = $_POST['accept'];
		$modal->AddReletion($_SESSION['idUser'],$user2Id);
		$ban = "Thêm bạn thành công";
	}
	if(isset($_POST['notaccept'])){
		$user2Id = $_POST['notaccept'];
		$modal->RemoveReletion($_SESSION['idUser'],$user2Id);
		$ban="Đã hủy kết bạn";
	}
}

$currentuser = $modal->SelectUserById($_SESSION['idUser']);
$listfriend = $modal->SelectAllFriends($_SESSION['idUser']);
$listfriendrequest = $modal->SelectRequestAddFriend($_SESSION['idUser']);
$i = 1;
?>
<?php require 'header.php'; ?>

<?php require 'header.php'; ?>

<div class="container">
	<?php require 'navBarHome.php'; ?>
	<br>
	<h2>BẠN BÈ</h2>
	<br>
	<br>
	<div class="row">
		<?php if (!empty($listfriendrequest)): ?>
			<div class="col ">

			</div>
			<div class="col-4">
				<h2>Yêu cầu kết bạn</h2>
			</div>
			<div class="col">

			</div>
			
			<?php foreach ($listfriendrequest as $key): ?>
				<?php $user = $modal->SelectUserById($key->user1Id) ?>
				<?php if ($i % 4 == 1): ?>
				</div>
				<div class = row>
				<?php endif ?>
				<center>
					<div class = col - 4>
						<div class="card" style="width: 21.5rem;">
							<img src="..." class="card-img-top" alt="...">
							<div class="card-body">
								<h5 class="card-title"><?php echo $user->fullname ?></h5>
								<p class="card-text">Đã gửi yêu cầu kết bạn với bạn</p>
								<center><form action="info.php" method="POST" >
									<button type="submit" name ="accept" class="btn btn-primary" formenctype="multipart/form-data" value="<?php echo $user->id ?>">Đồng ý</button>
									<button type="submit" class="btn btn-primary" name="notaccept" formenctype="multipart/form-data" value="<?php echo $user->id ?>">Hủy yêu cầu</button>
								</form></center>
							</div>
						</div>
					</div>
				</center>
				
				<?php if ($i % 4 == 1): ?>
				<?php endif ?>
				<?php $i = $i + 1 ?>
			<?php endforeach ?>
		</div>
	<?php endif ?>
</div>
<div class="row">
	<?php if (!empty($listfriend)): ?>
		<div class="col">

		</div>
		<div class="col">
			<h2>Danh sách bạn bè</h2>
		</div>
		<div class="col">

		</div>
		<?php foreach ($listfriend as $key): ?>
			<?php $user = $modal->SelectUserById($key->user1Id) ?>
			<?php if ($i % 4 == 1): ?>
			</div>
			<div class = row>
			<?php endif ?>
			<center>
				<div class = col - 4>
					<div class="card" style="width: 21.5rem;">
						<img src="..." class="card-img-top" alt="...">
						<div class="card-body">
							<h5 class="card-title"><?php echo $user->fullname ?></h5>
							<p class="card-text">Là bạn bè của bạn</p>
							<center><form action="info.php" method="POST" >
								<button type="submit" class="btn btn-danger" name="deletefriend" formenctype="multipart/form-data" value="<?php echo $user->id ?>">Hủy kết bạn</button>
							</form></center>
						</div>
					</div>
				</div>
			</center>
			<?php if ($i % 4 == 1): ?>
			<?php endif ?>
			<?php $i = $i + 1 ?>
		<?php endforeach ?>
	</div>
<?php endif ?>
</div>
<?php require 'Footer.php'; ?>