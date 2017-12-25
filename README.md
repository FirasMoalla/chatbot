# Getting started with PHP and Watson Chatbot on IBM Cloud

This lab will take you through the steps to get started with a simple PHP application for a Chatbot in IBM Cloud and help you:
- Set up a development environment
- Download sample code
- Run the application locally
- Run the application on IBM Cloud Cloud Foundry
- Add a IBM Cloud Conversation service for a Chatbot
- Implement a Chatbot

This lab is in two parts. In the first part, we will build a PHP application for a chatbot. In the second part, we will implement the Chatbot.

## Prerequisites

You'll need the following:
* [IBM Cloud account](https://console.ng.bluemix.net/registration/)
* [Cloud Foundry CLI](https://github.com/cloudfoundry/cli#downloads)
* [Git](https://git-scm.com/downloads)
* [PHP](http://php.net/downloads.php)
* [Composer](https://getcomposer.org/download/)

# Part 1: Build a PHP Chatbot app on IBM Cloud

## 1. Clone the sample PHP app

Clone the following repo and change your directory to where the sample application is located.
  ```
git clone https://github.com/FirasMoalla/chatbot-php
cd chatbot-php
  ```

## 2. Run the app locally

Install dependencies
```
php composer.phar install
```

Run the application on your local machine
  ```
php -S localhost:8000
  ```

View your app at: http://localhost:8000

## 3. Prepare the app for deployment

To deploy to IBM Cloud, we can set up a manifest.yml file. The manifest.yml includes basic information about your application, such as the name, how much memory to allocate for each instance and the route. We've provided a sample manifest.yml file in the `php-chatbot` directory.

Open the manifest.yml file, and change the `name` from `GetStartedPHP` to your PHP application name.

 ```
 applications:
 - name: GetStartedPHP
   random-route: true
   memory: 128M
 ```

In this manifest.yml file, random-route: true generates a random route for your app to prevent your route from colliding with others. If you choose to, you can replace random-route: true with host: myChosenHostName, supplying a host name of your choice. [Learn more...](https://github.com/FirasMoalla/chatbot/blob/master/docs/manageapps/depapps.html#appmanifest)

## 4. Deploy the app

You can use the Cloud Foundry CLI to deploy applications.

Choose your API endpoint
   ```
bx api https://api.eu-gb.bluemix.net
   ```

Login to your IBM Cloud account

   ```
bx login
   ```

From within the *chatbot-php* directory push your app to IBM Cloud
   ```
bx app push
   ```

This can take a minute. If there is an error in the deployment process you can use the command `bx logs <Your-App-Name> --recent` to troubleshoot.

When deployment completes you should see a message indicating that your app is running. View your app at the URL listed in the output of the push command. You can also issue the
  ```
bx app list
  ```
command to view your apps status and see the URL.

## 5. Create a Chatbot service

Next, we'll add a Conversation service (Chatbot) to this application and set up the application so that it can run locally and on IBM Cloud.

1. Log in to IBM Cloud in your Browser. Click on `Catalog` on the top right.
2. Click on `Connections` then `Connect new`.
3. Click on `Watson` on the left menu and then click on `Conversation`.
4. From the top left menu, browse to `Dashboard`. Select your PHP application by clicking on its name in the `Name` column.
5. Click on `Connections` then click on `Create` connection.
6. Select the `Converstation` service.
7. Select `Restage` when prompted. IBM Cloud will restart your application and provide the `Converstation` credentials to your PHP application using the `VCAP_SERVICES` environment variable. This environment variable is only available to the application when it is running on IBM Cloud.

Environment variables enable you to separate deployment settings from your source code. For example, instead of hardcoding a database password, you can store this in an environment variable which you reference in your source code. [Learn more...](/docs/manageapps/depapps.html#app_env)

# Part 2: Implementing a Chatbot


# Resources

