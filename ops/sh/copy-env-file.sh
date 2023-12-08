#!/bin/bash

# Define the source and destination directories
src_dir="./ops"
dest_dir="./src"

# Define environment file
dest_env=".env"
default_env_file="bams-dev.env"


# Display the options
echo "Please select an environment:"
echo "1) dclm-dev"
echo "2) dclm-prod"
echo "3) Custom env"

# Read the user's selection
read -p "Select an option or press enter to copy default: " selection

# Handle the user's selection
case $selection in
  1)
    env_file="dclm-dev.env"
    ;;
  2)
    env_file="dclm-prod.env"
    ;;
  3)
    read -p "Enter the name of the custom environment file: " env_file
    ;;
  "")
    env_file=$default_env_file
    ;;
  *)
    echo -e "Invalid option. Please select 1, 2, or 3\n"
    ;;
esac

# Copy the environment file
cp "${src_dir}/${env_file}" "${dest_dir}/${dest_env}"

# Check if the copy was successful
if [ $? -eq 0 ]; then
  echo -e "Environment file copied successfully.\n"
else
  echo -e "Failed to copy environment file. Exiting.\n"
  exit 1
fi