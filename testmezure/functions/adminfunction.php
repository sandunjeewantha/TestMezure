<?php
session_start();

function LoginCheck()
{
    if (!isset($_SESSION['aduserName'])) {
        OpenURL("adminlogin.php");
    }
}

if (isset($_POST['ad-btn-login'])) {
    Login();
}

if (isset($_POST['btnQAAdd'])) {
    AddQuection();
}
if (isset($_POST['btnQAEdit'])) {
    UpdateQATalks();
}

function Login()
{
    $emailId = $_POST['ad-login-email'];
    $password = $_POST['ad-login-password'];

    $sql = "SELECT password,id FROM users WHERE email = '$emailId' AND usertype = 1";

    if ($row = mysqli_fetch_assoc(get_data($sql))) {
        if (PasswordEncryption($password) == $row['password']) {
            $_SESSION['aduserName'] = $emailId;
            $_SESSION['aduser-id'] = $row['id'];
            DisplayMassage('Login successfully.!');
            OpenURL('admin.php');
        } else {
            DisplayMassage('Login failed.!');
        }
    }
}
function LogOut()
{
    session_destroy();
    OpenURL('adminlogin.php');
}

function GetAllInquaries()
{
    $sql = "SELECT * FROM inquiry";
    if ($row = get_data($sql)) {
        return $row;
    } else {
        return null;
    }
}

function GetAllPost()
{
    //$sql = "SELECT * FROM quection where status = 0";
    $sql = "SELECT * FROM quection";
    if ($row = get_data($sql)) {
        return $row;
    } else {
        return null;
    }
}

function GetPostById($id)
{
    //$sql = "SELECT * FROM quection where status = 0";
    $sql = "SELECT * FROM quection WHERE id = $id";
    if ($row = get_data($sql)) {
        return $row;
    } else {
        return null;
    }
}

function LoadQATalks()
{
    $sql = "SELECT * FROM teachqa";
    if ($row = get_data($sql)) {
        return $row;
    } else {
        return null;
    }
}

function LoadQATalksById($id)
{
    $sql = "SELECT * FROM teachqa WHERE id = $id";
    if ($row = get_data($sql)) {
        return $row;
    } else {
        return null;
    }
}

function RemoveQATalks($id)
{
    $sql = "DELETE FROM teachqa WHERE id = $id";
    if (set_data($sql)) {
        $sql1 = "DELETE FROM testcase WHERE fid = $id";
        if (set_data($sql1)){
            DisplayMassage('Removed!.');
            OpenURL('teachqa.php');
        }
    }
}
function AddQuection()
{
    if(!isset($_SESSION['aduserName'])){
        DisplayMassage("Login first.!");
        OpenURL('login.php');
    }
    $quText = $_POST['qu-text'];
    $uid = $_SESSION['user-id'];
    $uemail = $_SESSION['aduserName'];

    $sql1 = "INSERT INTO teachqa(teach) VALUES
            ('$quText')";

    if (set_data($sql1)) {
        DisplayMassage('Successfully.!');
    }
    else {
        DisplayMassage('Failed.!');
    }
    OpenURL('teachqa.php');
}

function UpdateQuectionStatus($qid,$status){
    $sql = "";

    if($status == 1){
        $sql = "UPDATE quection SET status = $status WHERE id = $qid";
    }
    else if($status == 0) {
        $sql = "DELETE FROM quection WHERE id = $qid";

    }
    if (set_data($sql)) {
        DisplayMassage('Successfully.!');
    }
    else {
        DisplayMassage('Failed.!');
    }
    OpenURL('posts.php');
}

function UpdateQATalks(){
    $id = $_POST['id'];
    $teach = $_POST['qu-text'];

    $sql = "UPDATE teachqa SET teach = '$teach' WHERE id = $id";
    
    if (set_data($sql)) {
        DisplayMassage('Successfully.!');
    }
    else {
        DisplayMassage('Failed.!');
    }
    OpenURL('teachqa.php');
}



//other functions
function OpenURL($url)
{
    echo "<script> location.replace('$url'); </script>";
}

function DisplayMassage($msg)
{
    echo "<script> alert('$msg');</script>";
}

function consoleLog($msg)
{
    echo "<script> console.log('$msg');</script>";
}
function PasswordEncryption($value)
{
    return sha1($value);
}

function PasswordCheck($pw1, $pw2)
{
    return $pw1 == $pw2 ? true : false;
}
function GetUserName($name){
    return substr($name, 0, strpos($name, '@'));
}














?>