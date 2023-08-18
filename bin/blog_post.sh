#!/usr/bin/env bash

# custom env (please edit)
U_WEBS="www-data"
G_WEBS="www-data"
D_BLOG="/var/www/blog_scoottec_com"

# system env (don't touch)
D_POST="$D_BLOG/posts"
D_UPLD="$D_BLOG/uploads"

# check for a root privileges
if [ "$EUID" -ne 0 ]
  then
    echo "Please run as root"
    exit
fi

# public new posts
if [ -d "$D_UPLD" ]
then
  if [ "$(ls -A $D_UPLD)" ]; then
    chown $U_WEBS:$G_WEBS -R $D_UPLD
    rsync -a --recursive "$D_UPLD/"* "$D_POST/"
    rm -rf "$D_UPLD/"*
  else
    exit
  fi
else
  mkdir $D_UPLD
  chmod 0777 $D_UPLD
  chown $U_WEBS:$G_WEBS -R $D_UPLD
fi

