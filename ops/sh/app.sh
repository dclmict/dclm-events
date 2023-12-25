#!/bin/bash

# add envfile to shell
source ./src/.env

RED='\033[31m'
GREEN='\033[32m'
YELLOW='\033[1;33m'
RESET='\033[0m'

nginx_config() {
  export APP_ID NGX_DOCROOT NGX_SERVER_NAME NGX_INDEX
  # Generate config 
  envsubst '${APP_ID},${NGX_DOCROOT},${NGX_SERVER_NAME},${NGX_INDEX}' < ./ops/nginx/app.template > ./ops/nginx/app.conf
}

# function to check which git branch
git_branch() {
  # Get the current Git branch
  branch=$(git rev-parse --abbrev-ref HEAD)

  # Check if branch is release/dev or release/prod
  if [[ $branch != "release/dev" ]] && [[ $branch != "release/prod" ]]; then
    # Prompt the user to select a branch  
    echo -e "Current branch is ${RED}$branch.${RESET} You can only deploy on ${GREEN}release/dev${RESET} or ${GREEN}release/prod${RESET}"
    echo -e "Please select branch:"
    echo -e "1) ${YELLOW}release/dev${RESET}" 
    echo -e "2) ${YELLOW}release/prod${RESET}"
    read -p "Enter choice: " choice

    # Switch based on choice
    case $choice in
      1) 
        echo "Switching to dev release branch"
        git switch release/dev
        ;;
      2)
        echo "Switching to prod release branch" 
        git switch release/prod
        ;;
      *)
        echo "Invalid choice" >&2
        exit 1
        ;;
    esac
  else 
    echo -e "Git Repo: You're on ${GREEN}$branch${RESET} branch"
  fi
}

# function to check if there are uncommitted changes in repo
commit_status() {
  # Check if the current directory is a Git repository
  if [ -d .git ] || git rev-parse --git-dir > /dev/null 2>&1; then
    :
  else
    echo "This is not a Git repository."
    exit 1
  fi

  # Check if the working tree is clean
  if [ -z "$(git status --porcelain)" ]; then
    echo -e "Git Commit: ${GREEN}Working tree is clean.${RESET}"
  else
    echo -e "\n${RED}There are uncommitted files.${RESET} Type ${GREEN}y|Y|yes${RESET} to fix."
    ./ops/sh/app.sh 3
  fi
}

#---------------------------------------#
# init                                  #
#---------------------------------------#
# function to create a git repo locally
git_repo_create() {
	read -p $'\nDo you want to create a git repo? (yes|no): ' repo_init
	case "$repo_init" in
		yes|Y|y)
			if [ -d .git ]; then
				echo -e "${RED}Current directory already initialised ${RESET}\n"
			else
				echo -e "${GREEN}Please enter initial commit message: ${RESET}\n"
				read -r commitMsg
				git init && git add . && git commit -m "$commitMsg"
			fi
			;;
		no|N|n)
			echo -e "${GREEN}Nothing to be done. Thank you...${RESET}"
			;;
		*) \
			echo -e "${GREEN}No choice. Exiting script...${RESET}"
			;;
	esac
}

# function to create a repository on GitHub
gh_repo_create() {
	read -p $'\nDo you want to create a github repo? (yes|no): ' repo_name
	case "$repo_name" in
		yes|Y|y)
			read -p "Enter GitHub username: " ghUser
			read -p "Enter GitHub repo name: " ghName
      gh="$ghUser/$ghName"
			result="$(gh_repo_check $gh)"
			if [ $result -eq 200 ]; then
				echo -e "${RED}GitHub repo exists. I stop here. ${RESET}\n"
			else
				echo -e "\nWhich type of repository are you creating?:"
				echo "1. Private repo"
				echo "2. Public repo"
				read -p "Enter a number to select your choice: " repoType
				if [ $repoType -eq 1 ]; then
					REPO=private
				elif [ $repoType -eq 2 ]; then
					REPO=public
				else
					echo "Invalid choice"
					exit 0
				fi
				gh repo create ${ghUser}/${ghName} --$REPO --source=. --remote=origin
			fi
			;;
		no|N|n)
			echo -e "${GREEN}Okay, thank you...${RESET}"
			;;
		*)
			echo -e "${GREEN} No choice. Exiting script...${RESET}"
			;;
	esac
}

