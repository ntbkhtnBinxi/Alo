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
  </div>
</div>

<br>
<br>

