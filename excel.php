<?php
//加载EXCEL类
require_once 'Excel/reader.php';
require_once(dirname(__FILE__).'/include/config.inc.php');
//设置字符集
header('Content-type:text/html;charset=utf-8;');
//实例化类
$data = new Spreadsheet_Excel_Reader();
//设置文本输出字符编码
$data->setOutputEncoding('utf-8');
error_reporting(E_ALL ^ E_NOTICE);
//加载文件名
for($k=1;$k<=17;$k++){
$data->read('Excel/bg/join'.$k.'.xls');   //格式必须以.xls  版本2000/2003

for($i=2;$i<=$data->sheets[0]['numRows'];$i++){
    //以下注释的for循环打印excel表数据
    for ($j=1; $j <=$data->sheets[0]['numCols']; $j++) {
    }
    //以下代码是将excel表数据【3个字段】插入到mysql中，
    // 根据你的excel表字段的多少，改写以下代码吧！
    $sql = "INSERT INTO pmw_loan (loannumber,contract,application,name,cardnumber,statement,shop,loanw,principal,manager,loanx,productname,overdue,returned,benjin,interest,fine,compound,cost,phone,address,areacode,kehuphone,danweiname,danweiaddress,contact,department,bankname,banknumber,failure,issuingdate,maturitydate,pathname,source,total,signs) VALUES('".
    $data->sheets[0]['cells'][$i][1]."','".
    $data->sheets[0]['cells'][$i][2]."','".
    $data->sheets[0]['cells'][$i][3]."','".
    $data->sheets[0]['cells'][$i][4]."','".
    $data->sheets[0]['cells'][$i][5]."','".
    $data->sheets[0]['cells'][$i][6]."','".
    $data->sheets[0]['cells'][$i][7]."','".
    $data->sheets[0]['cells'][$i][8]."','".
    $data->sheets[0]['cells'][$i][9]."','".
    $data->sheets[0]['cells'][$i][10]."','".
    $data->sheets[0]['cells'][$i][11]."','".
    $data->sheets[0]['cells'][$i][12]."','".
    $data->sheets[0]['cells'][$i][13]."','".
    $data->sheets[0]['cells'][$i][14]."','".
    $data->sheets[0]['cells'][$i][15]."','".
    $data->sheets[0]['cells'][$i][16]."','".
    $data->sheets[0]['cells'][$i][17]."','".
    $data->sheets[0]['cells'][$i][18]."','".
    $data->sheets[0]['cells'][$i][19]."','".
    $data->sheets[0]['cells'][$i][20]."','".
    $data->sheets[0]['cells'][$i][21]."','".
    $data->sheets[0]['cells'][$i][22]."','".
    $data->sheets[0]['cells'][$i][23]."','".
    $data->sheets[0]['cells'][$i][24]."','".
    $data->sheets[0]['cells'][$i][25]."','".
    $data->sheets[0]['cells'][$i][26]."','".
    $data->sheets[0]['cells'][$i][27]."','".
    $data->sheets[0]['cells'][$i][28]."','".
    $data->sheets[0]['cells'][$i][29]."','".
    $data->sheets[0]['cells'][$i][30]."','".
    $data->sheets[0]['cells'][$i][31]."','".
    $data->sheets[0]['cells'][$i][32]."','".
    $data->sheets[0]['cells'][$i][33]."','".
    $data->sheets[0]['cells'][$i][34]."','".
    $data->sheets[0]['cells'][$i][35]."','".
    $data->sheets[0]['cells'][$i][36]."')";
    $dosql->ExecNoneQuery($sql);
    }
}
ShowMsg('导入成功！','index.php');
 ?>