#---------------------------------------#
# app                                   #
#---------------------------------------#
# function to commit git repository
git_commit() {
  # function to commit repo with untracked files
  git_commit_new() {
    read -p $'\nDo you want to commit repo files? (yes|no): ' git_commit
    case "$git_commit" in
      yes|Y|y)
        echo -e "\n${RED}Untracked files found and listed below: ${RESET}"
        git status -s
        echo -e "\n${GREEN}Please enter commit message:${RESET}"
        read -r msg1
        git add -A
        git commit -m "$msg1"
        ;;
      no|N|n)
        echo -e "${GREEN}Nothing to be done. Thank you...${RESET}"
        ;;
      *)
        echo -e "${GREEN}No choice. Exiting script...${RESET}"
        ;;
    esac
  }

  # function to commit repo with modified files
  git_commit_old() {
    read -p $'\nDo you want to commit repo files? (yes|no): ' git_commit
    case "$git_commit" in
      yes|Y|y)
        echo -e "\n${RED}Modified files found and listed below: ${RESET}"
        git status -s
        echo -e "\n${GREEN}Please enter commit message:${RESET}"
        read -r msg2
        git commit -am "$msg2"
        ;;
      no|N|n)
        echo -e "${GREEN}Nothing to be done. Thank you...${RESET}"
        ;;
      *)
        echo -e "${GREEN}No choice. Exiting script...${RESET}"
        ;;
    esac
  }

  if git status --porcelain | grep -q "^??"; then
    git_commit_new
  elif git status --porcelain | grep -qE '[^ADMR]'; then
    git_commit_old
  elif [ -z "$(git status --porcelain)" ]; then
    echo -e "${RED} Nothing to commit, thanks...${RESET}\n"
  else
    echo -e "${RED} Unknown status. Aborting...${RESET}\n"
    exit 1
  fi
}

docker_build() {
  # function to purge docker images
  dkr_purge_image() {
    read -p $'\nDo you want to purge image? (yes|no): ' dkr_purge
    case "$dkr_purge" in
      yes|Y|y)
        if [ "$(docker images -qf "dangling=true")" ]; then
          echo -e "${RED}Removing dangling images...${RESET}"
          docker image prune -f
        fi
        ;;
      no|N|n)
        echo -e "${GREEN}Nothing to be done. Thank you...${RESET}"
        ;;
      *)
        echo -e "${GREEN}No choice. Exiting script...${RESET}"
        ;;
    esac
  }

  # function to delete docker image
  dkr_rmi_image() {
    read -p $'\nDo you want to remove image? (yes|no): ' dkr_rmi
    case "$dkr_rmi" in
      yes|Y|y)
        if docker image inspect $DK_IMAGE &> /dev/null; then \
          echo -e "${RED}Deleting existing image...${RESET}"; \
          docker rmi $DK_IMAGE; \
        fi
        ;;
      no|N|n)
        echo -e "${GREEN}Nothing to be done. Thank you...${RESET}"
        ;;
      *)
        echo -e "${GREEN}No choice. Exiting script...${RESET}"
        ;;
    esac
  }

  # function to build docker image
  dkr_build_image() {
    read -p $'\nDo you want to build image? (yes|no): ' dkr_build
    case "$dkr_build" in
      yes|Y|y)
        echo -e "${GREEN}Building $DK_IMAGE image${RESET}"
        docker build -t $DK_IMAGE -f $DL_DFILE .
        docker images | grep $DL_IU/$DL_IN
        ;;
      no|N|n)
        echo -e "${GREEN}Nothing to be done. Thank you...${RESET}"
        ;;
      *)
        echo -e "${GREEN}No choice. Exiting script...${RESET}"
        ;;
    esac
  }

  dkr_purge_image
  dkr_rmi_image
  dkr_build_image
}

#---------------------------------------#
# deploy                                #
#---------------------------------------#
git_push() {
  git_branch
  ga_workflow_env $ENV_FILE
  commit_status
  gh_secret_set
  git_repo_push
}

