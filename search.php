<?php
    date_default_timezone_set(date_default_timezone_get());

    include_once($_SERVER["DOCUMENT_ROOT"] . "/system/modules/configuration.php");

    $searchQuery = NULL;
    $searchPage = 1;

    if (isset($_GET['q'])) {
        $searchQuery = urldecode($_GET['q']);
    }

    if (isset($_GET['n'])) {
        $searchPage = $_GET['n'];
    }
?>

<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="<?=getConfigByConstant("BLOG_DESCRIPTION");?> | <?=getConfigByConstant("SEARCH_PAGE_TITLE");?>">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/system/modules/page_parts/head.php");?>
        <script src="/system/assets/js/jquery-3.6.0-min.js"></script>
        <?php if ($searchQuery != NULL):?>
            <title><?=getConfigByConstant("BLOG_NAME");?> – <?=getConfigByConstant("SEARCH_PAGE_TITLE");?>: <?=$searchQuery;?></title>
        <?php else:?>
            <title><?=getConfigByConstant("BLOG_NAME");?> – <?=getConfigByConstant("SEARCH_PAGE_TITLE");?></title>
        <?php endif;?>
    </head>
    <body>
        <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/system/themes/" . getConfigByConstant("BLOG_THEME") . "/styles.php");?>
        <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/system/modules/page_parts/header.php");?>
        <div class="search-panel-background">
            <div id="search-field" class="area-field" contentEditable="true"><?=$searchQuery;?></div>
            <button class="search-button" onclick="search()"><?=getConfigByConstant("SEARCH_BUTTON_VALUE");?></button>
        </div>
        <div class="search-panel">
            <div id="search-item"></div>
        </div>
        <script type="text/javascript">
            const searchFieldElement = document.getElementById('search-field');
            
            searchFieldElement.addEventListener('keydown', function(event) {
                if (event.key === 'Enter') {
                    event.preventDefault();
                    search();
                }
            });

            function search() {
                let search_value = $('#search-field').text();

                if (search_value.length <= 0) {
                    alert('<?=getConfigByConstant("SEARCH_EMPTY_VALUE");?>');
                    return;
                }

                $.ajax({
                    type: "POST",
                    cache: false,
                    dataType: 'json',
                    url: "/system/modules/ajax/search.php",
                    data: {"search_value": search_value},
                    success: function(response) {
                        if (response.status == "ok") {
                            location.href = "search?q=" + response.query;
                        }
                    }
                });
            }
        </script>
        <?php if ($searchQuery != NULL):?>
            <script type="text/javascript">
                $(document).ready(function() {
                    let search_value = $('#search-field').text();

                    $.ajax({
                        type: "POST",
                        cache: false,
                        url: "/system/modules/ajax/search_engine.php",
                        data: {
                            "search_value": search_value,
                            "search_page": '<?=$searchPage;?>'
                        },
                    }).done(function(response) {
                        $('#search-item').html(response);
                    });
                });
            </script>
        <?php endif;?>
        <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/system/modules/page_parts/footer.php");?>
    </body>
</html>