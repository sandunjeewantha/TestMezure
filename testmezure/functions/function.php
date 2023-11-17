<?php
session_start();
$workspaceName = "";
//local conditions
if (isset($_POST['signUpButton'])) {
    CreateAccount();
}

if (isset($_POST['loginButton'])) {
    Login();
}

if (isset($_POST['createWorkspace'])) {
    CreateWorkspace();
}

if (isset($_POST['addMembers'])) {
    AddMembers();
}

if (isset($_POST['inqrBtn'])) {
    AddInquiry();
}

if (isset($_GET['mmr'])) {
    $mmr = $_GET['mmr'];
    RemoveMember($mmr);
}

if (isset($_POST['btnQAdd'])) {
    AddQuection();
}

if (isset($_POST['btnQAAdd'])) {
    AddQuectionAnswer();
}

if (isset($_POST['btnQAUpdate'])) {
    UpdateQuectionAnswer();
}

if (isset($_GET['qid']) && isset($_GET['dl']) && isset($_GET['rid'])) {
    $qid = $_GET['qid'];
    $dl = $_GET['dl'];
    $rid = $_GET['rid'];
    if($dl == 1){
        DeleteReply($qid,$rid);
    }
    
}

if (isset($_POST['btn-addFolder'])) {
    AddFolder();
}

if (isset($_POST['btn-editFolder'])) {
    UpdateFolder();
}

if (isset($_POST['btnAddtestCase'])) {
    AddTestCase();
}

if (isset($_POST['btnEdittestCase'])) {
    EditTestCase();
}

if (isset($_POST['btnAddtestDesign'])) {
    AddTestDesign();
}

if (isset($_POST['btnEdittestDesign'])) {
    EditTestDesign();
}

if (isset($_POST['btnAddtestAutomation'])) {
    AddTestAuto();
}

if (isset($_POST['btnEdittestAutomation'])) {
    EditTstAutomation();
}

if (isset($_POST['btnAddtestOther'])) {
    AddTestOther();
}

if (isset($_POST['btnEdittestOther'])) {
    EditTstOther();
}

if (isset($_POST['btn-addCycle'])) {
    AddTestCycle();
}

if (isset($_POST['btn-editCycle'])) {
    UpdateCycle();
}

if (isset($_GET['add']) && isset($_GET['tcaid']) && isset($_GET['tcyid'])) {
    $add = $_GET['add'];
    $tcaid = $_GET['tcaid'];
    $tcyid = $_GET['tcyid'];
    if($add == 1){
        AddtestcycleTestCase($tcaid,$tcyid);
    }
    
}

if (isset($_GET['tctcdel']) && isset($_GET['tctcyid'])) {
    $tctcdel = $_GET['tctcdel'];
    $tctcyid = $_GET['tctcyid'];
    if($tctcdel == 1){
        RemovetestcycleTestCase($tctcyid);
    }
    
}

if (isset($_GET['st']) && isset($_GET['testcyst']) && isset($_GET['tctcyid']) && isset($_GET['tcyid'])) {
    $st = $_GET['st'];
    $testcyst = $_GET['testcyst'];
    $tctcyid = $_GET['tctcyid'];
    $tcyid = $_GET['tcyid'];
    if($testcyst == 1){
        UpdatetestcycleTestCase($tctcyid,$st,$tcyid);
    }
    
}

if (isset($_POST['iss-btn'])) {
    $id = $_POST['iss-id'];
    $st = $_POST['iss-text'];
    $tcid = $_POST['iss-tcid'];
   UpdatetestcycleTestCase($id,$st,$tcid);
}

//functions

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

function LoginCheck()
{
    if (!isset($_SESSION['userName'])) {
        OpenURL("login.php");
    }
}


function PasswordEncryption($value)
{
    return sha1($value);
}

function PasswordCheck($pw1, $pw2)
{
    return $pw1 == $pw2 ? true : false;
}