ga_workflow_env() {
  read -p $'\nDo you want to create workflow env? (yes|no): ' ga_workflow
  case "$ga_workflow" in
    yes|Y|y)
      # check if argument is provided
      if [ $# -ne 1 ]; then
        read -p $'\nEnvfile not found... Enter path to env file: ' env
        envfile="$env"
      else
        envfile="$1"
      fi

      vfile="./ops/vars.txt"
      ga_file1="deploy.yml"
      ga_file2="deploy_new.yml"
      ga_dir="./.github/workflows"
      ga="$ga_dir/$ga_file1"
      ga_new="$ga_dir/$ga_file2"

      # Delete vars.txt if it exists
      if [ -f $vfile ]; then
        rm $vfile
      fi

      # Read .env file
      IFS=' ' read -r -a exclude <<< "$GA_ENV_EXCLUDE"
      while IFS= read -r kv; do
        key=$(echo "$kv" | cut -d= -f1)

        if [[ " ${exclude[@]} " =~ " $key " ]]; then
          continue
        fi

        if [[ $key != "" && $key != "#"* ]]; then
          echo "$key" >> $vfile
        fi
      done < <(grep '=' $envfile)

      # Load variables from vars.txt
      while read -r var; do
        vars+=($var)
      done < $vfile

      # Find the Generate envfile step in deploy.yml
      envfile_line=$(grep -n "uses: SpicyPizza/create-envfile@v2.0" $ga | cut -d: -f1)
      envfile_line=$((envfile_line+1))
      tail_line=$(grep -n "directory: \$GA_ENV_SRC" $ga | cut -d: -f1)

      # Generate new file with variables
      {
        head -n $((envfile_line)) $ga
        for var in "${vars[@]}"; do
          echo "          envkey_$var: \${{ secrets.$var }}" 
        done
        tail -n +$((tail_line)) $ga
      } > $ga_new

      # Overwrite original 
      mv $ga_new $ga
      rm -f $vfile
      echo -e "Actions worklow updated successfully!\n"
      ;;
    no|N|n)
      echo -e "${GREEN}Nothing to be done. Thank you...${RESET}\n"
      ;;
    *)
      echo -e "${GREEN}No choice. Exiting script...${RESET}"
      ;;
  esac
}

