<?php 
require_once 'function.php';
$modal = new XuLy;
if($_SERVER['REQUEST_METHOD'] != 'POST')
{
	$template = 1;
}
if($_SERVER['REQUEST_METHOD'] == 'POST')
{

	if(isset($_POST['deleteSendInvite']))
	{
		$template = 1;
		$user1 = $modal->SelectUserById($_SESSION['idUser']);
		$user2id = $_POST['deleteSendInvite'];
		$modal->RemoveReletion($user1->id,$user2id);
	}

	if(isset($_POST['accept']))
	{
		$template = 1;
		
		$user1 = $modal->SelectUserById($_SESSION['idUser']);
		$user2id = $_POST['accept'];
		$modal->AddReletion($user1->id,$user2id);
	}
	if(isset($_POST['notaccept']))
	{
		$template = 1;
		$user1 = $modal->SelectUserById($_SESSION['idUser']);
		$user2id = $_POST['notaccept'];
		$modal->RemoveReletion($user1->id,$user2id);
	}
	if(isset($_POST['DeleteFriend']))
	{
		$template = 1;
		$user1 = $modal->SelectUserById($_SESSION['idUser']);
		$user2id = $_POST['DeleteFriend'];
		$modal->RemoveReletion($user1->id,$user2id);
	}
	if(isset($_POST['profileSendRequest'])){
		$template = 3;
		$profileUser = $modal->SelectUserById($_POST['profileSendRequest']);
	}
	if(isset($_POST['profileBeSendRequest'])){
		$template = 4;
		$profileUser = $modal->SelectUserById($_POST['profileBeSendRequest']);
	}
	if(isset($_POST['profileFriend'])){
		$template = 5;
		$profileUser = $modal->SelectUserById($_POST['profileFriend']);
	}
	if(isset($_POST['profile'])){
		$template = 2;
		$profileUser = $modal->SelectUserById($_POST['profile']);
	}
	if(isset($_POST['sendRequest'])){
		$template = 1;
		$profileUser = $modal->SelectUserById($_POST['sendRequest']);
		$user1 = $modal->SelectUserById($_SESSION['idUser']);
		$user2id = $_POST['sendRequest'];
		$modal->AddReletion($user1->id,$user2id);
	}

	if(isset($_POST['changeinfo'])){
		$template = 1;
		$modal->ChangeInfo($_POST['fullname'],$_POST['phone'],$_SESSION['idUser']);
		$ban="Thay đổi thành công";
	}
	if(isset($_FILES['avatar'])){
		$template = 1;
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
$listUser = $modal->LoadAllUser($currentuser->id);
$listRequest = $modal->SelectRequestAddFriend($currentuser->id);
$listSendRequest = $modal->SelectSendRequestAddFriend($currentuser->id);
$listFriend = $modal->SelectAllFriends($currentuser->id);
?>
<?php require 'header.php'; ?>

<div class="container">
	<?php require 'navBarHome.php'; ?>
	<br>
	<h2>THÔNG TIN CÁ NHÂN</h2>
	<br>
	<br>
	<div class="row">
		<div class="col-8">
			<center>
				<div class="card" style="width: 43rem;">
					<img src="avatar/<?php if($currentuser->avatar!=null){
						echo $currentuser->avatar;
						}else{
							echo "default.jpg";
						} ?>" height="150" class="rounded" alt="..." >

						 <!--Thông tin người dùng-->
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
			</div>
			<div class="col-4">
				<div class="card">
					<div class="card-body">
						<form style="margin-left: 0.5rem" style="margin-bottom: 10px" class="form-inline my-3 my-lg-3" action="Find.php" method="POST">
							<input class="form-control mr-sm-2" type="search" placeholder="Search" name="keysreach" aria-label="Search">
							<button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="sreachF">Search</button>
						</form>


						 <!--Đề xuất kết bạn-->
						<?php if ($template == 1): ?>
							<div class="card" style="margin-top: 10px;">
								<div class="card-block" style="margin-left: 10px; margin-bottom: 10px; padding-bottom: 5px;" >
									<center>
										<h4 style="padding-top: 5px;padding-bottom: 5px;" class="card-title">Đề cử kết bạn</h4>
									</center>
									<?php foreach ($listUser as $list): ?>
										<?php $userP = $modal->SelectUserById($list->id) ?>
										<form style="padding-top: 5px" method="POST" action="info.php"><button style="margin-left: 1rem" action="info.php" class="
											btn btn-outline-primary" name = "profile" value="<?php echo $userP->id ?>" ><?php echo $userP->fullname ?></button></form>
									<?php endforeach ?>
									
								</div>
							</div>
							
							<!--Danh sách bạn bè-->
							<?php if (!empty($listFriend)): ?>
								<div class="card" style="margin-top: 10px;">
									<div class="card-block" style="margin-left: 10px; margin-bottom: 10px" >
										<center>
											<h4 style="padding-top: 5px"  style="padding-bottom: -2px" class="card-title">Danh sách bạn bè</h4>
										</center>
										<?php foreach ($listFriend as $listF): ?>
										<?php $userF = $modal->SelectUserById($listF->user1Id) ?>
										<form style="padding-top: 5px" method="POST" action="info.php">
											<button style="margin-left: 1rem" action="info.php" class="btn btn-outline-primary" name = "profileFriend" value="<?php echo $userF->id ?>" ><?php echo $userF->fullname ?>
											</button>
										</form>
									<?php endforeach ?>
									</div>
								</div>
							<?php endif ?>

							 <!--Danh sách Lời mời kết bạn-->
							<?php if (!empty($listRequest)): ?>
								<div class="card" style="margin-top: 10px;">
									<div class="card-block" style="margin-left: 10px; margin-bottom: 10px" >
										<center>
											<h4 style="padding-top: 5px"  style="padding-bottom: -2px" class="card-title">Lời mời kết bạn</h4>
										</center>
										<?php foreach ($listRequest as $listR): ?>
										<?php $userR = $modal->SelectUserById($listR->user1Id) ?>
										<form style="padding-top: 5px" method="POST" action="info.php">
											<button style="margin-left: 1rem" action="info.php" class="btn btn-outline-primary" name = "profileSendRequest" value="<?php echo $userR->id ?>" ><?php echo $userR->fullname ?>
											</button>
										</form>
									<?php endforeach ?>
									</div>
								</div>
							<?php endif ?>

							 <!--Danh sách được gửi lời mời-->
							<?php if (!empty($listSendRequest)): ?>
								<div class="card" style="margin-top: 10px;">
									<div class="card-block" style="margin-left: 10px; margin-bottom: 10px" >
										<center>
											<h4 style="padding-top: 5px"  style="padding-bottom: -2px" class="card-title">Bạn đang gửi lời mời kết bạn tới</h4>
										</center>
										<?php foreach ($listSendRequest as $listS): ?>
										<?php $userS = $modal->SelectUserById($listS->user2Id) ?>
										<form style="padding-top: 5px" method="POST" action="info.php">
											<button action="info.php" style="margin-left: 1rem" class="btn btn-outline-primary" name = "profileBeSendRequest" value="<?php echo $userS->id ?>" ><?php echo $userS->fullname ?>
											</button>
										</form>
									<?php endforeach ?>
									</div>
								</div>
							<?php endif ?>
						<?php endif ?>


						 <!--Profile bạn đề cử-->
						<?php if ($template == 2): ?>
							<center>
								<div class="card" style="width: 18rem;">
									<img class="card-img-top" src="avatar/<?php echo $profileUser->avatar ?>" alt="Card image cap">
									<div class="card-body">
										<h5 class="card-title"><?php echo $profileUser->fullname ?></h5>
										<p class="card-text">Không phải là bạn của bạn</p>
										<form action="info.php" method="POST">
											<button class="btn btn-outline-primary" name ="sendRequest" style="submit" value="<?php echo $profileUser->id ?>">Gửi lời mời kết bạn</button>
										</form>
									</div>
								</div>
							</center>
						<?php endif ?>

						<!--Profile bạn -->
						<?php if ($template == 5): ?>
							<center>
								<div class="card" style="width: 18rem;">
									<img class="card-img-top" src="avatar/<?php echo $profileUser->avatar ?>" alt="Card image cap">
									<div class="card-body">
										<h5 class="card-title"><?php echo $profileUser->fullname ?></h5>
										<p class="card-text">Đang là bạn bè với bạn</p>
										<form action="info.php" method="POST">
											<button class="btn btn-outline-primary" name ="DeleteFriend" style="submit" value="<?php echo $profileUser->id ?>">Xóa bạn bè</button>
										</form>
									</div>
								</div>
							</center>
						<?php endif ?>
						

						 <!--Profile người gửi lời mời-->
						<?php if ($template == 3): ?>
							<center>
								<div class="card" style="width: 18rem;">
									<img class="card-img-top" src="avatar/<?php echo $profileUser->avatar ?>" alt="Card image cap">
									<div class="card-body">
										<h5 class="card-title"><?php echo $profileUser->fullname ?></h5>
										<p class="card-text">Đã gửi lời mời kết bạn tới bạn</p>
										<form action="info.php" method="POST">
											<button class="btn btn-outline-primary" name ="accept" style="submit" value="<?php echo $profileUser->id ?>">Đồng ý</button>
											<button class="btn btn-outline-primary" name ="notaccept" style="submit" value="<?php echo $profileUser->id ?>">Xóa lời mời kết bạn</button>
										</form>
									</div>
								</div>
							</center>
						<?php endif ?>
						<!--Profile người được gửi lời mời-->
						<?php if ($template == 4): ?>
							<center>
								<div class="card" style="width: 18rem;">
									<img class="card-img-top" src="avatar/<?php echo $profileUser->avatar ?>" alt="Card image cap">
									<div class="card-body">
										<h5 class="card-title"><?php echo $profileUser->fullname ?></h5>
										<p class="card-text">Bạn đang gửi lời mời kết bạn với người này</p>
										<form action="info.php" method="POST">
											<button class="btn btn-outline-primary" name ="deleteSendInvite" style="submit" value="<?php echo $profileUser->id ?>">Hủy lời mời</button>
										</form>
									</div>
								</div>
							</center>
						<?php endif ?>

					</div>
				</div>
			</div>
		</div>
		
		<!--Modal Cập nhật thông tin-->
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
		<!--Modal up ảnh đại diện-->
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
	</div>
	<?php require 'Footer.php'; ?>