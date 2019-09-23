<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mydate {
//var $j = 0;
    public function __construct() {
        date_default_timezone_set('Asia/Bangkok');
    }

    /* แปลงวันที่จาก Text ลงฐานข้อมูล
     * รับค่าเข้ามาเป็น วว/ดด/ปปปป
     * แปลงค่ากลับไปเป็น yyyy/mm/dd
     */

    function dateToMysql($txt) {
        $result = "";
        if ($txt != "") {
            $year = substr($txt, 6, 4);
            if ($year > 2500) {
                $year = $year - 543;
            }
            $month = substr($txt, 3, 2);
            $day = substr($txt, 0, 2);
            $result = $year . "-" . $month . "-" . $day;
        }
        return $result;
    }

    /* แปลงวันที่จากฐานข้อมูล ไป TextBox รปแบบวันที่นำเข้า 2009-07-30 */

    function dateToText($strDate) {
        $result = "";
        if ($strDate === "" || $strDate == null || $strDate == "0000-00-00") {
            return "";
        } else if (substr($strDate, 0, 4) != "0000") {
            $strYear = date("Y", strtotime($strDate)) + 543;
            $strMonth = date("m", strtotime($strDate));
            $strDay = date("d", strtotime($strDate));
            $result = "$strDay/$strMonth/$strYear";
            return $result;
        }
    }

    //หาวันสุดท้ายของเดือนปัจจุบัน
    function lastDate($year = '', $month = '') {
        $day = array(31, 30, 29, 28);
        if ($month == '')
            $month = date("m");
        if ($year == '')
            $year = date("Y");
        for ($i = 0; $i < count($day); $i++) {
            $day_check = $day[$i];
            if (checkdate($month, $day_check, $year)) {
                $last_date = $day_check . "/" . $month . "/" . ((int) $year + 543);
                break;
            }
        }

        return $last_date;
    }

    /**
     *
     * @param <date> $strDate
     * @param <int> $style 0=วัน เดือน ปี พ.ศ, 1=เดือน ปี พ.ศ.
     * @return <string> string
     */
    function dateThaiLong($strDate, $style = 0) {
        $strYear = date("Y", strtotime($strDate)) + 543;
        $strMonth = date("n", strtotime($strDate));
        $strDay = date("d", strtotime($strDate));
        $strMonthCut = Array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฏาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
        $strMonthThai = $strMonthCut[$strMonth];

        if ($style == 0) {
            return "$strDay $strMonthThai $strYear";
        } else {
            return "$strMonthThai พ.ศ.$strYear";
        }
    }
    function year($strDate, $style = 0) {
        $strYear = date("Y", strtotime($strDate)) + 543;
        $strMonth = date("n", strtotime($strDate));
        $strDay = date("d", strtotime($strDate));
        $strMonthCut = Array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฏาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
        $strMonthThai = $strMonthCut[$strMonth];

        if ($style == 0) {
            return "$strYear";
        } else {
            return "$strYear";
        }
    }

    /* แปลงวันที่จากฐานข้อมูล ไป TextBox รปแบบวันที่นำเข้า 2009-07-30 */

    function dateToTextShort($strDate) {
        $result = "";
        if ($strDate === "")
            return $this->dateToText(date("Y/m/d"));

        if (substr($strDate, 0, 4) != "0000") {
            $strYear = date("Y", strtotime($strDate)) + 543;
            $strYear = substr($strYear, 2);
            $strMonth = date("m", strtotime($strDate));
            $strDay = date("d", strtotime($strDate));
            $result = "$strDay/$strMonth/$strYear";
        }
        return $result;
    }

    /*
     * หาผลต่างของวันที่และเวลา return เป็นชั่วโมง
     * echo "Date Time Diff = ".dateTimeDiff("2008-08-01 00:00","2008-08-01 19:00")."<br>";
     */

    function dateTimeDiff($strDateTime1, $strDateTime2) {
        return (strtotime($strDateTime2) - strtotime($strDateTime1)) / ( 60 * 60 ); // 1 Hour =  60*60
    }

    //คืนค่าวันที่ การป้อนป้อน 2012-12-01
    function get_dateMySql($date) {
        $day = substr($date, 8, 2);
        return $day;
    }

    function dateThaiLongShot($strDate, $style = 0) {
        $strYear = date("Y", strtotime($strDate)) + 543;
        $strMonth = date("n", strtotime($strDate));
        $strDay = date("d", strtotime($strDate));
        $strMonthCut = Array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
        $strMonthThai = $strMonthCut[$strMonth];

        if ($style == 0) {
            return "$strMonthThai $strYear";
        } else {
            return "$strMonthThai พ.ศ.$strYear";
        }
    }

    function dateThaiLongShotfull($strDate, $style = 0) {
        $strYear = date("Y", strtotime($strDate)) + 543;
        $strMonth = date("n", strtotime($strDate));
        $strDay = date("d", strtotime($strDate));
        $strMonthCut = Array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
        $strMonthThai = $strMonthCut[$strMonth];

        if ($style == 0) {
            return "$strDay $strMonthThai $strYear";
        } else {
            return "$strMonthThai พ.ศ.$strYear";
        }
    }

    //คำนวนหาจำนวนวัน

    function DateDiff($strDate1, $strDate2) {
        return (strtotime($strDate2) - strtotime($strDate1)) / ( 60 * 60 * 24 ) + 1;  // 1 day = 60*60*24
    }

    function TimeDiff($strTime1, $strTime2) {
        return (strtotime($strTime2) - strtotime($strTime1)) / ( 60 * 60 ); // 1 Hour =  60*60
    }
//รูปแบบการแสดงจะเป้นไป ดังนี้
    //เวลาในวินาที
    //ผ่านมา 1 วินาที
    //1 second ago
    //ผ่านมา 3 หรือ 4 วินาที
    //a few seconds ago
    //ผ่านมา 1 นาที
    //1 minute ago
    //ผ่านมา 3 หรือ 4 นาที
    //a few minutes ago
    //ผ่านมาแล้ว 1 ชั่วโมง
    //about an hour ago
    //ผ่านมาแล้ว 7 ชั่วโมง
    //7 hours ago
    //ผ่านมาแล้ว 1 วัน (เมื่อวาน)
    //Yesterday at 11:28am
    //วันอื่นๆ ภายในปีปัจจุบัน
    //December 28 at 9:08am
    //วันอื่นๆ ปีก่อนหน้า
    //December 28, 2010 at 9:08am

    //การใช้งาน
    /*
     * ถ้าเก็บเวลาในรูปแบบ timestamp (ตัวอย่าง 1300950558)
        $date_you=1300950558;
        echo fb_date($date_you);
     *
     * ถ้าเก็บเวลาในรูปแบบ  datetime (ตัวอย่าง 2011-03-24 15:30:50)
        $date_you="2011-03-24 15:30:50";
        echo fb_date(strtotime($date_you));
    */
    function fb_date($timestamp) {
        $difference = time() - $timestamp;
        $periods = array("วินาที", "นาที", "ชั่วโมง");
        $ending = "ที่แล้ว";
        if ($difference < 60) {
            $j = 0;
            $periods[$j].=($difference != 1) ? "" : "";
            $difference = ($difference == 3 || $difference == 4) ? "a few " : $difference;
            $text = "$difference $periods[$j]$ending";
        } elseif ($difference < 3600) {
            $j = 1;
            $difference = round($difference / 60);
            $periods[$j].=($difference != 1) ? "" : "";
            $difference = ($difference == 3 || $difference == 4) ? "a few " : $difference;
            $text = "$difference $periods[$j]$ending";
        } elseif ($difference < 86400) {
            $j = 2;
            $difference = round($difference / 3600);
            $periods[$j].=($difference != 1) ? "" : "";
            $difference = ($difference != 1) ? $difference : "ประมาณ ";
            $text = "$difference $periods[$j]$ending";
        } elseif ($difference < 172800) {
            $difference = round($difference / 86400);
            $periods[$j].=($difference != 1) ? "" : "";
            $text = "Yesterday at " . date("g:ia", $timestamp);
        } else {
            if ($timestamp < strtotime(date("Y-01-01 00:00:00"))) {
                $text = date("l j, Y", $timestamp) . " at " . date("g:ia", $timestamp);
            } else {
                $text = date("l j", $timestamp) . " at " . date("g:ia", $timestamp);
            }
        }
        return $text;
    }
    function fb_thaidate($timestamp){
	
	$diff = time() - $timestamp;
	$periods = array("วินาที", "นาที", "ชั่วโมง");	
	$words="ที่แล้ว";
	
	if($diff<60){
		$i=0;
		$diff=($diff==1)?"":$diff;
		$text = "$diff $periods[$i]$words";	
		
	}elseif($diff<3600){
		$i=1;
		$diff=round($diff/60);
		$diff=($diff==3 || $diff==4)?"":$diff;
		$text = "$diff $periods[$i]$words";	
		
	}elseif($diff<86400){
		$i=2;
		$diff=round($diff/3600);
		$diff=($diff != 1)?$diff:"" . $diff ;		
		$text = "$diff $periods[$i]$words";	
		
	}elseif($diff<172800){
		$diff=round($diff/86400);
		$text = "$diff วันที่แล้ว เมื่อเวลา " .date("g:i a",$timestamp);			
							
	}else{

		$thMonth = array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฏาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
		$date = date("j", $timestamp);
		$month = $thMonth[date("m", $timestamp)-1];
		$y = date("Y", $timestamp)+543;
		$t1 = "$date  $month  $y";
		$t2 = "$date  $month  ";		

		if($timestamp<strtotime(date("Y-01-01 00:00:00"))){
			$text = $t1;
		}else{					
			$text =  $t2;	
		}
	}
	return $text;
}
}