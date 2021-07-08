<?php //decode by 小猪php解密 QQ:2338208446 http://www.xzjiemi.com/ ?>
<?php

/*
 Encode by 3197929874
*/
error_reporting(0);
function getTopDomainhuo()
{
    $host = $_SERVER["HTTP_HOST"];
    $matchstr = "[^\\.]+\\.(?:(" . $str . ")|\\w{2}|((" . $str . ")\\.\\w{2}))\$";
    if (preg_match("/" . $matchstr . "/ies", $host, $matchs)) {
        $domain = $matchs["0"];
    } else {
        $domain = $host;
    }
    return $domain;
}
$domain = getTopDomainhuo();
$real_domain = "baidu.com";
$check_host = "http://sq.klingla.com/update.php";
$client_check = $check_host . "?a=client_check&u=" . $_SERVER["HTTP_HOST"];
$check_message = $check_host . "?a=check_message&u=" . $_SERVER["HTTP_HOST"];
 
unset($domain);
defined("THINK_PATH") or exit;
class akmallAction extends Action
{
    protected $uid;
    protected $username;
    function _init()
    {
        $this->akmallAuth();
        if (empty($_SESSION["user"]["id"])) {
            $this->display("Index::login", false);
            exit;
        }
        $this->uid = (int) $_SESSION["user"]["id"];
        $this->role = $_SESSION["user"]["role"];
        $this->username = $_SESSION["user"]["username"];
        $http_type = isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on" || isset($_SERVER["HTTP_X_FORWARDED_PROTO"]) && $_SERVER["HTTP_X_FORWARDED_PROTO"] == "https" ? "https://" : "http://";
        $this->akmallHost = $http_type . $_SERVER["HTTP_HOST"] . C("akmall_ROOT");
    }
    function proccess($module = '')
    {
        $this->checkAuth();
        $module = empty($module) ? $this->getActionName() : $module;
        $status = 0;
        $Model = D($module);
        $do = "delete";
        if ($_REQUEST["do"] === "delete") {
            $status = $Model->delete((int) $_REQUEST["id"]);
        } else {
            if ($_REQUEST["do"] === "del") {
                $status = $Model->where(array("id" => (int) $_REQUEST["id"]))->setField("is_delete", 1);
            } else {
                if ($vo = $Model->create($_REQUEST)) {
                    if (empty($vo["id"])) {
                        $options = isset($_POST["item_id"]) ? array("item_id" => $_POST["item_id"]) : array();
                        $_REQUEST["id"] = $Model->add($vo, $options);
                        $status = $_REQUEST["id"] ? 1 : 0;
                        $do = "add";
                    } else {
                        $status = $Model->save($vo);
                        $do = "modify";
                    }
                }
            }
        }
        if ($vo["id"]) {
            $data = $Model->where(array("id" => $vo["id"]))->find();
            $id = "Item" == $module ? $data["sn"] : $data["id"];
            cache($module . $id, $data);
        } else {
            cache($module . $_REQUEST["id"], null);
        }
        $info = $Model->getError();
        if ($status) {
            $info = lang("action_success");
            $content = lang($do . "_" . $module) . ",ID:" . $_REQUEST["id"];
            $logs = array("types" => $module, "content" => $content, "username" => $this->username);
            $this->writeLogs($logs);
        }
        $this->ajaxReturn(null, $info, (int) $status);
    }
    public function deleteAll($is_return = true)
    {
        $this->checkAuth('');
        $module = isset($_POST["model"]) ? ucfirst($_POST["model"]) : MODULE_NAME;
        $Model = D($module);
        if (isset($_POST["del"])) {
            foreach ($_POST["id"] as $id) {
                M($module)->save(array("id" => $id, "is_delete" => 1));
            }
        } else {
            foreach ($_POST["id"] as $id) {
                $Model->delete((int) $id);
            }
        }
        $content = lang("delete_" . $module) . ",ID:" . implode(",", $_REQUEST["id"]);
        $logs = array("types" => $module, "content" => $content, "username" => $this->username);
        $this->writeLogs($logs);
        R("Public/clearCache", array("print" => false));
        if ($is_return) {
            if (IS_AJAX) {
                $this->ajaxReturn(0, "删除成功", 1);
            } else {
                $this->success("删除成功");
            }
        }
    }
    function checkAuth($type = "ajax")
    {
        if ($_REQUEST["auth"] == 1) {
            return true;
        }
    }
    function akmallExcel($data, $keynames, $filename, $saveAs = true, $title = '')
    {
        Vendor("PHPExcel.PHPExcel");
        $objExcel = new PHPExcel();
        $chars = "A";
        $num = 1;
        if ($title) {
            $objExcel->getActiveSheet()->setCellValue($chars . $num, $title);
            $num++;
            $i = 1;
        }
        foreach ($keynames as $key => $va) {
            $objExcel->getActiveSheet()->setCellValueExplicit($chars . $num, "{$va}", PHPExcel_Cell_DataType::TYPE_STRING);
            $objExcel->getActiveSheet()->getColumnDimension($chars)->setWidth(20);
            $chars++;
        }
        foreach ($data as $key => $o) {
            $char = "a";
            $u1 = $i + 2;
            foreach ($keynames as $k => $v) {
                if (strpos($k, "||")) {
                    $arr = explode("||", $k);
                    $_str = is_null($o[$arr[0]]) ? "null" : $o[$arr[0]];
                    $eval = str_replace("###", $_str, $arr[1]);
                    eval("{$rs} = {$eval};");
                    $line = $rs;
                } else {
                    if (strpos($k, "##")) {
                        $arr = explode("##", $k);
                        $data = json_decode($arr[1], true);
                        $line = $data[$o[$arr[0]]];
                    } else {
                        $line = $o[$k];
                    }
                }
                $objExcel->getActiveSheet()->setCellValueExplicit($char . $u1, $line, PHPExcel_Cell_DataType::TYPE_STRING);
                $objExcel->getDefaultStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                $char++;
            }
            $i++;
        }
        $objExcel->getActiveSheet()->getHeaderFooter()->setOddHeader("&L&BPersonal cash register&RPrinted on &D");
        $objExcel->getActiveSheet()->getHeaderFooter()->setOddFooter("&L&B" . $objExcel->getProperties()->getTitle() . "&RPage &P of &N");
        $objExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
        $objExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
        $objExcel->setActiveSheetIndex(0);
        $timestamp = date("Y-m-d");
        if ($ex == "2007") {
            header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
            header("Content-Disposition: attachment;filename=\"" . $filename . ".xlsx\"");
            header("Cache-Control: max-age=0");
            $objWriter = PHPExcel_IOFactory::createWriter($objExcel, "Excel2007");
            $objWriter->save("php://output");
            exit;
        } else {
            if ($saveAs == false) {
                $objWriter = PHPExcel_IOFactory::createWriter($objExcel, "Excel5");
                $objWriter->save($filename . ".xls");
            } else {
                header("Content-Type: application/vnd.ms-excel;charset=UTF-8");
                header("Content-Disposition: attachment;filename=\"" . $filename . ".xls\"");
                header("Cache-Control: max-age=0");
                $objWriter = PHPExcel_IOFactory::createWriter($objExcel, "Excel5");
                $objWriter->save("php://output");
                exit;
            }
        }
    }
    function footer()
    {
        $copyright = "<p class=\"copyright\" style=\"display:block !important;\">Copyright © " . date("Y") . "&nbsp;<a href=\"http://www.akmall.cc\" target=\"_blank\" style=\"color:#888 !important;display:inline-block  !important;\">AK单页订单管理系统企业版</a>&nbsp; All Rights Reserved.</p> ";
        echo "<script>\$(function(){ \$(\"body\").append('<div id=\"Footer\" style=\"display:block !important;\">" . $copyright . "</div>'); })</script>";
    }
    function display($tpl, $show_footer = true)
    {
        parent::display($tpl);
        if ($show_footer == true) {
            $this->footer();
        }
    }
    function akmallAuth()
    {
        header("Content-Type:text/html;charset=utf-8");
        $cacheauth = md5("akmallAuth");
        $authCode = cache($cacheauth);
        $md5Code = md5("akmallAuth");
        if ($authCode == $md5Code) {
            return true;
        } else {
            $code = C("akmall_AUTH");
            $codeip = substr($code, 32, 32);
            $codehost = substr(substr($code, -52), 10, 32);
            $HTTP_HOST = explode(":", $_SERVER["HTTP_HOST"]);
            $host = $HTTP_HOST[0];
            $md5host = md5($host . "cc");
            if ($md5host == $codehost) {
                cache($cacheauth, $md5Code, 7200);
                return true;
            } else {
                $ip = gethostbyname($host);
                $md5ip = md5($ip . "618");
                if ($md5ip == $codeip) {
                    cache($cacheauth, $md5Code, 7200);
                    return true;
                } else {
                    $ip = gethostbyname($host);
                    if ($ip == "127.0.0.1") {
                        return true;
                    }
                }
            }
        }
    }
    function ping($address)
    {
        $status = -1;
        if (strcasecmp(PHP_OS, "WINNT") === 0) {
            $pingresult = exec("ping -n 1 {$address}", $outcome, $status);
        } else {
            if (strcasecmp(PHP_OS, "Linux") === 0) {
                $pingresult = exec("ping -c 1 {$address}", $outcome, $status);
            }
        }
        if (0 == $status) {
            preg_match("/[0-9]{1,3}\\.[0-9]{1,3}\\.[0-9]{1,3}\\.[0-9]{1,3}/", implode(" ", $outcome), $ip);
            $status = $ip[0];
        } else {
            $status = false;
        }
        return $status;
    }
    public function akmallConfig()
    {
        $config = cache("akmallConfig");
        if (empty($config)) {
            $list = M("Setting")->select();
            foreach ($list as $li) {
                $config[$li["name"]] = $li["value"];
            }
            cache("akmallConfig", $config, 8640000);
        }
        return $config;
    }
    public function writeLogs($logs)
    {
        if (in_array($logs["types"], array("Login", "Item", "Order"))) {
            $logs["add_ip"] = get_client_ip();
            $logs["add_time"] = date("Y-m-d H:i:s");
            M("UserLogs")->add($logs);
        }
    }
}