function CreateAccount()
{
    $emailId = $_POST['signup-email'];
    $password = $_POST['signup-password'];
    $confirmePassword = $_POST['confirm-password'];
    $enPassword = PasswordEncryption($password);

    if (PasswordCheck($password, $confirmePassword)) {
        $sql = "INSERT INTO users(email,password) VALUES('$emailId','$enPassword')";
        if (set_data($sql)) {
            DisplayMassage('User account creation successfully.!');
            OpenURL('login.php');
        }
    } else {
        DisplayMassage('Password and Confirm Password should match.!');
    }
}

function LogOut()
{
    session_destroy();
    OpenURL('login.php');
}

function Login()
{
    $emailId = $_POST['login-email'];
    $password = $_POST['login-password'];

    //$sql = "SELECT u.password,u.id,w.isAdmin FROM users as u  INNER JOIN workspaceUsers w ON u.id = w.uid WHERE u.email = '$emailId'";
    $sql = "SELECT password,id FROM users WHERE email = '$emailId'";

    if ($row = mysqli_fetch_assoc(get_data($sql))) {
        if (PasswordEncryption($password) == $row['password']) {
            $_SESSION['userName'] = $emailId;
            $_SESSION['user-id'] = $row['id'];
            
            $sql2 = "SELECT isAdmin FROM workspaceUsers WHERE email = '$emailId'";
            
            if ($row1 = mysqli_fetch_assoc(get_data($sql2))) {
                DisplayMassage('Login successfully.!');
                if($row1['isAdmin'] == 0){
                    OpenURL('folders.php');
                }
                else{
                    OpenURL('index.php');
                }
            }
            else{
                DisplayMassage('Login successfully.!');
                OpenURL('index.php');
            }
            
            
            
            
        } else {
            DisplayMassage('Login failed.!');
        }
    }
}

function CreateWorkspace()
{
    $email = $_SESSION['userName'];
    $userType = $_POST['userType'];
    $workspaceName = $_POST['workspaceName'];

    $sql = "INSERT INTO workspace(name,email,usertype) VALUES('$workspaceName','$email','$userType')";
    if (set_data($sql)) {

        $userWorkspace = GetWorkspaceByEmail($email);
        $userDetails = GetUserByEmail($email);
        $userDetails = mysqli_fetch_assoc($userDetails);

        $wid = $userWorkspace['id'];
        $uid = $userDetails['id'];

        $sql2 = "INSERT INTO workspaceUsers(wid,wname,uid,email,isAdmin) VALUES
        ('$wid','$workspaceName','$uid','$email',1)";

        if (set_data($sql2)) {
            $_SESSION['CreateWSSt'] = true;
            $_SESSION['CreateWSName'] = $workspaceName;
            DisplayMassage('Workspace creation successfully.!');
        }

        //OpenURL('testmezure.php');
    }
}

function AddMembers()
{
    $email = $_POST['ad-email'];
    $workspaceName = $_SESSION['WorkspaceName'];
    $wid = $_SESSION['WorkspaceId'];

    $userWorkspace = GetWorkspaceUsersById($wid);
    $WorkspaceUserDetails = GetWorkspaceUserByEmail($email);

    if ($WorkspaceUserDetails == null) {
        $userDetailspost = GetUserByEmail($email);
        $uid = null;
        if ($userDetails = mysqli_fetch_assoc($userDetailspost)) {
            $uid = $userDetails['id'];

            $sql2 = "INSERT INTO workspaceUsers(wid,wname,uid,email,isAdmin) VALUES
            ('$wid','$workspaceName','$uid','$email',0)";

            if (set_data($sql2)) {
                $_SESSION['CreateWSSt'] = true;
                $_SESSION['CreateWSName'] = $workspaceName;
                DisplayMassage('Member added into ' . $workspaceName);
            }
        } else {
            DisplayMassage('User account does not exist!.');
        }
    } else {
        DisplayMassage('User already member of one workspace!.');
    }
}

function AddInquiry()
{
    $inqrFName = $_POST['inqr-fName'];
    $inqrEmail = $_POST['inqr-email'];
    $inqrSubject = $_POST['inqr-subject'];
    $inqrMessage = $_POST['inqr-message'];

    $sql1 = "INSERT INTO inquiry(fullName,email,subject,message) VALUES
            ('$inqrFName','$inqrEmail','$inqrSubject','$inqrMessage')";

    if (set_data($sql1)) {
        DisplayMassage('Inquiry Sending Successfully.!');
    }
    else {
        DisplayMassage('Inquiry Sending Failed.!');
    }
   
}

