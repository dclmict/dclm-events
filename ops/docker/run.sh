#!/bin/sh
#
# ____          __  __  _____ 
# |  _ \   /\   |  \/  |/ ____|     repo:     https://github.com/opeoniye
# | |_) | /  \  | \  / | (___       porfolio: https://opeoniye.vercel.app/
# |  _ < / /\ \ | |\/| |\___ \      credit:   http://patorjk.com/software/taag/
# | |_) / ____ \| |  | |____) |
# |____/_/    \_\_|  |_|_____/ 
#                             
#
# Based on https://gist.github.com/2206527

# laravel something
echo -e "\033[31mRunning laravel commands\033[0m image"
cd /var/www
php artisan cache:clear
php artisan optimize
# php artisan migrate:fresh --seed

# start supervisord
echo -e "\033[31mStarting all services with supervisord\033[0m image"
/usr/bin/supervisord -c /etc/supervisord.conf