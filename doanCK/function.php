<?php
include_once "config.php";
#function ke thua tu porvider
class XuLy extends Provider{
	#them user
	function AddUser($fullname,$email,$password){
		$sql = "INSERT INTO users(fullname,email,password,avatar) VALUES (?,?,?,'default.jpg')";
		return $this->ExecuteQuerry($sql,[$fullname,$email,$password]);
	}
	function AddComment($idPost,$idUserComment,$commentText){
		$sql = "INSERT INTO `comments` (`id`, `idPost`, `idUserComment`, `CommentText`, `CommentAT`) VALUES (NULL, ?, ?, ?, CURRENT_TIMESTAMP)";
		return $this->ExecuteQuerry($sql,[$idPost,$idUserComment,$commentText]);
	}



	#Lay tai khoan theo email
	function SelectUserByEmail($email){
		$sql = "SELECT * FROM users WHERE email = '$email'";
		return $this->Load($sql);
	}
	#Thembaiviet 
	function AddPostById($content,$tinhTrang,$picture,$idUser){
		$sql = "INSERT INTO post(content,tinhTrangBaiViet,picture,idUser) VALUES (?,?,?,?)";
		return $this->Load($sql,[$content,$tinhTrang,$picture,$idUser]);
	}
	#Lay Bai Viet
	function SelectPost($id,$number)
	{
		$querry=" SELECT *
		FROM post 
		where tinhTrangBaiViet = 0 OR idUser = ? OR EXISTS (select * from friends where user1Id = ? and user2Id = idUser and tinhTrangBaiViet = 1) 
		ORDER BY timeCreate DESC LIMIT $number ";
		return $this->LoadMore($querry,[$id,$id]);
	}
	#Lấy comment bài viết
	function SelectComments($id){
		$querry = "SELECT * FROM `comments` WHERE `idPost` = ? LIMIT 5";
		return $this->LoadMore($querry,[$id]);
	}
	#Hiển thị tài khoản người dùng dựa vào id
	function SelectUserById($idUser){
		$sql = "SELECT * FROM users WHERE id = $idUser";
		return $this->Load($sql);
	}
	#Đổi mật khẩu của tài khoản
	function ChangePassword($password,$idUser){
		$sql = "UPDATE users SET password=? WHERE id=?";
		return $this->ExecuteQuerry($sql,[$password,$idUser]);
	}
	#Đổi thông tin của tài khoản
	function ChangeInfo($fullname,$phone, $idUser){
		$sql = "UPDATE users SET fullname=?, phone=? WHERE id=?";
		return $this->ExecuteQuerry($sql,[$fullname,$phone,$idUser]);
	}
	#Thêm ảnh đại diện
	function AddAvatar($id,$avatar){
		$sql = "UPDATE users SET avatar = ? WHERE id = $id";
		return $this->ExecuteQuerry($sql,[$avatar]);
	}
	
	//Hàm kết bạn 
	function AddReletion($user1Id, $user2Id){
		$sql = "INSERT INTO friends(user1Id,user2Id) VALUES (?,?)";
		return $this->ExecuteQuerry($sql,[$user1Id, $user2Id]);
	}
	function RemoveReletion($user1Id, $user2Id){//Xóa kết bạn
		$sql = "DELETE FROM friends WHERE ((user1Id = ? AND user2Id = ?)OR(user1Id = ? AND user2Id = ?))";
		return $this->ExecuteQuerry($sql,[$user1Id, $user2Id, $user2Id, $user1Id]);
	}
	function SelectAllFriends($userId){//Lấy danh sách bạn bè
		$sql = "SELECT a.* FROM friends a WHERE a.user2Id = ? AND EXISTS(select b.* from friends b where b.user1Id = ? and b.user2Id = a.user1Id) ";
		return $this->LoadMore($sql,[$userId,$userId]);
	}
	function SelectAllUser($id){
		$sql = "SELECT * FROM users WHERE id != ? LIMIT 3";
		return $this->LoadMore($sql,[$id]);
	}
	

	function LoadAllUser($id){#lấy danh sách user
		$sql = "SELECT id FROM users where id != ? and not exists(SELECT * from friends where ((user1Id = ? and user2Id = id)or(user1Id = id and user2Id = ?)))";
		return $this->LoadMore($sql,[$id,$id,$id]);
	}
	function FindUser($keyword){
		$sql = "SELECT * FROM users WHERE fullname LIKE '%$keyword%'";
		return $this->LoadMore($sql);
	}
	function FindPost($keyword){
		$sql = "SELECT * FROM post WHERE content LIKE '%$keyword%' AND tinhTrangBaiViet = 0";
		return $this->LoadMore($sql);
	}
	function SelectRequestAddFriend( $user2Id){ //Lấy ra danh sách người gửi yêu cầu kết bạn 
		$sql = "SELECT a.* FROM friends a WHERE a.user2Id = ? AND NOT EXISTS(select b.* from friends b where b.user1Id = ? and b.user2Id = a.user1Id) LIMIT 3";
		return $this->LoadMore($sql,[$user2Id,$user2Id]);
	}function SelectSendRequestAddFriend( $user1Id){ //Lấy ra danh sách người được gửi yêu cầu kết bạn
		$sql = "SELECT a.* FROM friends a WHERE a.user1Id = ? AND NOT EXISTS(select b.* from friends b where b.user2Id = ? and b.user1Id = a.user1Id) LIMIT 3";
		return $this->LoadMore($sql,[$user1Id,$user1Id]);
	}
}
?>