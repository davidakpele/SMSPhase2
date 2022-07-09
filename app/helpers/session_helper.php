<?php
    function isLoggedDashboardController(){
        if (isset($_SESSION['DashboardID'])){
            return true;
        }else {
            return false;
        }
    }
    function iscsrf(){
        if (isset($_SESSION['base']) && isset($_SESSION['csrf']) && isset($_SESSION['saltcsrf'])) {
            return true;
            } else {
            return false;
        }
    }
    
    function isLoggedManagement(){
       if (isset($_SESSION['ProfessorID']) && isset( $_SESSION['Prof_email']) && isset( $_SESSION['UsenrNin']) && isset($_SESSION['Accesscode']) && isset($_SESSION['Fullname']) && isset($_SESSION['Profile__Picture']) && isset($_SESSION['expire'])) {
            return true;
            } else {
            return false;
        }
    }
    function isLoggedInStudent(){
        if (isset($_SESSION['globalname']) && isset($_SESSION['Department']) && isset($_SESSION['Reference']) && isset($_SESSION['student__Id'])) {
            return true;
            } else {
            return false;
        }
    }
    function isLoggedInAccountant(){
        if (isset($_SESSION['AccountantID'])  && isset($_SESSION['Department_name']) && isset($_SESSION['Accesscode']) && isset($_SESSION['Profile__Picture'])) {
            return true;
            } else {
            return false;
        }
    }
     function isLoggedInHr(){
        if (isset($_SESSION['HRID']) && isset($_SESSION['Department_name']) && isset($_SESSION['Accesscode']) && isset($_SESSION['Profile__Picture'])) {
            return true;
            } else {
            return false;
        }
    }
     function isLoggedInStaff(){
        if (isset($_SESSION['StaffID']) && isset($_SESSION['Department_name']) && isset($_SESSION['Accesscode']) && isset($_SESSION['Profile__Picture'])) {
            return true;
            } else {
            return false;
        }
    }
    function isLoggedInParent(){
        if (isset($_SESSION['Email']) && isset($_SESSION['othername'])) {
            return true;
            } else {
            return false;
        }
    }
    function isLoggedIn(){
        if (isset($_SESSION['Access__No']) && isset($_SESSION['username'])) {
            return true;
            } else {
            return false;
        }
    }
   
if(isset($_SESSION['success_flash'])){
    echo '<script>alert("'.$_SESSION['success_flash'].'")</script>';
    unset($_SESSION['success_flash']);
}
if(isset($_SESSION['error_flash'])){
    echo '<div class="bg-danger"><p class="text-danger text-center">'.$_SESSION['error_flash'].'</p></div>';
    unset($_SESSION['error_flash']);
}
 function pretty_date($date){
    return date("M d, Y, h:i A", strtotime($date));
}

function pretty_html_special_characters($text){
    $text = htmlspecialchars($text);
    $text = preg_replace("/=/", "=\"\"", $text);
    $text = preg_replace("/&quot;/", "&quot;\"", $text);
    $tags = "/&lt;(\/|)(\w*)(\ |)(\w*)([\\\=]*)(?|(\")\"&quot;\"|)(?|(.*)?&quot;(\")|)([\ ]?)(\/|)&gt;/i";
    $replacement = "<$1$2$3$4$5$6$7$8$9$10>";
    $text = preg_replace($tags, $replacement, $text);
    $text = preg_replace("/=\"\"/", "=", $text);
    return $text;
}
function htmlspanishchars($str)
{
    return str_replace(array("&lt;", "&gt;"), array("<", ">"), htmlspecialchars($str, ENT_NOQUOTES, "UTF-8"));
}
