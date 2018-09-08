# E-commerce Cart Sample

The cart sample includes a Dockerfile, docker-compose, behat tests and plain old PHP objects (POPOs) that model the 
functionality of a basic shopping cart.

[![Build Status](https://travis-ci.org/hautelook/halo-sample-cart.svg)](https://travis-ci.org/hautelook/halo-sample-cart)

## Requirements

The cart sample uses a docker image that satisfies all the dependencies for the behat tests to work.

   * Docker stable CE release. Download here: https://docs.docker.com/install/

## Installation

   * Make sure you have a working internet connection.
   * Download and install Docker.
   * Build the docker container: `docker-compose build`

Note: We expect installation to take 5-20 minutes to setup. If for any reason it is taking longer, please feel free to 
reach out to us. We are happy to [help](#support).

## Running Tests

After installation confirm that tests are working
   * Run tests: `docker-compose up`

The tests should complete without errors. The majority of the tests will be in a pending state.

## Code Layout

Here is a high level overview of the important files in this project:

   * `features/cart.feature` - the gherkin language that describes scenarios (tests cases) for the sample cart code.
   * `features/bootstrap/FeatureContext.php` - the Behat file that parses the above `cart.feature` and executes tests.
   * `src/HauteLook/Cart.php` - the sample cart class

You may need to add additional files or classes to complete the assignment. Vagrant will automatically sync any changes you make to these files from your host operating system, so feel free to use whatever editor your are most comfortable with to browse and edit them.

## Challenge

The first scenario has been written for you. Please implement the remaining scenarios in `features/cart.feature`. We are judging you on the design and the correctness of the code. Make whatever changes you want to the scenario implementations and source code to accomplish that goal. We are excited to see it! Zip up the directory and email it back to us. You can omit the `.git` and `vendor` directories when creating the zip.

### Support

Need help? Please reach out to us! We know computers can be tricky things and we are happy to assist you. Our contact details are in the email we sent you. We will get back to you as soon as we can.
