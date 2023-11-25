#!/bin/bash

# Load credentials 
source ./src/.env

# Prompt for values
read -p "Enter GitHub username: " GH_USER

repo_name() {
  read -p "Enter current repository name: " GH_REPO
  read -p "Enter new repository name: " NEW_NAME
  # API to rename repo
  API_ENDPOINT="https://api.github.com/repos/${GH_USER}/${GH_REPO}"

  # Make API call to rename repo
  curl \
    -X PATCH \
    -H "Authorization: token ${DL_GH_TOKEN}" \
    -d '{"name":"'"${NEW_NAME}"'"}' \
    ${API_ENDPOINT}

  if [ $? -eq 0 ]; then
    echo -e "Repository renamed successfully!\n"
  else
    echo -e "Error renaming repository\n" >&2
    exit 1
  fi

  # run function to change repo remote url
  repo_url

}


repo_url() {
	read -p "About to change repo's remote url. Proceed? (yes|no): " user_grant
	case "$user_grant" in
		yes|Y|y)
      read -p "Enter new repository name: " NEW_NAME
      git remote set-url origin git@github.com:${GH_USER}/${NEW_NAME}.git
      git remote -v
      if [ $? -eq 0 ]; then
        echo "Remote url successfully set!"
      else
        echo "Error renaming repository" >&2
        exit 1
      fi
			;; 
		no|N|n) 
			echo -e "\033[32mNothing to be done. Thank you...\033[0m\n"
			exit 0
			;;
		*)
			echo -e "\033[32mNo choice. Exiting script...\033[0m\n"
			exit 1
			;;
	esac
}


# Select action
echo "Select action:"
echo "1) Change repo name on Github"
echo "2) Rename repo's remote url"
read action_selection
if [ $action_selection -eq 1 ]; then
  repo_name
elif [ $action_selection -eq 2 ]; then
  repo_url
else
  echo "Invalid selection"
  exit 1  
fi