gh_secret_set() {
  # function to set secrets on private GitHub repo
  gh_secret_private() {
    read -p "Do you want to set secrets on private repo? (yes|no): " git_push
    case "$git_push" in
      yes|Y|y)
        # check if argument is provided
        if [ $# -ne 1 ]; then
          read -p $'\nEnvfile not found... Enter path to env file: ' env
          envfile="$env"
        else
          envfile="$1"
        fi

        # Set number of retries and delay between retries  
        MAX_RETRIES=3
        RETRY_DELAY=5
        # Helper function to retry command on failure
        retry() {
          local retries=$1
          shift
          local count=0
          until "$@"; do
            exit=$?
            count=$(($count + 1))
            if [ $count -lt $retries ]; then
              echo "Command failed! Retrying in $RETRY_DELAY seconds..."
              sleep $RETRY_DELAY 
            else
              echo "Failed after $count retries."
              return $exit
            fi
          done 
          return 0
        }

        echo -e "${GREEN}Setting secrets...${RESET}\n"
        # Read the .env file and set the secrets
        retry $MAX_RETRIES gh secret set -f "$envfile"
        # Check return code and output result
        if [ $? -eq 0 ]; then
          echo -e "Secrets set successfully\n"
        else
          echo -e "Error setting secrets\n"
          exit 1
        fi
        ;;
      no|N|n)
        echo -e "${GREEN}Nothing to be done. Thank you...${RESET}\n"
        ;;
      *)
        echo -e "${GREEN}No choice. Exiting script...${RESET}\n"
        exit 1
        ;;
    esac
  }

  # function to delete secrets on private GitHub repo
  gh_secret_private_rm() {
    read -p "Do you want to delete secrets on private repo? (yes|no): " git_push
    case "$git_push" in
      yes|Y|y)
        echo -e "${GREEN}Deleting secrets...${RESET}\n"
        # check if argument is provided
        if [ $# -ne 1 ]; then
          read -p $'\nEnvfile not found... Enter path to env file: ' env
          envfile="$env"
        else
          envfile="$1"
        fi
        # Initialize the ARGS array
        ARGS=()

        while IFS= read -r line; do
          # Check if the line is not empty and does not start with '#'
          if [ -n "$line" ] && [[ ! "$line" =~ ^\# ]]; then
            # Extract the variable name (part before the '=' sign)
            var_name=$(echo "$line" | cut -d'=' -f1)
            ARGS+=("$var_name")
          fi
        done < "$envfile"
        parallel --retries 3 --silent -j+0 gh secret delete ::: "${ARGS[@]}"

        # Check return code and output result
        if [ $? -eq 0 ]; then
          echo -e "Secrets deleted successfully\n"
        else
          echo -e "Error deleting secrets\n"
          exit 1
        fi
        ;;
      no|N|n)
        echo -e "${GREEN}Nothing to be done. Thank you...${RESET}\n"
        ;;
      *)
        echo -e "${GREEN}No choice. Exiting script...${RESET}\n"
        exit 1
        ;;
    esac
  }

  # function to set secrets on public GitHub repo
  gh_secret_public() {
    read -p "Do you want to set secrets on public repo? (yes|no): " git_push
    case "$git_push" in
      yes|Y|y)
        # check if argument is provided
        if [ $# -ne 1 ]; then
          read -p $'\nEnvfile not found... Enter path to env file: ' env
          envfile="$env"
        else
          envfile="$1"
        fi

        # Set number of retries and delay between retries  
        MAX_RETRIES=3
        RETRY_DELAY=5
        # Helper function to retry command on failure
        retry() {
          local retries=$1
          shift
          local count=0
          until "$@"; do
            exit=$?
            count=$(($count + 1))
            if [ $count -lt $retries ]; then
              echo "Command failed! Retrying in $RETRY_DELAY seconds..."
              sleep $RETRY_DELAY 
            else
              echo "Failed after $count retries."
              return $exit
            fi
          done 
          return 0
        }

        echo -e "${GREEN}Setting secrets...${RESET}\n"
        # Check the GH_BRANCH variable
        if [ "$GH_BRANCH" = "release/prod" ]; then
          env="prod"
        elif [ "$GH_BRANCH" = "release/dev" ]; then
          env="dev"
        else
          echo "GH_BRANCH value not what is expected!"
          exit 0
        fi
        # Read the .env file and set the secrets
        retry $MAX_RETRIES gh secret set -f "$envfile" -e"$env"
        # Check return code and output result
        if [ $? -eq 0 ]; then
          echo -e "Secrets set successfully\n"
        else
          echo -e "Error setting secrets\n"
          exit 1
        fi
        ;;
      no|N|n)
        echo -e "${GREEN}Nothing to be done. Thank you...${RESET}\n"
        ;;
      *)
        echo -e "${GREEN}No choice. Exiting script...${RESET}\n"
        exit 1
        ;;
    esac
  }

  # function to delete secrets on public GitHub repo
  gh_secret_public_rm() {
    read -p "Do you want to delete secrets on public repo? (yes|no): " git_push
    case "$git_push" in
      yes|Y|y)
        echo -e "${GREEN}Deleting secrets...${RESET}\n"
        # check if argument is provided
        if [ $# -ne 1 ]; then
          read -p $'\nEnvfile not found... Enter path to env file: ' env
          envfile="$env"
        else
          envfile="$1"
        fi
        # Check the GH_BRANCH variable
        if [ "$GH_BRANCH" = "release/prod" ]; then
          env="prod"
        elif [ "$GH_BRANCH" = "release/dev" ]; then
          env="dev"
        else
          echo "Aha! No need then..."
          exit 0
        fi
        # Read the envfile line by line and delete the secrets
        while IFS= read -r line; do
          # Skip lines starting with '#' (comments)
          if [ -n "$line" ] && [[ $line != \#* ]]; then
            # Trim leading/trailing whitespaces
            line=$(echo "$line" | xargs)
            gh secret delete "$line" --repo $DL_REPO --env"$env"
          fi
        done < "$envfile"
        # Check return code and output result
        if [ $? -eq 0 ]; then
          echo -e "Secrets deleted successfully\n"
        else
          echo -e "Error deleting secrets\n"
          exit 1
        fi
        ;;
      no|N|n)
        echo -e "${GREEN}Nothing to be done. Thank you...${RESET}\n"
        ;;
      *)
        echo -e "${GREEN}No choice. Exiting script...${RESET}\n"
        exit 1
        ;;
    esac
  }

  # function to set variables on private GitHub repo
  gh_variable_private() {
    read -p "Do you want to set variables on private repo? (yes|no): " git_push
    case "$git_push" in
      yes|Y|y)
        echo -e "${GREEN}Setting variables...${RESET}\n"
        vhost=${GA_NGX_VHOST}
        gh variable set NGX < "$vhost"
        # Check return code and output result
        if [ $? -eq 0 ]; then
          echo -e "Variables set successfully\n"
        else
          echo -e "Error setting variables\n"
          exit 1
        fi
        ;;
      no|N|n)
        echo -e "${GREEN}Nothing to be done. Thank you...${RESET}\n"
        ;;
      *)
        echo -e "${GREEN}No choice. Exiting script...${RESET}\n"
        exit 1
        ;;
    esac
  }

  # function to delete variables on private GitHub repo
  gh_variable_private_rm() {
    read -p "Do you want to delete variables on private repo? (yes|no): " git_push
    case "$git_push" in
      yes|Y|y)
        echo -e "${GREEN}Deleting variables...${RESET}\n"
        vhost=${GA_NGX_VHOST}
        gh variable delete NGX < "$vhost"
        # Check return code and output result
        if [ $? -eq 0 ]; then
          echo -e "Variables deleted successfully\n"
        else
          echo -e "Error deleting variables\n"
          exit 1
        fi
        ;;
      no|N|n)
        echo -e "${GREEN}Nothing to be done. Thank you...${RESET}\n"
        ;;
      *)
        echo -e "${GREEN}No choice. Exiting script...${RESET}\n"
        exit 1
        ;;
    esac
  }

  # function to set variables on public GitHub repo
  gh_variable_public() {
    read -p "Do you want to set variables on public repo? (yes|no): " git_push
    case "$git_push" in
      yes|Y|y)
        echo -e "${GREEN}Setting variables...${RESET}\n"
        # Check the GH_BRANCH variable
        if [ "$GH_BRANCH" = "release/prod" ]; then
          env="prod"
        elif [ "$GH_BRANCH" = "release/dev" ]; then
          env="dev"
        else
          echo "Haa! No need then..."
          exit 0
        fi
        vhost=${GA_NGX_VHOST}
        gh variable set NGX < "$vhost" -e"$env"
        # Check return code and output result
        if [ $? -eq 0 ]; then
          echo -e "Variables set successfully\n"
        else
          echo -e "Error setting variables\n"
          exit 1
        fi
        ;;
      no|N|n)
        echo -e "${GREEN}Nothing to be done. Thank you...${RESET}\n"
        ;;
      *)
        echo -e "${GREEN}No choice. Exiting script...${RESET}\n"
        exit 1
        ;;
    esac
  }

  # function to delete variables on public GitHub repo
  gh_variable_public_rm() {
    read -p "Do you want to delete variables on public repo? (yes|no): " git_push
    case "$git_push" in
      yes|Y|y)
        echo -e "${GREEN}Deleting variables...${RESET}\n"
        # Check the GH_BRANCH variable
        if [ "$GH_BRANCH" = "release/prod" ]; then
          env="prod"
        elif [ "$GH_BRANCH" = "release/dev" ]; then
          env="dev"
        else
          echo "Haa! No need then..."
          exit 0
        fi
        vhost=${GA_NGX_VHOST}
        gh variable delete NGX < "$vhost" -e"$env"
        # Check return code and output result
        if [ $? -eq 0 ]; then
          echo -e "Variables deleted successfully\n"
        else
          echo -e "Error deleting variables\n"
          exit 1
        fi
        ;;
      no|N|n)
        echo -e "${GREEN}Nothing to be done. Thank you...${RESET}\n"
        ;;
      *)
        echo -e "${GREEN}No choice. Exiting script...${RESET}\n"
        exit 1
        ;;
    esac
  }

  check="$(gh_repo_view)"
  if [ "$check" == "private" ]; then
    gh_secret_private_rm argv $ENV_FILE
    gh_secret_private argv $ENV_FILE
    gh_variable_private_rm
    gh_variable_private
  elif [ "$check" == "public" ]; then
    gh_secret_public_rm $ENV_FILE
    gh_secret_public $ENV_FILE
    gh_variable_public_rm
    gh_variable_public
  else
    echo "Could not set secrets. Something is wrong!"
    exit 1
  fi
}

