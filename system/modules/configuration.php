<?php
    function getConfigByConstant($constantName) {
        include_once($_SERVER["DOCUMENT_ROOT"] . "/config/default_config.php");
        include_once($_SERVER["DOCUMENT_ROOT"] . "/config/config.php");

        if (defined($constantName)) {
            return constant($constantName);
        } else {
            $defaultConstantName = "DEFAULT_" . $constantName;
            return constant($defaultConstantName);
        }
    }
?>