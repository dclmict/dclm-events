#!/bin/bash

src_dir="./ops"
dest_dir="./src"
PS3='Select environment file to copy or leave blank to copy default: '
options=("dclm-dev" "dclm-prod" "Custom env")
select opt in "${options[@]}"
do
  case $opt in
    "dclm-dev")
      cp $src_dir/dclm-dev.env $dest_dir/.env
      echo "Copied dclm-dev.env to $dest_dir/.env"
      break
      ;;
    "dclm-prod")
      cp $src_dir/dclm-prod.env $dest_dir/.env
      echo "Copied dclm-prod.env to $dest_dir/.env"
      break
      ;;
    "Custom env")
      read -p "Enter custom env file name: " envfile
      cp $src_dir/$envfile $dest_dir/.env
      echo "Copied $envfile to $dest_dir/.env"
      break
      ;;
    *)
      cp $src_dir/bams-dev.env $dest_dir/.env
      echo "Copied bams-dev.env to $dest_dir/.env"
      break
      ;;
  esac
done