git_repo_push() {
  read -p "Do you want to push your commit to GitHub? (yes|no): " git_push
  case "$git_push" in
    yes|Y|y)
      echo -e "${GREEN}Pushing commit to GitHub...${RESET}\n"
      git push
      ;;
    no|N|n)
      echo -e "${GREEN}Nothing to be done. Thank you...${RESET}\n"
      ;;
    *)
      echo -e "${GREEN}No choice. Exiting script...${RESET}\n"
      exit 1
      ;;
  esac
}

# function to push docker image
docker_push() {
  # which git branch?
  git_branch

	read -p $'\nDo you want to push docker image? (yes|no): ' dkr_push
	case "$dkr_push" in
		yes|Y|y)
			echo ${DK_TOKEN} | docker login -u ${DK_HUB} --password-stdin
	    docker push $DK_IMAGE
			;;
		no|N|n)
			echo -e "${GREEN}Nothing to be done. Thank you...${RESET}"
			;;
		*)
			echo -e "${GREEN}No choice. Exiting script...${RESET}"
			;;
	esac
}

#---------------------------------------#
# github actions                        #
#---------------------------------------#
# function to create dns record on aws route53
create_dns_record() {
  # Run the AWS CLI command to list resource record sets
  record_sets=$(aws route53 list-resource-record-sets \
    --hosted-zone-id "$AWS_R53_ZONE_ID" \
    --query "ResourceRecordSets[?Name == '$GA_APP_URL.']" \
    --output json)

  # Check if the record_sets variable is empty (DNS entry doesn't exist)
  if echo "$record_sets" | jq -e '.[].Name | test("'$GA_URL1'\\.'$GA_URL2'\\.'$GA_URL3'")' > /dev/null; then
    echo "DNS entry $GA_APP_URL exists."
    exit 0
  else
    echo "Creating DNS entry for $GA_APP_URL..."
    touch route53.json
  cat >route53.json <<EOF
  {
    "Comment": "CREATE record ",
    "Changes": [{
    "Action": "CREATE",
      "ResourceRecordSet": {
        "Name": "$GA_APP_URL",
        "Type": "A",
        "TTL": 300,
        "ResourceRecords": [{ "Value": "$HOST_IP"}]
    }}]
  }
EOF
    cat route53.json
    aws route53 change-resource-record-sets --hosted-zone-id "$AWS_R53_ZONE_ID" --change-batch file://route53.json
  fi
}

