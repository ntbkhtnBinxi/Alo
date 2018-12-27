<?php 
require_once 'function.php';
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$email = $_POST['email'];
	$password = $_POST['password'];
	if (empty($emai) or empty($password)) {
		$error = "Yêu cầu nhập đầy đủ email và mật khẩu!!!";
	}

	$model = new XuLy;
    $user = $model->SelectUserByEmail($email);
    $check = password_verify($password, $user->password);
    if($check)
    {
    	$_SESSION['idUser'] = $user->id;
    	header('Location: index.php');
    }
    else
    {
    	$error="Tài khoản hoặc mật khẩu không chính xác";
    }
}
?>

<?php require 'header.php'; ?>
<div class="container">
	<?php require'navLogin.php'; ?>
	<br>
	<br>
	<h1>ĐĂNG NHẬP</h1>
	<br>
	<form action="Dangnhap.php" method="POST">
		<div class="form-group">
			<label for="exampleInputEmail1">Email address</label>
			<input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" placeholder="Enter email">
			<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
		</div>
		<div class="form-group">
			<label for="exampleInputPassword1">Password</label>
			<input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password">
		</div>
		<div class = "row">
			<div class="col"></div>
			<div class="col-2"><button type="submit" class="btn btn-primary">Đăng nhập</button></div>
			<div class="col"></div>
		</div>
		<?php if (isset($error)): ?>
			<div class="alert alert-danger" role="alert">
				<?php 
				echo $error;
				?>
			</div>	
		<?php endif ?>
	</form>
</div>
<?php require 'Footer.php'; ?>