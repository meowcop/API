<?php
/*
    MADE BY MEOW
    GITHUB: meowcop
    FB: 100039847550995
    CONTACT: HoangGiap.Contact@gmail.com
    DON'T DELETE. RESPECT THE AUTHOR.
	
	Example: GET xxx.com/evn.php?id=xxx
*/
header('X-Powered-By: Meow');
error_reporting(0);
@date_default_timezone_set('Asia/Ho_Chi_Minh');
$MaKhachHang = $_GET['id']; 
$SetNgayThang = date("d-m-Y"); 
$SetThoiGian = date("H:i"); 
$NGay_Bat_Dau = date_format(date_modify(date_create("$SetNgayThang"), "-3 days"), "Y-m-d");
$NGay_Ket_Thuc = date_format(date_modify(date_create("$SetNgayThang"), "-1 days"), "Y-m-d");
$API_Get_DD_Info = base64_decode("aHR0cHM6Ly9hcGlucGMuZWR1a2l0ZWFwcC5vbmxpbmUvbW9iaWxlYXBpL2hvLXNvL0RET19JTkZPLw==")."$MaKhachHang";
$API_Get_Info_KH = base64_decode("aHR0cHM6Ly9hcGlucGMuZWR1a2l0ZWFwcC5vbmxpbmUvbW9iaWxlYXBpL2hvbWUv")."$MaKhachHang";
$API_Co_Mat_Dien = base64_decode("aHR0cHM6Ly9hcGlucGMuZWR1a2l0ZWFwcC5vbmxpbmUvbW9iaWxlYXBpL3Rob25nLXRpbi1jYXQtZGllbi9nZXQ=");
$API_San_Luong_Ngay = base64_decode("aHR0cHM6Ly9hcGlucGMuZWR1a2l0ZWFwcC5vbmxpbmUvbW9iaWxlYXBpL3Nhbi1sdW9uZy1kaWVuL3RyYS1jdXU=");
$curl = curl_init();
$curl1 = curl_init();
$curl2 = curl_init();
$curl3 = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "$API_Get_DD_Info",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',));
$DD_inf = curl_exec($curl);
curl_close($curl);
$DD_info = json_decode($DD_inf);
$MaDiemDo = $DD_info->data[0]->MA_DDO;
$MaDVQuanLy = $DD_info->data[0]->MA_DVIQLY;
$SoPha = $DD_info->data[0]->SO_PHA;
curl_setopt_array($curl1, array(
  CURLOPT_URL => "$API_Get_Info_KH",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',));
$info_KH = curl_exec($curl1);
curl_close($curl1);
$ThongTin_KH = json_decode($info_KH);
curl_setopt_array($curl2, array(
  CURLOPT_URL => "$API_Co_Mat_Dien/$MaDVQuanLy/$MaKhachHang",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',));
$TTCD = curl_exec($curl2);
curl_close($curl2);
$Get_TTCD = json_decode($TTCD);
curl_setopt_array($curl3, array(
  CURLOPT_URL => "$API_San_Luong_Ngay/$MaDiemDo/$SoPha/$NGay_Bat_Dau/$NGay_Ket_Thuc",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',));
$SL_Dien_Ngay = curl_exec($curl3);
curl_close($curl3);
$Get_SL_Ngay = json_decode($SL_Dien_Ngay);
$Ten_Khach_Hang = $ThongTin_KH->data->customerInfo->name;
$DiaChi_KH = $ThongTin_KH->data->customerInfo->address;
$SDT_KH = $ThongTin_KH->data->customerInfo->phone;
$Cty_Cap_Dien = $ThongTin_KH->data->customerInfo->electricityCompany->name;
$DiaChi_Cty_Cap_Dien = $ThongTin_KH->data->customerInfo->electricityCompany->address;
$Ma_So_Cong_To = $ThongTin_KH->data->customerInfo->soCongToList[0]; 
$Chi_So_Cu = $ThongTin_KH->data->customerInfo->chiSoDienList[0]->chiSoCu."(kWh)";
$Chi_So_Moi = $ThongTin_KH->data->customerInfo->chiSoDienList[0]->chiSoMoi."(kWh)";
$Trang_Thai_Dien = "Hi???n ". $Get_TTCD->alert;
$SetThoiGian;
$Ky_ThangNay = $ThongTin_KH->data->customerInfo->invoice[0]->period; 
$Thang_ThangNay = $ThongTin_KH->data->customerInfo->invoice[0]->month; 
$Nam_ThangNay = $ThongTin_KH->data->customerInfo->invoice[0]->year;  
$SanLuongKWH_ThangNay = $ThongTin_KH->data->customerInfo->invoice[0]->usageAmount."(kWh)"; 
$Tong_Tien_ThangNay = number_format($ThongTin_KH->data->customerInfo->invoice[0]->paymentTotalAmount)."(VN??)"; 

$Trang_Thai_TT_ThangNay = $ThongTin_KH->data->customerInfo->invoice[0]->paid;  
if ($Trang_Thai_TT_ThangNay == false) {
    $Trang_Thai_TT_ThangNay =  "Ch??a Thanh To??n";
} else {$Trang_Thai_TT_ThangNay = "???? Thanh To??n";}

$Ti_Le_ThayDoi_ThangNay = $ThongTin_KH->data->customerInfo->chiSoDienList[0]->sanLuongChangeRate."%"; 
$Ky_ThangTruoc = $ThongTin_KH->data->customerInfo->invoice[1]->period;
$Thang_ThangTruoc = $ThongTin_KH->data->customerInfo->invoice[1]->month; 
$Nam_ThangTruoc = $ThongTin_KH->data->customerInfo->invoice[1]->year;  
$SanLuongKWH_ThangTruoc = $ThongTin_KH->data->customerInfo->invoice[1]->usageAmount."(kWh)"; 
$Tong_Tien_ThangTruoc = number_format($ThongTin_KH->data->customerInfo->invoice[1]->paymentTotalAmount)."(VN??)"; 
$Trang_Thai_TT_ThangTruoc = $ThongTin_KH->data->customerInfo->invoice[1]->paid; 
$Ky_ThangTruocNua = $ThongTin_KH->data->customerInfo->invoice[2]->period;
$Thang_ThangTruocNua = $ThongTin_KH->data->customerInfo->invoice[2]->month; 
$Nam_ThangTruocNua = $ThongTin_KH->data->customerInfo->invoice[2]->year;  
$SanLuongKWH_ThangTruocNua = $ThongTin_KH->data->customerInfo->invoice[2]->usageAmount."(kWh)"; 
$Tong_Tien_ThangTruocNua = number_format($ThongTin_KH->data->customerInfo->invoice[2]->paymentTotalAmount)."(VN??)"; 
$Trang_Thai_TT_ThangTruocNua = $ThongTin_KH->data->customerInfo->invoice[2]->paid; 
$SL_Ngay_HomQua = $Get_SL_Ngay->data[2]->ngayTieuThu;
$SL_SoDien_HomQua = $Get_SL_Ngay->data[2]->sanLuongBinhThuong."(kWh)";
$SL_Tong_So_Dien_HomQua = $Get_SL_Ngay->data[2]->binhThuong."(kWh)";
$SL_Ngay_HomKia = $Get_SL_Ngay->data[1]->ngayTieuThu;
$SL_SoDien_HomKia = $Get_SL_Ngay->data[1]->sanLuongBinhThuong."(kWh)";
$SL_Tong_So_Dien_HomKia = $Get_SL_Ngay->data[1]->binhThuong."(kWh)";
$SL_Ngay_HomKiaf = $Get_SL_Ngay->data[0]->ngayTieuThu;
$SL_SoDien_HomKiaf = $Get_SL_Ngay->data[0]->sanLuongBinhThuong."(kWh)";
$SL_Tong_So_Dien_HomKiaf = $Get_SL_Ngay->data[0]->binhThuong."(kWh)";


header('Content-Type: application/json');
$EVN = array("name"=>"Get Data EVN Mi???n B???c","MaKhachHang"=>"$MaKhachHang","TenKhachHang"=>"$Ten_Khach_Hang","DiaChi"=>"$DiaChi_KH","SDT"=>"$SDT_KH","NoiCapDien"=>"$Cty_Cap_Dien",
"DiaChiNoiCapDien"=>"$DiaChi_Cty_Cap_Dien","MaSoCongTo"=>"$Ma_So_Cong_To","ChiSoCu"=>"$Chi_So_Cu","ChiSoMoi"=>"$Chi_So_Moi","TrangThaiMatDien"=>"$Trang_Thai_Dien","LanThayDoiCuoi"=>"$SetThoiGian",
    "SanLuong_HomQua" => array(
        array(
            "Ngay_Thang" => "$SL_Ngay_HomQua",
			"San_Luong" => "$SL_SoDien_HomQua",
			"Tong_So_Dien" => "$SL_Tong_So_Dien_HomQua"
        ) ),
    "SanLuong_HomKia" => array(
		array(
			"Ngay_Thang" => "$SL_Ngay_HomKia",
			"San_Luong" => "$SL_SoDien_HomKia",
			"Tong_So_Dien" => "$SL_Tong_So_Dien_HomKia"
        ), ),
    "SanLuong_HomKiaf" => array(
		array(
			"Ngay_Thang" => "$SL_Ngay_HomKiaf",
			"San_Luong" => "$SL_SoDien_HomKiaf",
			"Tong_So_Dien" => "$SL_Tong_So_Dien_HomKiaf"
        ) ),
    "Tien_Dien_Thang_Nay" => array(
		array(
			"Ky" => "$Ky_ThangNay",
			"Thang" => "$Thang_ThangNay",
			"Nam" => "$Nam_ThangNay",
			"SanLuong" => "$SanLuongKWH_ThangNay",
			"SoTien_ThanhToan" => "$Tong_Tien_ThangNay",
//			"TrangThai_ThanhToan" => "$Trang_Thai_TT_ThangNay",
			"Ti_Le_ThayDoi" => "$Ti_Le_ThayDoi_ThangNay"
			
        )),
    "Tien_Dien_Thang_Truoc" => array(
		array(
			"Ky" => "$Ky_ThangTruoc",
			"Thang" => "$Thang_ThangTruoc",
			"Nam" => "$Nam_ThangTruoc",
			"SanLuong" => "$SanLuongKWH_ThangTruoc",
			"SoTien_ThanhToan" => "$Tong_Tien_ThangTruoc"
			
        )),
	"Tien_Dien_Thang_Truoc_Nua" => array(
		array(
			"Ky" => "$Ky_ThangTruocNua",
			"Thang" => "$Thang_ThangTruocNua",
			"Nam" => "$Nam_ThangTruocNua",
			"SanLuong" => "$SanLuongKWH_ThangTruocNua",
			"SoTien_ThanhToan" => "$Tong_Tien_ThangTruocNua"
			
        )));
echo(json_encode($EVN));

/*
echo "<center>EVN NPC - Mi???n B???c</center>";

echo "<center>
<table border=1 cellspacing=0 cellpading=0>  
<tr><td>M?? Kh??ch H??ng:</td> <td>$MaKhachHang</td></tr>
<tr><td>T??n Kh??ch H??ng:</td> <td> $Ten_Khach_Hang</td></tr>
<tr><td>?????a ch???:</td> <td> $DiaChi_KH</td></tr>
<tr><td>S??? ??i???n Tho???i:</td> <td> $SDT_KH</td></tr>
<tr><td>N??i c???p ??i???n:</td> <td> $Cty_Cap_Dien</td></tr>
<tr><td>?????a ch??? C???p ??i???n:</td> <td> $DiaChi_Cty_Cap_Dien</td></tr>
<tr><td>M?? s??? c??ng t??:</td> <td> $Ma_So_Cong_To</td></tr>
<tr><td>Ch??? s??? c??:</td> <td> $Chi_So_Cu</td></tr>
<tr><td>Ch??? s??? m???i:</td> <td> $Chi_So_Moi</td></tr>
<tr><td>Tr???ng th??i:</td> <td> $Trang_Thai_Dien</td></tr>
<tr><td>L???n thay ?????i cu???i:</td> <td> $SetThoiGian</td></tr>
</table></center>
";

echo "<center>S???n l?????ng h??m qua</center>";  
echo "<center>
<table border=1 cellspacing=0 cellpading=0>
<tr><td>Ng??y Th??ng:</td> <td> $SL_Ngay_HomQua</td></tr>
<tr><td>S???n l?????ng:</td> <td> $SL_SoDien_HomQua</td></tr>
<tr><td>T???ng s??? ??i???n:</td> <td> $SL_Tong_So_Dien_HomQua</td></tr>
</table></center>";

echo "<center>S???n l?????ng h??m kia</center>";  
echo "<center>
<table border=1 cellspacing=0 cellpading=0>
<tr><td>Ng??y Th??ng:</td> <td> $SL_Ngay_HomKia</td></tr>
<tr><td>S???n l?????ng:</td> <td> $SL_SoDien_HomKia</td></tr>
<tr><td>T???ng s??? ??i???n:</td> <td> $SL_Tong_So_Dien_HomKia</td></tr>
</table></center>";

echo "<center>S???n l?????ng h??m k??a</center>";  
echo "<center><table border=1 cellspacing=0 cellpading=0>
<tr><td>Ng??y Th??ng:</td> <td> $SL_Ngay_HomKiaf</td></tr>
<tr><td>S???n l?????ng:</td> <td> $SL_SoDien_HomKiaf</td></tr>
<tr><td>T???ng s??? ??i???n:</td> <td> $SL_Tong_So_Dien_HomKiaf</td></tr>
</table></center>";

echo "<center>S???n l?????ng th??ng n??y</center>";
echo "<center>
<table border=1 cellspacing=0 cellpading=0>
<tr><td>Th??ng:</td> <td> $Thang_ThangNay</td></tr>
<tr><td>N??m:</td> <td> $Nam_ThangNay</td></tr>
<tr><td>S???n l?????ng:</td> <td> $SanLuongKWH_ThangNay</td></tr>
<tr><td>Tr???ng th??i:</td> <td> $Trang_Thai_TT_ThangNay</td></tr>
<tr><td>T???ng ti???n:</td> <td> $Tong_Tien_ThangNay</td></tr>
</table></center>";

echo "<center>S???n l?????ng th??ng tr?????c</center>";
echo "<center><table border=1 cellspacing=0 cellpading=0>
<tr><td>Th??ng:</td> <td> $Ky_ThangTruoc</td></tr>
<tr><td>N??m:</td> <td> $Nam_ThangTruoc</td></tr>
<tr><td>S???n l?????ng:</td> <td> $SanLuongKWH_ThangTruoc</td></tr>
<tr><td>Tr???ng th??i:</td> <td> $Trang_Thai_TT_ThangTruoc</td></tr>
<tr><td>T???ng ti???n:</td> <td> $Tong_Tien_ThangTruoc</td></tr>
</table></center>";

echo "<center>S???n l?????ng th??ng tr?????c n???a :D</center>";
echo "<center><table border=1 cellspacing=0 cellpading=0>
<tr><td>Th??ng:</td> <td> $Ky_ThangTruocNua</td></tr>
<tr><td>N??m:</td> <td> $Nam_ThangTruocNua</td></tr>
<tr><td>S???n l?????ng:</td> <td> $SanLuongKWH_ThangTruocNua</td></tr>
<tr><td>Tr???ng th??i:</td> <td> $Trang_Thai_TT_ThangTruocNua</td></tr>
<tr><td>T???ng ti???n:</td> <td> $Tong_Tien_ThangTruocNua</td></tr>
</table></center>";
*/
?>