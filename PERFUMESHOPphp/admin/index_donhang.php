<?php
/**
 * Created by Loi_Tan
 * User: Tran Huu Loi
 * 
 * 
 */
include_once('../connection/connect_database.php');
$sl_donhang = "select * from donhang";
$rs_donhang = mysqli_query($conn, $sl_donhang);
if (!$rs_donhang)
    echo "Không thể truy vấn CSDL"; ?>
<!DOCTYPE html>
<html>
<header>
    <?php include_once("header1.php"); ?>
    <title>Danh sách đơn hàng </title>
    <?php include_once('header2.php'); ?>
</header>
<body>
<?php include_once('header3.php'); ?>
<!--Content Start Here -->
<h3 style="text-align: center">DANH SÁCH ĐƠN HÀNG </h3>
<div style="overflow-x: scroll">
    <table class=" table table-bordered hover" style="overflow-x: scroll" border="2">
        <thead class="text-center">
        <tr>
            <td width=""><strong> MĐH</strong></td>
            <td width=""><strong> ID USER </strong></td>
            <td width=""><strong> THỜI GIAN ĐẶT</strong></td>
            <td width=""><strong> TÊN NGƯỜI NHẬN </strong></td>
            <td width=""><strong> ĐỊA CHỈ</strong></td>
            <td width=""><strong> SĐT</strong></td>
            <td width=""><strong> Email</strong></td>
            <td width=""><strong> TÌNH TRẠNG </strong></td>
            <td width=""><strong> TỔNG TIỀN</strong></td>
            <td width=""><strong> TAX </strong></td>
            <td width=""><strong> PPT TT </strong></td>
            <td width=""><strong> PPT GH </strong></td>
            <td><strong> THAO TÁC </strong></a></td>
        </tr>
        </thead>
        <?php $stt = 0;
        while ($r = $rs_donhang->fetch_assoc()) { ?>
            <tbody>
            <td>
                <a href="index_ds_chitietdh.php?idDH=<?php echo $r['idDH']; ?>"><strong> <?php echo $r['idDH']; ?> </strong></a>
            </td>
            <td width=""><strong><?php echo $r['idUser']; ?> </strong></td>
            <td width=""><strong><?php echo $r['ThoiDiemDatHang']; ?> </strong></td>
            <td width=""><strong><?php echo $r['TenNguoiNhan']; ?> </strong></td>
            <td width=""><strong><?php echo $r['DiaChi']; ?> </strong></td>
            <td width=""><strong><?php echo $r['SDT']; ?></td>
            <td width=""><strong><?php echo $r['Email']; ?> </strong></td>
            <td width=""><strong><?php if($r['DaXuLy'] ==1 ) echo "Đã xử lí"; else echo "Chưa xử lí";?> </strong></td>
            <td width=""><strong><?php
                    $sl_sp_ctdh="select sum(SoLuong*Gia-GiaKhuyenmai) as TongTien from sanpham a, donhangchitiet b where a.idSP=b.idSP and idDH=".$r['idDH'];
                    $rs_tt=mysqli_query($conn,$sl_sp_ctdh);
                    $d=mysqli_fetch_array($rs_tt);
                    echo $d['TongTien'];
                    ?> </strong></td>
            <td width=""><strong><?php echo $r['Tax']; ?> </strong></td>
            <td width=""><strong><?php echo 'Trực tiếp' ?> </strong></td>
            <td width=""><strong><?php
                    $sl_ptgh = "select * from phuongthucgiaohang where idGH=".$r['idPTGH'];
                    $rs_ptgh = mysqli_query($conn, $sl_ptgh);
                    $d=mysqli_fetch_array($rs_ptgh);
                            echo $d['TenGH']; ?> </strong></td>
            <td><a href="xoa_donhang.php?idDH=<?php echo $r['idDH'];?>"><strong> XÓA </strong></a></td>
            </tbody>
        <?php } ?>
    </table>
</div>

<?php include_once('footer.php'); ?>
</body>
</html>
