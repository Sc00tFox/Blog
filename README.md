# Blog
Simple Lightweight No Database Blog Engine with Markdown

# Requirements:
- Web-Server: Apache
- Apache Module: mod_rewrite
- PHP: 7.4+

# How to Install:
1. Download and unzip the ZIP archive from the repository releases into a separate directory of your web server.
2. Open the address in the browser that corresponds to the directory where you unpacked the files.
3. Create a symbolic link in your home directory to the `/uploads` directory in your web server directory where blog files are located.
4. Set permissions to `0777` for the /uploads directory.
5. In the `/bin/blog_post.sh` file, specify the username and group under which your web server runs in the `U_WEBS` and `G_WEBS` variables, respectively. Also, provide the absolute path to the root directory of your blog on your web server in the `D_BLOG` variable, for example: `D_BLOG="/var/www/my_blog"`.
6. Set execute permissions for the script using `chmod +x /var/www/my_blog/bin/blog_post.sh`.
7. Add the script to the cron table to run it as root or another user with write permissions to the web server directory.  
Example crontab entry: `*/5 *   * * *   root    /var/www/my_blog/bin/blog_post.sh >/dev/null 2>&1`
8. Enjoy!

# How to Use Dual Configuration:
When you first download the distribution, there are two configuration files in the `/config` directory.  
`/config/default_config.php` - contains default parameters and is overwritten after each update  
`/config/config.php` - contains parameters that exist at the time of release of the current version, these parameters are edited by the user and the file is not overwritten during each update.  
To save you from having to compare your current configuration and its new version every time, adding any missing parameters, a default configuration was created. If a parameter is missing in your configuration file, it will be automatically taken from the default configuration.
If you want to personalize any new parameters that are not in your configuration file but were added to the default configuration file, you should copy the line with the parameter from the `/config/default_config.php` file to your `/config/config.php` file and remove the DEFAULT_ prefix from the parameter name, for example:
`define("DEFAULT_NEW_PARAMETER", "New parameter");` -> `define("NEW_PARAMETER", "New parameter");`

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