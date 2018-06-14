<?php
if(!session_id()){
session_start();
}
ob_start();

ini_set("date.timezone", "Asia/Kolkata");
include DIR_APPLICATION.'include/db.php'; 
$reg_user = new USER1();
require_once(DIR_APPLICATION.'include/class.user.php');
$class_user = new USER();
//$id = $_GET['id'];

$url = strtok(rtrim($_SERVER['REQUEST_URI'], "/"), "?");
$ur = explode("/", $url);
$last_url = array_pop($ur);

if(isset($_SESSION['userSession'])) {

if($last_url === "") {
include DIR_APPLICATION.'include/index.php';
}else if($last_url === "index") {
include DIR_APPLICATION.'include/index.php';
}elseif ($last_url === "login") {
include DIR_APPLICATION.'include/login.php';
}elseif ($last_url === "register_db") {
include DIR_APPLICATION.'include/register_db.php'; 
}elseif ($last_url === "header") {
include DIR_APPLICATION.'include/header.php';
}elseif ($last_url === "style") {
include DIR_APPLICATION.'include/style.php';
}elseif ($last_url === "class.user") {
include DIR_APPLICATION.'include/class.user.php';
}elseif ($last_url === "dbconfig") {
include DIR_APPLICATION.'include/dbconfig.php';
}elseif ($last_url === "db") {
include DIR_APPLICATION.'include/db.php'; 
}elseif ($last_url === "login_db") {
include DIR_APPLICATION.'include/login_db.php';
}elseif ($last_url === "logout") {
include DIR_APPLICATION.'include/logout.php';
}elseif ($last_url === "userverify") {
include DIR_APPLICATION.'include/userverify.php';
}


//LEADS
elseif ($last_url === "list_of_agents") {
include DIR_APPLICATION.'ListOfAgents/list_of_agents.php';
}elseif ($last_url === "ticket_status_update") {
include DIR_APPLICATION.'ListOfAgents/ticket_status_update.php';
}
elseif ($last_url === "add_leads") {
include DIR_APPLICATION.'Leads/add_leads.php';
}elseif ($last_url === "view_leads") {
include DIR_APPLICATION.'Leads/view_leads.php';
}elseif ($last_url === "edit_lead") {
include DIR_APPLICATION.'Leads/edit_lead.php';
}elseif ($last_url === "allocate_lead") {
include DIR_APPLICATION.'Leads/allocate_lead.php';
}elseif ($last_url === "lead_status_update") {
include DIR_APPLICATION.'Leads/lead_status_update.php';
}

elseif ($last_url === "emails_mod") {
include DIR_APPLICATION.'emails/emails.php';
}elseif ($last_url === "to_do_lists") {
include DIR_APPLICATION.'ToDoList/to_do_list.php';
}elseif ($last_url === "import_data") {
include DIR_APPLICATION.'ImportData/import_data.php';
}elseif ($last_url === "new_announcements") {
include DIR_APPLICATION.'NewAnnouncements/new_announcements.php';
}elseif ($last_url === "list_of_announcements") {
include DIR_APPLICATION.'ListOfAnnouncements/list_of_announcements.php';
}elseif ($last_url === "birthdays_and_anniversary") {
include DIR_APPLICATION.'BirthdaysAndAnniversary/birthdays_and_anniversary.php';
}
elseif ($last_url === "Profile_Info") {
include DIR_APPLICATION.'profile_info/profile_info.php';
}
elseif ($last_url === "Setting") {
include DIR_APPLICATION.'setting/Setting.php';
}
elseif ($last_url === "UsersList") {
include DIR_APPLICATION.'UserList/User.php';
}

//PUSH NOTIFICATION
elseif ($last_url === "view-mobile-notification") {
include DIR_APPLICATION.'notification/view-mobile-notification.php';
}elseif ($last_url === "add-mobile-notification") {
include DIR_APPLICATION.'notification/add-mobile-notification.php';	
}elseif ($last_url === "local_data_update") {
include DIR_APPLICATION.'local_data_update_to_server/index.php';	
}

else{
include DIR_APPLICATION.'include/index.php';
}

}elseif ($last_url === "login_db") {
include DIR_APPLICATION.'include/login_db.php';
}elseif ($last_url === "logout") {
include DIR_APPLICATION.'include/logout.php';
}elseif ($last_url === "login") {
include DIR_APPLICATION.'include/login.php';
}elseif ($last_url === "register") {
include DIR_APPLICATION.'include/register.php';
}elseif ($last_url === "userverify") {
include DIR_APPLICATION.'include/userverify.php';
}elseif ($last_url === "local_data_update") {
include DIR_APPLICATION.'local_data_update_to_server/index.php';	
}else{
include DIR_APPLICATION.'include/login.php';
}
?>