# function to create directory to deploy app  
create_app_dir() {
  # Set the target directory 
  docker_dir="$DK_DIR"
  app_dir="$APP_ID"

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
}

# function to clone app repository 
clone_app_repo() {
  # Check app dir
  echo -e "\nChecking if app directory exists.."
  if [ ! -d "$GA_APP_DIR" ]; then
    echo "Directory not found, creating..."
    mkdir -p "$GA_APP_DIR"
  else
    echo "Directory already exists."
  fi

  # Enter into app dir
  echo -e "\nEntering app directory.."
  cd "$GA_APP_DIR"

  # Clone app repo
  echo -e "\nCloning latest repo changes.."
  if [ ! -d .git ]; then
    echo "App repo not found. Cloning..."
    git clone "$GH_REPO" . \
    && git switch "$GH_BRANCH"
  else
    echo "App repo exists..."
    git fetch --all \
    && git switch "$GH_BRANCH"
  fi
}

# function to create nginx vhost for app url
create_nginx_vhost() {
  # enter directory
  cd "$GA_ENV_DEST"

  # another way
  ngxx="vhost.conf"
  ngx=$(cat "$ngxx")
  eval "VHOST=\"$ngx\""

  # Create a temporary file with the provided configuration
  echo -e "\nCreating temporary file..."
  temp_file="$(mktemp)"
  echo "$VHOST" > "$temp_file"

  # Extract the block identifier (the first line of the provided config)
  echo -e "\nExtracting the vhost block identifier..."
  block_identifier=$(head -n 1 "$temp_file")
  echo -e "Content of block identifier:\n$block_identifier"

  # Check if the vhost configuration exists
  echo -e "\nChecking if vhost config exists..."
  if grep -qF "$block_identifier" "$HOST_NGX_DIR/$GA_NGX_CONF"; then
    echo -e "Vhost config already exists."

    # Get the existing vhost block that matches the block identifier
    echo -e "\nExtracting existing vhost config..."
    end_pattern="^}"
    existing_block="$(sed -n "/$block_identifier/,/$end_pattern/p" "$HOST_NGX_DIR/$GA_NGX_CONF")"
    echo -e "Content of existing vhost:\n$existing_block"

    # Compare the existing block with the provided configuration
    echo -e "\nComparing existing vhost config with provided vhost config..."
    if diff -q <(echo "$VHOST") <(echo "$existing_block"); then
      echo "Configuration matches. No action needed."
    else
      # Delete the existing vhost configuration and append the provided config
      echo -e "\nDeleting existing vhost config..."
      sed -i "/$block_identifier/,/$end_pattern/d" "$HOST_NGX_DIR/$GA_NGX_CONF"
      echo -e "\nUpdating vhost config..."
      echo -e "\n$VHOST" | sudo tee -a "$HOST_NGX_DIR/$GA_NGX_CONF"
      echo "Nginx vhost configuration updated."

      # Test Nginx configuration for syntax errors
      sudo nginx -t

      # Reload Nginx if the configuration is valid
      if [ $? -eq 0 ]; then
        sudo nginx -s reload
        sudo systemctl status nginx
      else
        echo "Nginx configuration is invalid. Not reloading Nginx."
      fi
    fi
  else
    echo "Nginx vhost configuration not found."
    echo "Creating Nginx vhost entry for $GA_APP_URL..."
    echo -e "\n$VHOST" | sudo tee -a "$HOST_NGX_DIR/$GA_NGX_CONF"

    # Test Nginx configuration for syntax errors
    sudo nginx -t

    # Reload Nginx if the configuration is valid
    if [ $? -eq 0 ]; then
      sudo nginx -s reload
      sudo systemctl status nginx
    else
      echo "Nginx configuration is invalid. Not reloading Nginx."
    fi  
  fi

  # Remove temporary files
  echo -e "\nRemoving temporary files..."
  rm -f "$temp_file"
  rm -f "$ngxx"
}

