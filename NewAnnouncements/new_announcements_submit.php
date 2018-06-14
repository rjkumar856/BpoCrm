<?php
    include '../include/db.php';
    $reg_user = new USER1();
    $summary = $_POST['summary'];
    $announcements = $_POST['announcements'];
    $date = $_POST['date'];
        $stmt_announcements = $reg_user->runQuery(" INSERT INTO announcements (summary, announcements, publishDate,status) VALUES ('$summary', '$announcements', '$date','Active')");
        $stmt_announcements->execute();
?>
