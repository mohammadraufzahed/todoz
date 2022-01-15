# Update the mirrors
sed -i 's|http://archive.|http://ir.archive.|g' /etc/apt/sources.list

# Set the debian to noninteractive
export DEBIAN_FRONTEND=noninteractive

# Update the Ubuntu
apt -qq update
apt -qq dist-upgrade -y

# Install the nodejs
if ! apt list --installed | grep "nodejs";then 
    curl -fsSL https://deb.nodesource.com/setup_16.x | sudo -E bash -
    apt-get -qq install -y nodejs
fi

# Install the tmux and bash
if ! apt list --installed | grep "tmux"; then
    apt -qq install tmux -y
fi
if ! apt list --installed | grep "bash-completion"; then
    apt -qq install bash-completion -y
fi

# Install the postgresql
if ! apt list --installed | grep "postgresql";then
    apt -qq install postgresql postgresql -y
fi

# Configure the database
sudo -u postgres createuser -s -i -d -r -l -w todoz
sudo -u postgres psql -c "ALTER ROLE todoz WITH PASSWORD 'todoz';"
sudo -u postgres psql -c "CREATE DATABASE todoz ENCODING 'UTF8';"