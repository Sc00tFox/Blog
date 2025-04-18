<?php
    // Blog title
    define("DEFAULT_BLOG_NAME", "My Blog");

    // Blog subtitle
    define("DEFAULT_BLOG_SUBTITLE", "Simple Blog");

    // Blog description (for Google Search, etc)
    define("DEFAULT_BLOG_DESCRIPTION", "Simple Blog");

    // Blog Author
    define("DEFAULT_BLOG_AUTHOR_NAME", "Author");

    // Blog start year
    define("DEFAULT_BLOG_CREATE_YEAR", "2023");

    // Use SSL? true or false
    define("DEFAULT_BLOG_USE_HTTPS", true);

    // Logo path
    define("DEFAULT_BLOG_LOGO_PATH", "/config/logo.png");

    // Use custom favicon?
    define("DEFAULT_BLOG_USE_CUSTOM_FAVICON", false);

    // Custom favicon path (Example: /system/assets/favicon.png)
    define("DEFAULT_BLOG_CUSTUM_FAVICON_PATH", "");

    // Enable background fill on logo image
    define("DEFAULT_BLOG_LOGO_BACKGROUND", true);

    // Logo background fill color
    define("DEFAULT_BLOG_LOGO_BACKGROUND_COLOR", "#ffffff");

    // Theme catalog name
    define("DEFAULT_BLOG_THEME", "default");

    // Blog title font size
    define("DEFAULT_BLOG_TITLE_FONT_SIZE", "48px");

    // Blog subtitle font size
    define("DEFAULT_BLOG_SUBTITLE_FONT_SIZE", "24px");

    // Image width in the post
    define("DEFAULT_BLOG_POST_IMAGE_WIDTH", "100%");

    // Image height in the post
    define("DEFAULT_BLOG_POST_IMAGE_HEIGHT", "100%");

    // Post blog width
    define("DEFAULT_POST_BODY_WIDTH", "70%");

    // Post title font size
    define("DEFAULT_POST_TITLE_FONT_SIZE", "48px");

    // Post text font size
    define("DEFAULT_POST_TEXT_FONT_SIZE", "28px");

    // Post date font size
    define("DEFAULT_POST_DATE_FONT_SIZE", "16px");

    // Stretch tables to the width of the post?
    define("DEFAULT_POST_WIDTH_TABLE_STRETCH", true);

    // The indentation size of the red line of the paragraph (If 0, then there is no red line)
    define("DEFAULT_PARAGRAPH_REDLINE", "0");

    // The maximum number of posts displayed on one page in the feed
    define("DEFAULT_MAX_POSTS_PER_PAGE", 10);

    // The maximum number of post lines displayed in the feed
    define("DEFAULT_PREVIEW_ROWS_LIMIT", 3);

    // The maximum allowed number of characters in the preview post string only 
    // works if the value of DEFAULT_PREVIEW_ROWS_LIMIT (PREVIEW_ROWS_LIMIT) is greater than 0.
    define("DEFAULT_PREVIEW_OVERFLOW_LIMIT", 400);

    // Message about the absence of posts
    define("DEFAULT_POST_NONE", "None");

    // The text of the link to continue viewing the post in the feed
    define("DEFAULT_POST_PREVIEW_READMORE_TITLE", ">>>read more.");

    // Search page title
    define("DEFAULT_SEARCH_PAGE_TITLE", "Search");

    // Search button text
    define("DEFAULT_SEARCH_BUTTON_VALUE", "Search");

    // Error message: Empty search field
    define("DEFAULT_SEARCH_EMPTY_VALUE", "Input field is empty!");

    // A message when the search did not yield results
    define("DEFAULT_SEARCH_NOTHING", "Nothing found");

    // Text on error page 403
    define("DEFAULT_FORBIDDEN", "Forbidden!");

    // Text on error page 404
    define("DEFAULT_POST_NOT_FOUND", "Page not found!");
    
    // Font size of the text on the error page
    define("DEFAULT_ERROR_PAGE_FONT_SIZE", "30px");

    // The text of the link to the previous page of the feed
    define("DEFAULT_PREVIOUS_PAGE", "Previous page");

    // The text of the link to go to the next page of the feed
    define("DEFAULT_NEXT_PAGE", "Next page");

    // The pinned text center align?
    define("DEFAULT_ALIGN_CENTER_PINNED_TEXT", true);

    // Page title
    define("DEFAULT_PAGE_TITLE", "Page");

    // Use video preview?
    define("DEFAULT_USE_VIDEO_PREVIEW", true);

    // Video preview image path
    define("DEFAULT_VIDEO_PREVIEW_PATH", "/system/themes/default/images/video_preview.png");

    // Video preview text (if 'Use video preview' is false)
    define("DEFAULT_VIDEO_PREVIEW_TEXT", "* Attachment: video");

    // Used only for local video files!
    // Use target video preview image? If enabled, jpg/jpeg/png files with the same name as the video file will be used as video preview in feed. 
    // If preview image file not found will be used previous preview settings.
    define("DEFAULT_USE_TARGET_VIDEO_PREVIEW", false);

    // Use audio preview?
    define("DEFAULT_USE_AUDIO_PREVIEW", true);

    // Audio preview image path
    define("DEFAULT_AUDIO_PREVIEW_PATH", "/system/themes/default/images/audio_preview.png");

    // Audio preview text (if 'Use audio preview' is false)
    define("DEFAULT_AUDIO_PREVIEW_TEXT", "* Attachment: audio");
?>
