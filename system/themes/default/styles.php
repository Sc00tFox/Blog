<style type="text/css">
    @font-face {
        font-family: 'Hermes';
        <?php if (BLOG_USE_HTTPS == true):?>
            src: url('https://<?=$_SERVER['SERVER_NAME'];?>/system/themes/default/fonts/hermes.ttf');
        <?php else:?>
            src: url('http://<?=$_SERVER['SERVER_NAME'];?>/system/themes/default/fonts/hermes.ttf');
        <?php endif;?>
    }

    @font-face {
        font-family: 'OpenSans';
        <?php if (BLOG_USE_HTTPS == true):?>
            src: url('https://<?=$_SERVER['SERVER_NAME'];?>/system/themes/default/fonts/open-sans.ttf');
        <?php else:?>
            src: url('http://<?=$_SERVER['SERVER_NAME'];?>/system/themes/default/fonts/open-sans.ttf');
        <?php endif;?>
    }

    @font-face {
        font-family: 'Futuris';
        <?php if (BLOG_USE_HTTPS == true):?>
            src: url('https://<?=$_SERVER['SERVER_NAME'];?>/system/themes/default/fonts/futuris-cyrillic.ttf');
        <?php else:?>
            src: url('http://<?=$_SERVER['SERVER_NAME'];?>/system/themes/default/fonts/futuris-cyrillic.ttf');
        <?php endif;?>
    }

    html {
        background: rgb( 36, 36, 36 );
        height: 100%;
        color: white;
    }

    body {
        margin: 0;
        padding: 0;
        height: 100%;
    }

    br {
        margin: 0;
    }

    ul {
        margin: 0;
    }

    li p {
        text-indent: 0px;
    }

    li {
        line-height: 1.2em;
    }

    p {
        text-indent: <?php echo PARAGRAPH_REDLINE;?>;
        margin-top: 1.2em;
        margin-bottom: 1.2em;
    }

    blockquote {
        padding: 0 2px;
        margin-left: 0;

        width: 99%;
        font-style: italic;
        overflow-wrap: break-word;
        background-color: rgb(55, 52, 52);
        border-left: 4px solid #ff8d13;
    }

    blockquote::before {
        content: "\""; 
        font-family: "Hermes";
        font-size: 48px; 
        font-style: normal; 
        float: left;

        margin-top: 5px;
        margin-left: 5px;
        margin-right: 1%;

        line-height: 1.0; 
    }

    blockquote p {
        text-indent: 5px;
        margin-left: 1em;
        margin-top: 0.1em;
        margin-bottom: 0.1em;
    }

    pre {
        line-height: 60%;
        font-size: 18px;
        background-color: rgb(55, 52, 52);
        border: 1px solid rgb(35, 32, 32);
    }

    pre.code-block:before {
        display: flex;
        content: "code:";
        font-family: "Hermes";
        font-size: 16px; 
        font-style: normal;
        margin-top: 5px;
        margin-left: 5px;
    }

    pre code.hljs {
        display: block;
        overflow-x: auto;
        padding-top: 1em;
        padding-left: 1em;
    }

    code.hljs {
        padding: 3px 5px;
    }

    .hljs{
        color: #c9d1d9;
    }

    .hljs-doctag,.hljs-keyword,.hljs-meta .hljs-keyword,.hljs-template-tag,.hljs-template-variable,.hljs-type,.hljs-variable.language_ {
        color: #ff7b72;
    }

    .hljs-title,.hljs-title.class_,.hljs-title.class_.inherited__,.hljs-title.function_ {
        color: #d2a8ff;
    }
    
    .hljs-attr,.hljs-attribute,.hljs-literal,.hljs-meta,.hljs-number,.hljs-operator,.hljs-selector-attr,.hljs-selector-class,.hljs-selector-id,.hljs-variable {
        color: #79c0ff;
    }
    
    .hljs-meta .hljs-string,.hljs-regexp,.hljs-string {
        color: #a5d6ff;
    }
    
    .hljs-built_in,.hljs-symbol {
        color: #ffa657;
    }
    
    .hljs-code,.hljs-comment,.hljs-formula {
        color: #8b949e;
    }
    
    .hljs-name,.hljs-quote,.hljs-selector-pseudo,.hljs-selector-tag {
        color: #7ee787;
    }
    
    .hljs-subst {
        color: #c9d1d9;
    }
    
    .hljs-section {
        color: #1f6feb;
        font-weight: 700;
    }
    
    .hljs-bullet {
        color: #f2cc60;
    }
    
    .hljs-emphasis {
        color: #c9d1d9;
        font-style: italic;
    }
    
    .hljs-strong {
        color: #c9d1d9;
        font-weight:700;
    }
    
    .hljs-addition {
        color: #aff5b4;
        background-color: #033a16
    }
    
    .hljs-deletion {
        color: #ffdcd7;
        background-color: #67060c;
    }

    table {
        margin-top: 1.2em;
        margin-bottom: 1.2em;
        border-collapse: collapse;

        <?php if (POST_WIDTH_TABLE_STRETCH == true):?>
            width: 100%;
        <?php endif;?>
    }

    table thead tr th {
        border: 1px solid #747474;
        padding-left: 10px;
        padding-right: 10px;
    }

    table tbody tr td {
        border: 1px solid #747474;
        padding-left: 10px;
        padding-right: 10px;
    }

    iframe {
        min-width: 100%;
    }

    audio {
        width: 100%;
    }

    .post-image {
        width: 100%;
        align-content: center;
    }

    .header {
        display: flex;
        flex-flow: row;
        justify-content: space-between;

        margin-top: 5%;
        margin-left: 5%;
    }

    .logo-title-block {
        display: flex;
        flex-flow: column;
    }

    .logo-title {
        display: flex;
        flex-flow: row;
    }

    .footer {
        display: flex;
        flex-flow: row;

        margin-left: 5%;
        margin-top: 5%;
        margin-bottom: 10px;
    }

    .blog-logo {
        width: 64px;
        height: 64px;

        background-color: #FFFFFF;

        border-radius: 100%;
        text-shadow: 0px 0px 35px #FFFFFF;
    }

    .posts-background {
        margin-top: 5%;
        margin-left: 10%;

        height: auto;
        overflow-x: hidden;
    }

    .page-navigation-button {
        margin-left: 10%;
        margin-top: 5%;
        font-family: "Hermes";
        font-size: 18px;

        color: #ff8d13;
    }

    .page-navigation-button:hover {
        color: #ffea2b;
    }

    a {
        text-decoration: none;
        color: #ff8d13;
        cursor: pointer;
    }

    a:visited {
        text-decoration: none;
        color: #ff8d13;
    }

    a:active {
        text-decoration: none;
        color: #ff8d13;
    }

    a:hover {
        text-decoration: none;
        color: #ffea2b;
    }

    a.blog-title-link {
        text-decoration: none;
        color: #FFFFFF;
        cursor: pointer;
    }

    a.blog-title-link:hover {
        text-decoration: none;
        color: #ffea2b;
    }

    a.post-title-link {
        text-decoration: none;
        color: #FFFFFF;
        cursor: pointer;
    }

    a.post-title-link:hover {
        text-decoration: none;
        color: #ffea2b;
    }

    a.search-button {
        display: flex;
        flex-flow: column;
        align-self: center;

        font-family: "Hermes";

        text-decoration: none;
        color: #FFFFFF;
        cursor: pointer;

        margin-right: 5%;
    }

    a.search-button:hover {
        text-decoration: none;
        color: #ffea2b;
    }
    
    .blog-title {
        margin: 5px;
        margin-left: 10px;

        cursor: pointer;

        font-family: "Hermes";
        font-size: <?php echo BLOG_TITLE_FONT_SIZE;?>;

        color: #FFFFFF;
    }

    .blog-title:hover {
        color: #ffea2b;
        border-bottom: 1px solid #ffea2b;
    }

    .sub-title {
        margin: 5px;
        margin-left: 10px;

        text-align: left;

        font-family: "Hermes";
        font-size: <?php echo BLOG_SUBTITLE_FONT_SIZE;?>;

        color: rgb(138, 138, 138);
    }

    .footer-item {
        color: #FFFFFF;
        font-family: "Hermes";
        font-size: 18px;

        margin-left: 15px;
    }

    .post-body {
        width: <?php echo POST_BODY_WIDTH;?>;
        margin-bottom: 5%;
    }

    .post-title {
        color: #FFFFFF;
        border-bottom: 1px solid #ffffff62;

        font-family: "Hermes";
        font-size: <?php echo POST_TITLE_FONT_SIZE;?>;

        cursor: pointer;
    }

    .post-title:hover {
        color: #ffea2b;
        border-bottom: 1px solid #ffea2b;
    }

    .post-title-static {
        color: #FFFFFF;

        font-family: "Hermes";
        font-size: <?php echo POST_TITLE_FONT_SIZE;?>;
    }

    .post-text {
        color: #848484;

        margin-top: 1.2em;
        margin-bottom: 25px;
        margin-right: 5%;

        font-family: "OpenSans";
        font-size: <?php echo POST_TEXT_FONT_SIZE;?>;
    }

    .post-date {
        color: #848484;

        font-family: "Futuris";
        font-size: <?php echo POST_DATE_FONT_SIZE;?>;
    }

    .page-error {
        color: #FFFFFF;

        font-family: "Futuris";
        font-size: <?php echo ERROR_PAGE_FONT_SIZE;?>;
    }

    .search-panel-background {
        display: flex;
        flex-flow: row;
        justify-content: center;

        margin-top: 5%;
    }

    .area-field {
        font-family: "OpenSans";
        font-style: normal;
        font-weight: normal;

        width: 80%;
        min-height: 1em;

        background-color: #53535382;

        border-bottom: 1px ridge #282828ed;
        padding: 5px;
        overflow: auto;
    }

    button.search-button {
        font-family: "OpenSans";
        font-style: normal;
        font-weight: normal;

        align-self: center;

        height: 30px;

        margin-left: 1em;
        
        border-style: none;

        color: #FFFFFF;
        background-color: #555555d1;

        border-radius: 5px;

        cursor: pointer;
    }

    button.search-button:hover {
        color: #000000;
        background-color: #ff8d13;
    }

    .search-panel {
        display: flex;
        flex-flow: column;

        margin-top: 10px;
    }

    .search-none {
        display: flex;
        justify-content: center;

        font-family: "Futuris";
        font-size: <?php echo ERROR_PAGE_FONT_SIZE;?>;

        margin-top: 25px;
    }
</style>