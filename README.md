# Blog
Simple Lightweight No Database Blog Engine with Markdown

# Requirements:
- Web-Server: Apache
- Apache Module: mod_rewrite
- PHP: 7.4+

# How to Install:
1. Download and unzip the ZIP archive from the repository releases into a separate directory of your web server.
2. Open the address in the browser that corresponds to the directory where you unpacked the files.
3. Enjoy!

# How to Update:
1. Remove the files: `.htaccess`, `index.php`, `page.php`, `post.php`, `search.php`
2. Delete the directory `/system/` (If you are using your own themes in the `/system/themes/` directory, you should save them beforehand)
3. Replace the deleted files and the `/system/` directory with new ones.
4. Replace `/config/default_config.php` with a new one.

# How to Create New Post and Markdown Tags, etc.
[Wiki](https://github.com/Sc00tFox/Blog/wiki)

# Used Libs or Technologies:

## PHP Markdown Lib Copyright (c) 2004-2022 
- Author: Michel Fortin https://michelf.ca All rights reserved.

Based on Markdown Copyright (c) 2003-2005 
- Author: John Gruber https://daringfireball.net All rights reserved.

## Mobile Detect Library
- Author: Serban Ghita, Nick Ilyin
- Original author: Victor Stanciu
- GitHub: https://github.com/serbanghita/Mobile-Detect

## UI-Components (code-highlighting) MIT License Copyright (c) 2018 
- Author: Alexander Maltsev https://itchief.ru/

## JQuery
- Site: https://jquery.com/
- Github: https://github.com/jquery/jquery