# function to deploy app
ga_deploy_app() {
  # Enter app dir
  echo -e "\nEntering app directory..."
  cd "$GA_APP_DIR"

  # Pull repo changes
  echo -e "\nDownloading latest repo changes..."
  make new

  # Drop running container
  echo -e "\nDropping running container..."
  make down

  # Start new container
  echo -e "\nLaunching latest app version..."
  make run
}

#---------------------------------------#
# utils                                 #
#---------------------------------------#
# function to copy .env based on environment
copy_app_env() {
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
}

# function to scan GitHub repo
git_repo_scan() {
	read -p "Do you want to scan this repo? (yes|no): " repo_scan
	case "$$repo_scan" in
		yes|Y|y)
			echo -e "${GREEN}Scanning repo for secrets...${RESET}\n"
			ggshield secret scan repo .
			;;
		no|N|n)
			echo -e "${GREEN}Okay. Thank you...${RESET}\n"
			exit 0
			;;
		*)
			echo -e "${GREEN}No choice. Exiting script...${RESET}\n"
			exit 1
			;;
	esac  
}

#function to rename local git repo
git_repo_rename() {
  echo -e "I love JESUS"
}

# function to rename GitHub repo
gh_repo_rename() {
  read -p "Enter GitHub username: " GH_USER

  repo_name() {
    read -p "Enter current repository name: " GH_REPO
    read -p "Enter new repository name: " NEW_NAME
    # API to rename repo
    API_ENDPOINT="https://api.github.com/repos/${GH_USER}/${GH_REPO}"

    # Make API call to rename repo
    curl \
      -X PATCH \
      -H "Authorization: token ${GH_TOKEN}" \
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
        echo -e "${GREEN}Nothing to be done. Thank you...${RESET}\n"
        exit 0
        ;;
      *)
        echo -e "${GREEN}No choice. Exiting script...${RESET}\n"
        exit 1
        ;;
    esac
  }
  # Select action
  echo "Select action:"
  echo "1) Rename repo name on Github"
  echo "2) Rename repo remote url"
  read action_selection
  if [ $action_selection -eq 1 ]; then
    repo_name
  elif [ $action_selection -eq 2 ]; then
    repo_url
  else
    echo "Invalid selection"
    exit 1  
  fi
}

