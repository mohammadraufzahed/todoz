Vagrant.configure("2") do |config|
  config.vm.box = "ubuntu/focal64"
  config.vm.box_check_update = true
  config.vm.network "public_network"
  config.vm.provider "virtualbox" do |vb|
    # Display the VirtualBox GUI when booting the machine
    vb.gui = false
    vb.name = "Todoz Development Environment"
    # Customize the amount of memory on the VM:
    vb.memory = "4024"
  end
  config.vm.provision "shell", path: "./vagrant/setup.sh"
end
