#!/bin/bash

#
# ____          __  __  _____ 
# |  _ \   /\   |  \/  |/ ____|     https://github.com/opeoniye
# | |_) | /  \  | \  / | (___       https://opeoniye.vercel.app/
# |  _ < / /\ \ | |\/| |\___ \      credit: http://patorjk.com/software/taag/
# | |_) / ____ \| |  | |____) |
# |____/_/    \_\_|  |_|_____/ 
#                             
#
# Based on https://gist.github.com/2206527


# create dhparam for ssl
openssl dhparam -out /etc/ssl/certs/dhparam.pem 4096

# make personalized dp work
cd personalizedflyer && composer install
cd ..