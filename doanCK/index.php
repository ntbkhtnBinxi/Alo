<?php 
require_once 'function.php';
$model = new XuLy;
$modal = new XuLy;
if(!isset($_SESSION['idUser']))
{
	header('Location: Dangnhap.php');
}
if($_SERVER['REQUEST_METHOD'] == 'POST')
{

	if(isset($_POST['post']))
	{
		if (empty($_POST['content'])) {
			$error="Bài viết không được để trống";
		}
		else{
			$content = $_POST['content'];
			$post = new XuLy();
			$name = '';
			if(isset($_FILES['picture'])){
				$fileTemp = $_FILES['picture']['tmp_name'];
				$fileName = 'images/' . $_FILES['picture']['name'];
				$result = move_uploaded_file($fileTemp, $fileName);
				if ($result) {
					$name = $_FILES['picture']['name'];
				}
			}
			$post->AddPostById($content,$_POST['cheDo'],$name,$_SESSION['idUser']);
			if(!$post){
				$error = "Đăng bài viết thất bại";
			}
			else
			{
				$suc ="Đăng bài viết thành công";
			}
		}
	}
	if(isset($_POST['comment']))
	{
		$idPost = $_POST['comment'];
		$commentText = $_POST['commentText'];
		$idUserComment = $modal->SelectUserById($_SESSION['idUser']);
		echo $idPost;
		$modal->AddComment($idPost,$idUserComment->id,$commentText);
	}

}
$user= $model->SelectUserById($_SESSION['idUser']);
$post = new XuLy;
$temp = 3; 
$data = $post -> SelectPost($user->id,$temp);
if($data)
{
	$i = 1;
}
?>
<?php require 'header.php';?>
<div class="container">
	<?php require 'navBarHome.php'; ?> <br>
	<h1>
		HOME
	</h1>
	<br>
	<?php if (isset($suc) or isset($error)): ?>
	<div class="alert alert-primary" role="alert">
		<?php if(isset($suc))
		echo $suc;
		else echo $error;?>
	</div>
<?php endif ?>
<div class="row">
	<div class="col-3"></div>
	<div class="col">
		<!-- Modal -->
		<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalCenterTitle">Bạn đang nghĩ gì?</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form action="index.php" method="POST" enctype="multipart/form-data">
							<div class="form-group">
								<textarea class="form-control" id="exampleFormControlTextarea1" name= "content" rows="3"></textarea>
							</div>
							<div class="form-group">
								<label>Thêm ảnh vào bài viết</label>
								<input type="file" class="form-control" name="picture">
							</div>
							<p>Chế độ bài viết:
								<SELECT name="cheDo">
									<OPTION Value="0">Công khai</OPTION>
									<OPTION Value="1">Bạn bè</OPTION>
									<OPTION Value="2">Chỉ mình tôi</OPTION>
								</SELECT></p> 
								<button type="submit" class="btn btn-primary" name="post">Save changes</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<br>
	<br>
	<div class="row">
		<div class="col - 8">
			<?php if (isset($i)): ?>
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
								<img width="500" height="500" src="images/<?php echo $baiviet->picture ?>" class="card-img-top" alt="...">
							<?php endif ?>

							<form action="index.php" method="POST" >
								<div class="form-row">
									<div class="col">
										<input type="text" class="form-control" name= "commentText" placeholder="Comment here...">
									</div>
									<div class="col - 1"> 
										<button type="submit" class="btn btn-danger" name="comment" formenctype="multipart/form-data" value="<?php echo $baiviet->id ?>">
											Comment
										</button>
									</div>
								</form>  
								<br> <br>
							</div>
							<?php if ($comments != null): ?>
								<?php foreach ($comments as $comment): ?>
									<?php 
									$usercomment = $modal->SelectUserById($comment->idUserComment);
									?>
									<div class="card">
										<div class="card-body">
											<p><b><?php echo $usercomment->fullname; ?></b></p>
											<p><?php echo $comment->CommentText ?></p>
										</div>
									</div>
									
								<?php endforeach ?>
							<?php endif ?>



						</div>
					</div>

					<br>
					<br>

				<?php endforeach ?>
			<?php endif; ?>
		</div>
		<div class="col-4">
			<div class="card">
				<img src="avatar/<?php if($user->avatar == null){
					echo "default.jpg";
					} else 
					{
						echo $user->avatar;
					} ?>" class="card-img-top">
					<div class="card-body">
						<h5 class="card-title">Chào mừng <?php echo $user->fullname; ?></h5>
						<p class="card-text">
						</p>
						<center>
							<a href="info.php" class="btn btn-primary">Cá nhân</a>
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
								Cập nhật trạng thái
							</button></center>	 
						</div>
					</div>
				</div>
			</div>

		</div>
		<?php require 'Footer.php';?>