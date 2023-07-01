<?php
    include_once($_SERVER['DOCUMENT_ROOT'] . "/system/modules/location.php");

    if (isset($_POST['search_value'])) {
        echo json_encode(array('status' => 'ok', 'query' => urlencode($_POST['search_value'])));
        return;
    }
    else {
        echo json_encode(array('status' => 'null', 'query' => ""));
        return;
    }
?>