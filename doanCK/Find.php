<?php 
require_once "function.php";
$modal = new XuLy;
$user= $modal->SelectUserById($_SESSION['idUser']);
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	if(isset($_POST['sreachF'])){
		$key = $_POST['keysreach'];
		$listFindUser= $modal->FindUser($key);
	}
	if(isset($_POST['profile'])){
		$profileUser = $modal->SelectUserById($_POST['profile']);
		$template = 1;
	}
	if(isset($_POST['findPost'])){
		$keyword = $_POST['keyFindPost'];
		echo $keyword;
		$data = $modal->FindPost($keyword,$user->id);
		var_dump($data);
		$template = 2;
	}
}
?>

<?php require 'header.php';?>
<div class="container">
	<?php require 'navFind.php'; ?>

	<div class="card" style="margin-top: 5rem">
		<h5 class="card-title">Kết quả tìm kiếm</h5>
		<div class="card-body">
			<?php if (isset($listFindUser)): ?>
				<?php foreach ($listFindUser as $key): ?>
					<?php $user = $modal->SelectUserById($key->id) ?>
					<form style="padding-top: 5px" method="POST" action="Find.php" >
						<button style="margin-left: 1rem" action="info.php" class="btn btn-outline-primary" name = "profile" value="<?php echo $user->id ?>" ><?php echo $user->fullname ?>
					</button>
				</form>
			<?php endforeach ?>
		<?php endif ?>


		<?php if (isset($template)): ?>
			<?php if ($template==1): ?>
				<center>
					<div class="card" style="width: 43rem;">
						<img src="avatar/<?php if($profileUser->avatar!=null){
							echo $profileUser->avatar;
							}else{
								echo "default.jpg";
							} ?>" height="150" class="rounded" alt="..." >
							<div class="card-body">
								<h5 class="card-title"><?php echo $profileUser->fullname ?></h5>
								<p class="card-text">Email: <?php echo $profileUser->email ?></p>
								<p class="card-text">Phone: <?php echo $profileUser->phone ?></p>
							</div>
						</div>
					</center>
					<?php else: ?>
						<?php foreach ($data as $baiviet): ?>
							<?php  $fullname = $post->SelectUserById($baiviet->idUser) ?>
							<?php 
							$comments = $modal->SelectComments($baiviet->id);
							?>
							<div class="card">
								<div class="card-header">
									<?php echo $fullname ->fullname ?><br>
									<small>Đăng lúc: <?php echo $baiviet->timeCreate ?></small><br>
									<small>Chế độ: <?php if($baiviet->tinhTrangBaiViet == 0) echo "Công khai";elseif($baiviet->tinhTrangBaiViet == 1) echo "Bạn bè"; else echo "Riêng tư";?></small>
								</div>
								<div class="card-body">
									<h5 class="card-title"><?php echo $baiviet->content; ?></h5>
									<?php if (($baiviet->picture != null)): ?>
										<img  style=" width: 40rem;
										height: 30rem;
										display: inline-block;
										padding: 5px;
										margin-left: 20px;
										vertical-align:top; 
										background-image: none;
										background-repeat: no-repeat;
										background-position: center center;
										background-size: cover;" src="images/<?php echo $baiviet->picture ?>" class="card-img-top" alt="...">
									<?php endif ?>
									<br> <br>
								</div>
								<?php if ($comments != null): ?>
									<?php foreach ($comments as $comment): ?>
										<?php 
										$usercomment = $modal->SelectUserById($comment->idUserComment);
										?>
										<div class="card" style="margin-top: 5px">
											<div class="card-body">
												<p><?php echo $usercomment->fullname; ?></p>
												<small><?php echo $comment->CommentText ?></small>
											</div>
										</div>

									<?php endforeach ?>
								<?php endif ?>
							</div>
						</div>
						<br>
						<br>
					<?php endforeach ?>
				<?php endif ?>
			<?php endif ?>

		</div>

	</div>
</div>
<?php require 'Footer.php'; ?>