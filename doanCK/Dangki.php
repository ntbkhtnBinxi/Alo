	<?php 
	require_once 'function.php';

	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$email = $_POST['email'];
		$password = $_POST['password'];
		$fullname = $_POST['fullname'];
		if (empty($email) or empty($password) or empty($fullname)) 
		{
			$error="Bạn cần nhập đầy đủ thông tin";
		}
		else 
		{
			$passHash = password_hash($password, PASSWORD_DEFAULT);
			$user = new XuLy();
			$user->addUser($fullname,$email,$passHash);
			if($user){
				$_SESSION['idUser'] = $user->id;
				header('Location: index.php');	
			}
			if(!$user)
			{
				$error = "Đăng kí thất bại";
			}
		}
	}
	?>
	<?php require 'header.php'; ?>
	<div class="container">	
		<?php require'navLogin.php'; ?>
		<br>
		<br>
		<h1>ĐĂNG KÝ</h1>
		<br>
		<form action="Dangki.php" method="POST">
			<?php if (isset($error)): ?>
				<div class="alert alert-primary" role="alert">
					<?php echo $error ?>
				</div>
			<?php endif ?>
			<div class="form-group">
				<label for="">FullName</label>
				<input type="text" class="form-control" name="fullname" placeholder="FullName">
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1">Email address</label>
				<input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" placeholder="Enter email">
			</div>
			<div class="form-group">
				<label for="exampleInputPassword1">Password</label>
				<input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password">
			</div>
			<div class = "row">
				<div class="col"></div>
				<div class="col-2"><button type="submit" class="btn btn-primary">Đăng kí</button></div>
				<div class="col"></div>
			</div>
		</form>
		<div class="col"></div>
	</div>
</div>	
<?php require 'Footer.php';?>