function AddQuection()
{
    if(!isset($_SESSION['user-id'])){
        DisplayMassage("Login first,Before posting quection");
        OpenURL('login.php');
    }
    $quText = $_POST['qu-text'];
    $uid = $_SESSION['user-id'];
    $uemail = $_SESSION['userName'];

    $sql1 = "INSERT INTO quection(uid,uemail,quection) VALUES
            ('$uid','$uemail','$quText')";

    if (set_data($sql1)) {
        DisplayMassage('Quection adding Successfully.!');
    }
    else {
        DisplayMassage('Quection adding Failed.!');
    }
    OpenURL('qatalks.php');
}

function AddQuectionAnswer()
{
    if(!isset($_SESSION['user-id'])){
        DisplayMassage("Login first,Before posting answer.!");
        OpenURL('login.php');
    }
    $quAnsw = $_POST['qa-text'];
    $quid = $_POST['qa-id'];
    $uid = $_SESSION['user-id'];
    $uemail = $_SESSION['userName'];

    $sql1 = "INSERT INTO qanswer(qid,ruid,ruemail,answer) VALUES
            ($quid ,'$uid','$uemail','$quAnsw')";

    if (set_data($sql1)) {
        DisplayMassage('Quection Answer Submit Successfully.!');
    }
    else {
        DisplayMassage('Quection Answer Submit Failed.!');
    }
    OpenURL('reply.php?qid='.$quid);
}

function UpdateQuectionAnswer()
{
    if(!isset($_SESSION['user-id'])){
        DisplayMassage("Login first,Before posting answer.!");
        OpenURL('login.php');
    }
    $quAnsw = $_POST['qa-utext'];
    $quid = $_POST['qa-uid'];
    $ansid = $_POST['answ-id'];
    $uid = $_SESSION['user-id'];
    $uemail = $_SESSION['userName'];

    $sql1 = "UPDATE qanswer SET answer = '$quAnsw' WHERE qid = $quid AND id = $ansid";

    if (set_data($sql1)) {
        DisplayMassage('Quection Answer Update Successfully.!');
    }
    else {
        DisplayMassage('Quection Answer Update Failed.!');
    }
    OpenURL('reply.php?qid='.$quid);
}

function DeleteReply($qid,$rid)
{
    if(!isset($_SESSION['user-id'])){
        DisplayMassage("Login first.!");
        OpenURL('login.php');
    }


    $sql1 = "DELETE FROM qanswer WHERE id = $rid AND qid = $qid";

    if (set_data($sql1)) {
        DisplayMassage('Successfully Deleted.!');
    }
    else {
        DisplayMassage('Failed.!');
    }
    OpenURL('reply.php?qid='.$qid);
}

function GetWorkspaceByEmail($email)
{
    $sql = "SELECT * FROM workspace WHERE email = '$email'";
    if ($row = mysqli_fetch_assoc(get_data($sql))) {
        return $row;
    } else {
        return null;
    }
}

function GetWorkspaceUserByEmail($email)
{
    $sql = "SELECT * FROM workspaceUsers WHERE email = '$email'";
    if ($row = mysqli_fetch_assoc(get_data($sql))) {
        return $row;
    } else {
        return null;
    }
}

function GetWorkspaceUsersById($wid)
{
    $sql = "SELECT * FROM workspaceUsers WHERE wid = '$wid'";
    if ($post = get_data($sql)) {
        return $post;
    } else {
        return null;
    }
}

function GetUserByEmail($email)
{
    $sql = "SELECT * FROM users WHERE email = '$email'";
    if ($row = get_data($sql)) {
        return $row;
    } else {
        return null;
    }
}

