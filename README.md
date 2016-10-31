# E-commerce Cart Sample

The cart sample includes a Vagrantfile, behat tests and plain old PHP objects (POPOs) that model the functionality of a basic shopping cart.

[![Build Status](https://travis-ci.org/hautelook/halo-sample-cart.svg)](https://travis-ci.org/hautelook/halo-sample-cart)

## Requirements

The cart sample uses Vagrant to provision and configure a Virtual Machine that satisfies all the dependencies for the code to work.

   * VirtualBox `5.0.x`. Download here: https://www.virtualbox.org/wiki/Downloads
   * Vagrant `1.8.x`. Download here: https://www.vagrantup.com/downloads.html

## Installation

   * Make sure you have a working internet connection. The virtual machine will be downloading packages from the internet in order to configure itself.
   * Download and install Virtualbox.
   * Download and install Vagrant.
   * Start the Vagrant box (VM) by typing: `vagrant up`
   * During the startup process, the virtual machine will be provisioned with git, php and composer.

Note: We expect installation to take 15-30 minutes to setup. If for any reason it is taking longer, please feel free to reach out to us. We are happy to [help](#support).

### Windows Users

If you are using a Windows machine, you may encounter some problems getting Vagrant working. Please read [Getting Started with Vagrant on Windows](http://www.sitepoint.com/getting-started-vagrant-windows/) for some Windows specific instructions.

## Running Tests

After installation, ssh into the vagrant box and confirm the tests are working:

```bash
$ vagrant ssh
$ cd /vagrant
$ behat
```

The tests should complete without errors. The majority of the tests will be in a pending state.

## Code Layout

Here is a high level overview of the important files in this project:

   * `features/cart.feature` - the gherkin language that describes scenarios (tests cases) for the sample cart code.
   * `features/bootstrap/FeatureContext.php` - the Behat file that parses the above `cart.feature` and executes tests.
   * `src/HauteLook/Cart.php` - the sample cart class

You may need to add additional files or classes to complete the assignment. Vagrant will automatically sync any changes you make to these files from your host operating system, so feel free to use whatever editor your are most comfortable with to browse and edit them.

## Challenge

The first scenario has been written for you. Please implement the remaining scenarios in `features/cart.feature'. We are judging you on the design and the correctness of the code. Make whatever changes you want to the scenario implementations and source code to accomplish that goal. We are excited to see it! Zip up the directory and email it back to us. You can omit the `.git` and `vendor` directories when creating the zip.

### Support

Need help? Please reach out to us! We know computers can be tricky things and we are happy to assist you. Our contact details are in the email we sent you. We will get back to you as soon as we can.
