
<?php
/**
 * Created by Loi_Tan
 * User: Tran Huu Loi
 * Dựa vào số lược xem sản phẩm, sau đó sắp xếp giảm dần lược xem. ORDER BY SoLanXem DESC sx giảm dần cột SoLanXem
 * Chỉ hiển thị 11 sp trong một page
 */
 //Lấy csdl của sp và sắp xếp giảm dần
$sl_sanpham = "select * from sanpham where  AnHien=1 and idSP <>1 ORDER BY SoLanXem DESC";
//Kết nối với csdl. Nếu khổng thể connect thì hiển thị message lỗi và hiển thị trang chủ. mysqli_query hàm truy vấn csdl.
$rs_sanpham = mysqli_query($conn,$sl_sanpham);
if(!$rs_sanpham) {
    echo "<script language='javascript'>alert('Không thể kết nối !');location.href='index.php?index=1';</script>";
}?>

<?php
//Sắp xếp giới hạn 11 sp trong 1 page.
//COUNT() đếm số hàng phù hợp với tiêu chí đã chỉ định và gán vào biến total
$result = mysqli_query($conn, 'select count(idSP) as total from sanpham where  AnHien=1 and idSP <>1 ORDER BY SoLanXem DESC');
//Hàm mysqli_fetch_assoc() sẽ tìm và trả về một dòng kết quả của một truy vấn MySQL nào đó dưới dạng một mảng.
$row = mysqli_fetch_assoc($result);
//Hàm CEIL trả về giá trị nguyên nhỏ nhất lớn hơn hoặc bằng một số. Lấy số sp / 11 để làm số page
$total_records = $row['total'];

// BƯỚC 3: TÌM LIMIT VÀ CURRENT_PAGE
//Cày đặt số page hiện có. Nếu chưa có thì gán là 1. Ở đây là 5.
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 11;
$total_page = ceil($total_records / $limit);

// Giới hạn current_page trong khoảng 1 đến total_page
if ($current_page > $total_page){
    $current_page = $total_page;
}
else if ($current_page < 1){
    $current_page = 1;
}

// Tìm Start
//Các sp thuộc phần trang còn lại. Vd (5-1)*11=44. nhiền nhất 44 sp còn lại sẽ nằm trong page 2 đến 5
$start = ($current_page - 1) * $limit;
$result = mysqli_query($conn, "SELECT * FROM sanpham where  AnHien=1 and idSP <>1 ORDER BY SoLanXem DESC LIMIT $start, $limit");
?>
<div class="row col-md-offset-4"><h3>Sản phẩm nổi bật</h3></div>
<div class="row text-center" style="margin-top:40px">
    <div id="productlist">
        <?php $n=0; while ($r= $result->fetch_assoc()) { if($r['idSP'] == 1) continue;?>

            <div class="col-md-3 col-sm-6 col-xs-6" style="margin-bottom:10px">

                <div class="item">

                    <div class="prod-box">
                            <span class="prod-block">
                                <a href="MoTa.php?idSP=<?php echo $r['idSP'];?>" class="hover-item"></a>
                                <span class="prod-image-block">
                                    <span class="prod-image-box">
                                        <img class="prod-image" src="../images/<?php echo $r['urlHinh'];?>"alt="">
                                    </span>
                                </span>
                                    <span class="productname dislay-block limit limit-product">
                                    <?php echo $r['TenSP'];?>
                                     </span>
                                <span class="category dislay-block ">
                                        <span class="pricein168 dislay-block limit"><span class="money"><?php echo number_format($r['GiaBan'],0);?></span>  VNĐ</span>
                                </span>
                            </span>
                        <a href="GioHang.php?idSP=<?php echo $r['idSP'];?>" class="addcartbtn" onclick="AddCart"><img src="../images/xe.png"></a>

                        <a style="color: #0e86c1;" href="MoTa.php?idSP=<?php echo $r['idSP'];?>" onclick="BuyNow(1379)" class="btn btn-default buyproduct"><strong>Xem HÀNG</strong></a>
                    </div>
                </div>
            </div>

        <?php }?>
    </div>
</div>
<div class="example">
    <div class="row" align="center">
        <div class="pagination" >
            <?php
            // PHẦN HIỂN THỊ PHÂN TRANG
            echo "<ul class=\"pagination\">";
            if ($current_page > 1 && $total_page > 1){
                echo '<li><a href="index.php?index=2&page='.($current_page-1).'">Prev</a> </li> ';
            }
            for ($i = 1; $i <= $total_page; $i++){
                if ($i == $current_page){
                    echo '<li><span style="background-color: #00aced;">' . $i . '</span> </li>';
                }
                else{
                    echo '<li><a href="index.php?index=2&page='.$i.'">'.$i.'</a> </li> ';
                }
            }
            if ($current_page < $total_page && $total_page > 1){
                echo '<li><a href="index.php?index=2&page='.($current_page+1).'">Next</a> </li> ';
            }
            echo "</ul>";
            ?>
        </div>
    </div>
</div>

