# -*- mode: ruby -*-
# vi: set ft=ruby :

# Vagrantfile API/syntax version. Don't touch unless you know what you're doing!
VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
  # Every Vagrant virtual environment requires a box to build off of.
  config.vm.box = "ubuntu/trusty64"
  config.vm.hostname = "dev-vagrant-app.local.bamboohr.net"
  config.vm.provider "virtualbox" do |vb|
    vb.customize ["modifyvm", :id, "--memory", "2048"]
    vb.customize ["modifyvm", :id, "--natdnshostresolver1", "off"]
	vb.gui = true
  end
  config.vm.network "private_network", ip: "10.74.140.52"
# Use NFS to improve synced_folder performance
  config.vm.synced_folder '.', '/vagrant', nfs: true
  config.vm.provision "shell",
    inline: "
      cp /vagrant/Vagrant/puppet_ssl/certs/* /var/lib/puppet/ssl/certs;
      cp /vagrant/Vagrant/puppet_ssl/private_keys/* /var/lib/puppet/ssl/private_keys;
      echo 'dev-vagrant-app.local.bamboohr.net' > /etc/hostname;
      /bin/hostname dev-vagrant-app.local.bamboohr.net;
      /usr/bin/aptitude update"
  config.vm.provision "puppet_server" do |puppet|
    puppet.puppet_server = "puppet.bamboohr.net"
    puppet.options = "--test --enable"
  end
  config.vm.provision "puppet_server" do |puppet|
    puppet.puppet_server = "puppet.bamboohr.net"
    puppet.options = "--test"
  end

end
