#!/bin/bash

# Set the target directory 
docker_dir="/var/docker/dev"
app_dir="$IN"

# Navigate into the docker directory
cd "$docker_dir"

# Check if target folder exists
if [ ! -d "$app_dir" ]; then
  # Folder doesn't exist, create it
  echo "Creating folder $app_dir"  
  mkdir -p "$app_dir"

else
  # Folder exists, print message
  echo "Folder $app_dir already exists"

fi