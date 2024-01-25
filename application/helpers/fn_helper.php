<?php

define('APP_NAME', "ระบบจัดการพนักงาน");




function DateThai($strDate)
{
	$strYear = date("Y", strtotime($strDate)) + 543;
	$strMonth = date("n", strtotime($strDate));
	$strDay = date("j", strtotime($strDate));
	$strHour = date("H", strtotime($strDate));
	$strMinute = date("i", strtotime($strDate));
	$strSeconds = date("s", strtotime($strDate));
	$strMonthCut = array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
	$strMonthThai = $strMonthCut[$strMonth];
	return "$strDay $strMonthThai $strYear";
}

function DateThaiFull($strDate)
{
	$strYear = date("Y", strtotime($strDate)) + 543;
	$strMonth = date("n", strtotime($strDate));
	$strDay = date("j", strtotime($strDate));
	$strHour = date("H", strtotime($strDate));
	$strMinute = date("i", strtotime($strDate));
	$strSeconds = date("s", strtotime($strDate));
	$strMonthCut = array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
	$strMonthThai = $strMonthCut[$strMonth];
	return "วันที่ {$strDay} เดือน {$strMonthThai} พ.ศ. {$strYear} ";
}



function ConvertNume($amount_number)
{
	$amount_number = number_format($amount_number, 2, ".", "");
	$pt = strpos($amount_number, ".");
	$number = $fraction = "";
	if ($pt === false)
		$number = $amount_number;
	else {
		$number = substr($amount_number, 0, $pt);
		$fraction = substr($amount_number, $pt + 1);
	}

	$ret = "";
	$baht = ReadNumber($number);
	if ($baht != "")
		$ret .= $baht . "บาท";

	$satang = ReadNumber($fraction);
	if ($satang != "")
		$ret .= $satang . "สตางค์";
	else
		$ret .= "ถ้วน";
	return $ret;
}

function ReadNumber($number)
{
	$position_call = array("แสน", "หมื่น", "พัน", "ร้อย", "สิบ", "");
	$number_call = array("", "หนึ่ง", "สอง", "สาม", "สี่", "ห้า", "หก", "เจ็ด", "แปด", "เก้า");
	$number = $number + 0;
	$ret = "";
	if ($number == 0)
		return $ret;
	if ($number > 1000000) {
		$ret .= ReadNumber(intval($number / 1000000)) . "ล้าน";
		$number = intval(fmod($number, 1000000));
	}

	$divider = 100000;
	$pos = 0;
	while ($number > 0) {
		$d = intval($number / $divider);
		$ret .= (($divider == 10) && ($d == 2)) ? "ยี่" : ((($divider == 10) && ($d == 1)) ? "" : ((($divider == 1) && ($d == 1) && ($ret != "")) ? "เอ็ด" : $number_call[$d]));
		$ret .= ($d ? $position_call[$pos] : "");
		$number = $number % $divider;
		$divider = $divider / 10;
		$pos++;
	}
	return $ret;
}


function DateDiff($strDate1, $strDate2)
{
	return (strtotime($strDate2) - strtotime($strDate1)) / (60 * 60 * 24); // 1 day = 60*60*24
}
function TimeDiff($strTime1, $strTime2)
{
	return (strtotime($strTime2) - strtotime($strTime1)) / (60 * 60); // 1 Hour =  60*60
}
function DateTimeDiff($strDateTime1, $strDateTime2)
{
	return (strtotime($strDateTime2) - strtotime($strDateTime1)) / (60 * 60); // 1 Hour =  60*60
}


function calculateHours($start, $end)
{
	$startTimestamp = strtotime($start);
	$endTimestamp = strtotime($end);

	if ($endTimestamp < $startTimestamp) {
		$endTimestamp += 86400; // Add a day (86400 seconds) if the end time is on the next day
	}

	$diffInSeconds = $endTimestamp - $startTimestamp;
	$diffInHours = $diffInSeconds / 3600; // 3600 seconds per hour

	return $diffInHours;
}