function LoadWorkstation()
{
    $email = $_SESSION['userName'];
    $userWorkspace = GetWorkspaceByEmail($email);
    $WorkspaceUserDetails = GetWorkspaceUserByEmail($email);
    

    //for workspace admin
    if ($userWorkspace != null) {
        $_SESSION['CreateWSSt'] = true;
        $_SESSION['WorkspaceName'] = $userWorkspace['name'];
        $_SESSION['WorkspaceId'] = $userWorkspace['id'];
        $workspaceName = $userWorkspace != null ? $userWorkspace['name'] : '';
    }
    //for workspace member
    else if ($WorkspaceUserDetails != null) {
        $_SESSION['HaveWS'] = true;
        $_SESSION['isMember'] = true;
        $_SESSION['WorkspaceName'] = $WorkspaceUserDetails['wname'];
        $_SESSION['WorkspaceId'] = $WorkspaceUserDetails['wid'];
        
    }
}

function RemoveMember($id)
{
    $sql = "DELETE FROM workspaceUsers WHERE id = $id";
    if (set_data($sql)) {
        DisplayMassage('Member removed!.');
        OpenURL('testmezure.php');
    }
}

function LoadQuections()
{
    $sql = "SELECT * FROM quection where status = 1";
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

function GetQuectionById($id)
{
    $sql = "SELECT * FROM quection WHERE id = $id";
    if ($row = get_data($sql)) {
        return $row;
    } else {
        return null;
    }
}

function LoadAnswers($qid)
{
    $sql = "SELECT * FROM qanswer WHERE qid = $qid";
    if ($row = get_data($sql)) {
        return $row;
    } else {
        return null;
    }
}

function LoadAnswersById($id)
{
    $sql = "SELECT * FROM qanswer WHERE id = $id";
    if ($row = get_data($sql)) {
        return $row;
    } else {
        return null;
    }
}

function GetUserName($name){
    return substr($name, 0, strpos($name, '@'));
}

//folder
function AddFolder()
{
    if(!isset($_SESSION['user-id'])){
        DisplayMassage("Login first,Before posting quection");
        OpenURL('login.php');
    }
    $folderName = $_POST['folderName'];
    $cuid = $_SESSION['user-id'];
    $cuemail = $_SESSION['userName'];
    $wid = $_SESSION['WorkspaceId'];

    $sql1 = "INSERT INTO folder(name,wid,cuid,cuemail) VALUES
            ('$folderName','$wid','$cuid','$cuemail')";

    if (set_data($sql1)) {
        DisplayMassage('Folder Adding Successfully.!');
    }
    else {
        DisplayMassage('Folder Adding Failed.!');
    }
    OpenURL('folders.php');
}

function GetFolder()
{
    $wid = $_SESSION['WorkspaceId'];

    $cuid = $_SESSION['user-id'];
    //$sql = "SELECT * FROM folder WHERE cuid = $cuid";
    $sql = "SELECT * FROM folder WHERE wid = $wid";
    if ($row = get_data($sql)) {
        return $row;
    } else {
        return null;
    }
}

function GetFolderById($id)
{
    $sql = "SELECT * FROM folder WHERE id = $id";
    if ($row = get_data($sql)) {
        return $row;
    } else {
        return null;
    }
}

function RemoveFolder($id)
{
    $sql = "DELETE FROM folder WHERE id = $id";
    if (set_data($sql)) {
        $sql1 = "DELETE FROM testcase WHERE fid = $id";
        if (set_data($sql1)){
            DisplayMassage('Folder removed!.');
            OpenURL('folders.php');
        }
    }
}

function UpdateFolder()
{
    $id = $_POST['edfolderId'];
    $name = $_POST['edfolderName'];

    $sql = "UPDATE folder SET name='$name' WHERE id = $id";
    if (set_data($sql)) {
        DisplayMassage('Folder Updated!.');
        OpenURL('folders.php');
    }
}

//tets case

function AddTestCase()
{
    if(!isset($_SESSION['user-id'])){
        DisplayMassage("Login first.");
        OpenURL('login.php');
    }
    $testCaseFolder = $_POST['testCaseFolder'];
    $testCaseText = $_POST['testCaseText'];
    $tcVersion = $_POST['tcVersion'];

    if($testCaseFolder > 0){
        $cuid = $_SESSION['user-id'];
        $cuemail = $_SESSION['userName'];
        $wid = $_SESSION['WorkspaceId'];
    
        $sql1 = "INSERT INTO testcase(fid,wid,cuid,testcase,version) VALUES
                ('$testCaseFolder','$wid','$cuid','$testCaseText','$tcVersion')";
    
        if (set_data($sql1)) {
            DisplayMassage('Tets Case Adding Successfully.!');
        }
        else {
            DisplayMassage('Tets Case Adding Failed.!');
        }
        OpenURL('testcases.php');
    }
    else{
        DisplayMassage('Please select folder.!');
        OpenURL('testcases.php');
    }
    
}

function EditTestCase()
{
    if(!isset($_SESSION['user-id'])){
        DisplayMassage("Login first.");
        OpenURL('login.php');
    }
    $testCaseFolder = $_POST['testCaseFolder'];
    $testCaseText = $_POST['testCaseText'];
    $edtcid = $_POST['edtcid'];
    $tcVersion = $_POST['tcVersion'];

    if($testCaseFolder > 0){
        $sql1 = "UPDATE testcase SET fid = '$testCaseFolder' ,testcase = '$testCaseText',version = '$tcVersion' WHERE id = $edtcid";
    
        if (set_data($sql1)) {
            DisplayMassage('Tets Case Update Successfully.!');
        }
        else {
            DisplayMassage('Tets Case Update Failed.!');
        }
        OpenURL('foldersview.php?vw=1&flid='.$testCaseFolder);
    }
    else{
        DisplayMassage('Please select folder.!');
        OpenURL('testcases.php');
    }   
}

function EditTestDesign()
{
    if(!isset($_SESSION['user-id'])){
        DisplayMassage("Login first.");
        OpenURL('login.php');
    }
    $testCaseFolder = $_POST['testCaseFolder'];
    $testCaseText = $_POST['testCaseText'];
    $edtcid = $_POST['edtcid'];
    $tcVersion = $_POST['tcVersion'];

    if($testCaseFolder > 0){
        $sql1 = "UPDATE testdesign SET fid = '$testCaseFolder' ,testcase = '$testCaseText',version = '$tcVersion' WHERE id = $edtcid";
    
        if (set_data($sql1)) {
            DisplayMassage('Tets Design update Successfully.!');
        }
        else {
            DisplayMassage('Tets Design update Failed.!');
        }
        OpenURL('foldersview.php?vw=1&flid='.$testCaseFolder);
    }
    else{
        DisplayMassage('Please select folder.!');
        OpenURL('testcases.php');
    }
}

function EditTstAutomation()
{
    if(!isset($_SESSION['user-id'])){
        DisplayMassage("Login first.");
        OpenURL('login.php');
    }
    $testCaseFolder = $_POST['testCaseFolder'];
    $testCaseText = $_POST['testCaseText'];
    $edtcid = $_POST['edtcid'];
    $tcVersion = $_POST['tcVersion'];

    if($testCaseFolder > 0){
        $sql1 = "UPDATE testautomation SET fid = '$testCaseFolder' ,testcase = '$testCaseText',version = '$tcVersion' WHERE id = $edtcid";
    
        if (set_data($sql1)) {
            DisplayMassage('Tets Automation update Successfully.!');
        }
        else {
            DisplayMassage('Tets Automation update Failed.!');
        }
        OpenURL('foldersview.php?vw=1&flid='.$testCaseFolder);
    }
    else{
        DisplayMassage('Please select folder.!');
        OpenURL('testcases.php');
    } 
}

function EditTstOther()
{
    if(!isset($_SESSION['user-id'])){
        DisplayMassage("Login first.");
        OpenURL('login.php');
    }
    $testCaseFolder = $_POST['testCaseFolder'];
    $testCaseText = $_POST['testCaseText'];
    $edtcid = $_POST['edtcid'];
    $tcVersion = $_POST['tcVersion'];

    if($testCaseFolder > 0){
        $sql1 = "UPDATE testother SET fid = '$testCaseFolder' ,testcase = '$testCaseText',version = '$tcVersion' WHERE id = $edtcid";
    
        if (set_data($sql1)) {
            DisplayMassage('Other Test update Successfully.!');
        }
        else {
            DisplayMassage('Other Test update Failed.!');
        }
        OpenURL('foldersview.php?vw=1&flid='.$testCaseFolder);
    }
    else{
        DisplayMassage('Please select folder.!');
        OpenURL('testcases.php');
    } 
}

function GetTestCaseById($fid)
{
    $sql = "SELECT tc.*,u.email  FROM testcase tc  inner join users u on u.id = tc.cuid WHERE tc.fid = $fid";
    if ($row = get_data($sql)) {
        return $row;
    } else {
        return null;
    }
}
function GetOneTestDesignById($id)
{
    $sql = "SELECT * FROM testdesign WHERE id = $id";
    if ($row = get_data($sql)) {
        return $row;
    } else {
        return null;
    }
}
function GetOneAutomationById($id)
{
    $sql = "SELECT * FROM testautomation WHERE id = $id";
    if ($row = get_data($sql)) {
        return $row;
    } else {
        return null;
    }
}
function GetOneOtherById($id)
{
    $sql = "SELECT * FROM testother WHERE id = $id";
    if ($row = get_data($sql)) {
        return $row;
    } else {
        return null;
    }
}
function GetOneTestCaseById($id)
{
    $sql = "SELECT * FROM testcase WHERE id = $id";
    if ($row = get_data($sql)) {
        return $row;
    } else {
        return null;
    }
}
function GetTestDesignById($fid)
{
    $sql = "SELECT td.*, u.email FROM testdesign td inner join users u on u.id = td.cuid WHERE td.fid = $fid";
    if ($row = get_data($sql)) {
        return $row;
    } else {
        return null;
    }
}

function GetTestAutomationById($fid)
{
    $sql = "SELECT ta.*, u.email FROM testautomation ta inner join users u on u.id = ta.cuid WHERE ta.fid = $fid";
    if ($row = get_data($sql)) {
        return $row;
    } else {
        return null;
    }
}

function GetTestOtherById($fid)
{
    $sql = "SELECT ta.*, u.email FROM testother ta inner join users u on u.id = ta.cuid WHERE ta.fid = $fid";
    if ($row = get_data($sql)) {
        return $row;
    } else {
        return null;
    }
}

function RemoveTestCase($id)
{
    $sql = "DELETE FROM testcase WHERE id = $id";
    if (set_data($sql)) {
        DisplayMassage('Test case removed!.');
        OpenURL('folders.php');
    }
}

function GetAllTestCase($id)
{
    $wid = $_SESSION['WorkspaceId'];
    $sql = "SELECT * FROM testcase WHERE wid = $wid AND id NOT IN (SELECT tcaid FROM testcycletestcase WHERE tcyid = $id)";
    if ($row = get_data($sql)) {
        return $row;
    } else {
        return null;
    }
}

//test cycle
function AddTestCycle()
{
    if(!isset($_SESSION['user-id'])){
        DisplayMassage("Login first,Before posting quection");
        OpenURL('login.php');
    }
    $cycleName = $_POST['cycleName'];
    $cuid = $_SESSION['user-id'];
    $cuemail = $_SESSION['userName'];
    $wid = $_SESSION['WorkspaceId'];

    $sql1 = "INSERT INTO testcycle(name,wid,cuid,cuemail) VALUES
            ('$cycleName','$wid','$cuid','$cuemail')";

    if (set_data($sql1)) {
        DisplayMassage('Test Cycle Adding Successfully.!');
    }
    else {
        DisplayMassage('Test Cycle Adding Failed.!');
    }
    OpenURL('testcycle.php');
}

function GetestCycle()
{
    $cuid = $_SESSION['user-id'];
    $sql = "SELECT * FROM testcycle WHERE cuid = $cuid";
    if ($row = get_data($sql)) {
        return $row;
    } else {
        return null;
    }
}

function GetestCycleById($id)
{
    $sql = "SELECT * FROM testcycle WHERE id = $id";
    if ($row = get_data($sql)) {
        return $row;
    } else {
        return null;
    }
}

function RemovCycle($id)
{
    $sql = "DELETE FROM testcycle WHERE id = $id";
    if (set_data($sql)) {
        $sql1 = "DELETE FROM testcycletestcase WHERE tcyid = $id";
        if (set_data($sql1)){
            DisplayMassage('Test Cycle removed!.');
            OpenURL('testcycle.php');
        }
    }
}

function UpdateCycle()
{
    $id = $_POST['edcycleId'];
    $name = $_POST['edcycleName'];

    $sql = "UPDATE testcycle SET name='$name' WHERE id = $id";
    if (set_data($sql)) {
        DisplayMassage('Test Cycle Updated!.');
        OpenURL('testcycle.php');
    }
}

function GetAllTestCaseByCycle($id)
{
    $wid = $_SESSION['WorkspaceId'];
    $cuid = $_SESSION['user-id'];
    $sql = "SELECT * FROM testcycletestcase WHERE wid = $wid AND  tcyid = $id AND cuid = $cuid";
    if ($row = get_data($sql)) {
        return $row;
    } else {
        return null;
    }
}


function AddtestcycleTestCase($tcaid,$tcyid)
{
    $wid = $_SESSION['WorkspaceId'];
    $cuid = $_SESSION['user-id'];
    
    $tempSql = "SELECT * FROM testcase WHERE id = $tcaid";
    $tempRow = mysqli_fetch_assoc(get_data($tempSql));
    $testcase = $tempRow['testcase'];

    $sql = "INSERT INTO testcycletestcase (wid,tcaid,tcyid,cuid,testcase) VALUES ($wid,$tcaid,$tcyid,$cuid,'$testcase')";
    DisplayMassage($sql);
    if (set_data($sql)) {
        DisplayMassage('Test case added into cycle!.');
        OpenURL('testcycle.php');
    } 
}
function RemovetestcycleTestCase($id)
{
    $sql = "DELETE FROM testcycletestcase WHERE id = $id";
    DisplayMassage($sql);
    if (set_data($sql)) {
        DisplayMassage('Test case deleted from cycle!.');
        OpenURL('testcycle.php');
    } 
}

function UpdatetestcycleTestCase($id,$st,$tcyid)
{
    $sql = "UPDATE testcycletestcase SET status ='$st' WHERE id = $id";
    DisplayMassage($sql);
    if (set_data($sql)) {
        DisplayMassage('Test case updated!.');
        OpenURL('viewcycle.php?go=1&tcyid='.$tcyid);
        //OpenURL('testcycle.php');
    } 
}

//test design 
function AddTestDesign()
{
    if(!isset($_SESSION['user-id'])){
        DisplayMassage("Login first.");
        OpenURL('login.php');
    }
    $testCaseFolder = $_POST['testCaseFolder'];
    $testCaseText = $_POST['testCaseText'];
    $tcVersion = $_POST['tcVersion'];

    if($testCaseFolder > 0){
        $cuid = $_SESSION['user-id'];
        $cuemail = $_SESSION['userName'];
        $wid = $_SESSION['WorkspaceId'];
    
        $sql1 = "INSERT INTO testdesign(fid,wid,cuid,testcase,version) VALUES
                ('$testCaseFolder','$wid','$cuid','$testCaseText','$tcVersion')";
    
        if (set_data($sql1)) {
            DisplayMassage('Tets Design Adding Successfully.!');
        }
        else {
            DisplayMassage('Tets Design Adding Failed.!');
        }
        OpenURL('testdesign.php');
    }
    else{
        DisplayMassage('Please select folder.!');
        OpenURL('testdesign.php');
    }
    
}

function RemoveTestDesign($id)
{
    $sql = "DELETE FROM testdesign WHERE id = $id";
    if (set_data($sql)) {
        DisplayMassage('Removed!.');
        OpenURL('folders.php');
    }
}


//test automation 
function AddTestAuto()
{
    if(!isset($_SESSION['user-id'])){
        DisplayMassage("Login first.");
        OpenURL('login.php');
    }
    $testCaseFolder = $_POST['testCaseFolder'];
    $testCaseText = $_POST['testCaseText'];
    $tcVersion = $_POST['tcVersion'];

    if($testCaseFolder > 0){
        $cuid = $_SESSION['user-id'];
        $cuemail = $_SESSION['userName'];
        $wid = $_SESSION['WorkspaceId'];
    
        $sql1 = "INSERT INTO testautomation(fid,wid,cuid,testcase,version) VALUES
                ('$testCaseFolder','$wid','$cuid','$testCaseText','$tcVersion')";
    
        if (set_data($sql1)) {
            DisplayMassage('Successfully.!');
        }
        else {
            DisplayMassage('Failed.!');
        }
        OpenURL('automation.php');
    }
    else{
        DisplayMassage('Please select folder.!');
        OpenURL('automation.php');
    }
    
}

function RemoveTestAutomation($id)
{
    $sql = "DELETE FROM testautomation WHERE id = $id";
    if (set_data($sql)) {
        DisplayMassage('Removed!.');
        OpenURL('folders.php');
    }
}


//test other 
function AddTestOther()
{
    if(!isset($_SESSION['user-id'])){
        DisplayMassage("Login first.");
        OpenURL('login.php');
    }
    $testCaseFolder = $_POST['testCaseFolder'];
    $testCaseText = $_POST['testCaseText'];
    $tcVersion = $_POST['tcVersion'];

    if($testCaseFolder > 0){
        $cuid = $_SESSION['user-id'];
        $cuemail = $_SESSION['userName'];
        $wid = $_SESSION['WorkspaceId'];
    
        $sql1 = "INSERT INTO testother(fid,wid,cuid,testcase,version) VALUES
                ('$testCaseFolder','$wid','$cuid','$testCaseText','$tcVersion')";
    
        if (set_data($sql1)) {
            DisplayMassage('Successfully.!');
        }
        else {
            DisplayMassage('Failed.!');
        }
        OpenURL('other.php');
    }
    else{
        DisplayMassage('Please select folder.!');
        OpenURL('other.php');
    }
    
}

function RemoveTestOther($id)
{
    $sql = "DELETE FROM testother WHERE id = $id";
    if (set_data($sql)) {
        DisplayMassage('Removed!.');
        OpenURL('folders.php');
    }
}

function Search($search){
    $testFound = false;
    $tablesToCheck = ["testcase", "testcycletestcase", "testdesign", "testautomation", "testother"];
    
        $cuid = $_SESSION['user-id'];
        $cuemail = $_SESSION['userName'];
        $wid = $_SESSION['WorkspaceId'];
        $fid = 0;
    foreach ($tablesToCheck as $table) {
        $sql = "SELECT * FROM $table WHERE testcase LIKE '%$search%' AND cuid = $cuid AND wid = $wid";
        
        $row = get_data($sql);
        $rowCount = 0;
        
        while($rd = mysqli_fetch_assoc($row)){
            $rowCount++;
            $fid = $rd['fid'];
        }
        
        if ($rowCount > 0) {
            $testFound = true;
            break;
        }
        
    }


    if ($testFound) {
        $sql = "SELECT * FROM folder where id = $fid";
        $result = get_data($sql);
        return $result;
    } else {
        return null;
    }
}

function FSearch($search){
    $testFound = false;
   
        $cuid = $_SESSION['user-id'];
        $cuemail = $_SESSION['userName'];
        $wid = $_SESSION['WorkspaceId'];
        $fid = 0;
   
    $sql = "SELECT * FROM folder WHERE name LIKE '%$search%' AND cuid = $cuid AND wid = $wid";
    $row = get_data($sql);
    $rowCount = 0;
    while($rd = mysqli_fetch_assoc($row)){
        $rowCount++;
        $fid = $rd['id'];
    }

    if ($rowCount > 0) {
        $testFound = true;
    }

    if ($testFound) {
        $sql = "SELECT * FROM folder where id = $fid";
        $result = get_data($sql);
        return $result;
    } else {
        return null;
    }
}