# function to check if GitHub repo exists
gh_repo_check() {
  # check if argument is provided
  if [ $# -ne 1 ]; then
    read -p "Enter GitHub username: " ghUser
		read -p "Enter GitHub repo name: " ghName
    repo="${ghUser}/${ghName}"
  else
    repo=$1
  fi

  status_code=$(curl -s -o /dev/null -w "%{http_code}" -H "Authorization: token ${GH_TOKEN}" "https://api.github.com/repos/$repo")

  code1=200
  code2=404

  if [ $status_code -eq 200 ]; then
    echo $code1
  elif [ $status_code -eq 404 ]; then
    echo $code2
  else
    echo "Status code: $status_code" >&2
    exit 1
  fi
}

# function to check if GitHub repo is private/public
gh_repo_view() {
  code1=private
  code2=public
  view=$(gh repo view $DL_REPO --json isPrivate -q .isPrivate 2>/dev/null)
	if [ "$view" = "true" ]; then
		echo $code1
	else
		echo $code2
	fi
}




# Check if a choice was provided as a command line argument
if [ $# -eq 0 ]; then
  # If no choice was provided, prompt for action
  echo "1) Create local repo"
  echo "2) Create GitHub repo"
  echo "3) Commit git repo"
  echo "4) Build docker image" 
  echo "5) Push docker image"
  echo "6) Push git repo"
  echo "7) Create DNS record"
  echo "8) Create app directory"
  echo "9) Clone app repo"
  echo "10) Create Nginx vhost"
  echo "11) Deploy app to server"
  echo "----------------------------------"
  read -p $'\nSelect action to perform [1-9]: ' choice
else
  # If an argument is provided, use it
  choice="$1"
fi

if [ $choice -eq 0 ]; then
  nginx_config
elif [ $choice -eq 1 ]; then
  git_repo_create
elif [ $choice -eq 2 ]; then
  gh_repo_create
elif [ $choice -eq 3 ]; then
  git_commit
elif [ $choice -eq 4 ]; then
  docker_build
elif [ $choice -eq 5 ]; then
  git_push
elif [ $choice -eq 6 ]; then
  docker_push
elif [ $choice -eq 7 ]; then
  create_dns_record
elif [ $choice -eq 8 ]; then
  create_app_dir
elif [ $choice -eq 9 ]; then
  clone_app_repo
elif [ $choice -eq 10 ]; then
  create_nginx_vhost
elif [ $choice -eq 11 ]; then
  ga_deploy_app
elif [ $choice -eq 12 ]; then
  copy_app_env
elif [ $choice -eq 13 ]; then
  git_repo_scan
elif [ $choice -eq 14 ]; then
  git_repo_rename
elif [ $choice -eq 15 ]; then
  gh_repo_rename
elif [ $choice -eq 16 ]; then
  gh_repo_check
elif [ $choice -eq 17 ]; then
  gh_repo_view
else
  echo "Invalid selection"
  exit 1  
fi
