#!/bin/bash
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

# load .env
# source ./.env

# laravel things
laravel() {
  echo "\033[31mRunning laravel commands\033[0m"
  cd /var/www
  php artisan cache:clear
  php artisan optimize
  # php artisan migrate:fresh --seed
}

# nodejs things
nodejs() {
  echo "\033[31mInstalling dependencies\033[0m"
  # for development
  if [ "$NODE_ENV" == "development"]; then
    npm install
  # for production
  elif [ "$NODE_ENV" == "production" ]; then
    npm ci --only=production
  else
    echo "Nodejs NODE_ENV variable not defined"
    exit 0
  fi
}

# supervisor things
supervisor() {
  echo "\033[31mStarting all services with supervisord\033[0m"
  /usr/bin/supervisord -c /etc/supervisord.conf
}


# run
if [ "$DL_STACK" == "laravel" ]; then
  laravel
  supervisor
elif [ "$DL_STACK" == "nodejs" ]; then
  nodejs
elif [ "$DL_STACK" == "php" ]; then
  supervisor
else
  echo -e "App stack not found. Try and set in your envfile"
  exit 0
fi
