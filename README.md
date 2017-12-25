# Watson Chatbot Lab

In this lab, we will build a an application for a Chatbot and deploy it to IBM Cloud. The is in two parts. First, we will deploy a PHP Chatbot application on IBM Cloud lab. Then, we will implement a chatbot dialog. is in two parts. To get started, follow this step-by-step lab.

By following the Watson Chatbot tutorial, you'll set up a development environment, deploy an app locally and on IBM Cloud, and integrate a conversation service for the Chabot in your app.

## Before you begin

You'll need the following:
* [IBM Cloud Account](https://console.ng.bluemix.net/registration/)
* [Bluemix CLI Installation](https://console.bluemix.net/docs/cli/reference/bluemix_cli/all_versions.html#ibm-cloud-cli-installer-all-versions)
* [Git](https://git-scm.com/downloads)
* [PHP](http://php.net/downloads.php)
* [PHP Composer](https://getcomposer.org/download/)


## Step 1 Deploy a PHP app

Create and deploy a PHP app on IBM Cloud by following the steps below.

Log into your IBM Cloud account and navigate to the Cloud Foundary Apps by clicking [here](https://console.bluemix.net/catalog/?taxonomyNavigation=cf-apps&category=cf-apps).

Click on `PHP`.

Write a unique application name in the `App name` field then click on `Create`

## Step 2: Clone the sample app

Now you're ready to start working with the app. Clone the repo and change the directory to where the sample app is located.
  ```
git clone https://github.com/IBM-Bluemix/get-started-php
  ```
  ```
cd get-started-php
  ```

## Step 2: Run the app locally

Install dependencies
```
php composer.phar install
```

Run the app
  ```
php -S localhost:8000
  ```

View your app at: http://localhost:8000

## Step 3: Prepare the app for deployment

To deploy to {{site.data.keyword.Bluemix_notm}}, it can be helpful to set up a manifest.yml file. The manifest.yml includes basic information about your app, such as the name, how much memory to allocate for each instance and the route. We've provided a sample manifest.yml file in the `get-started-php` directory.

Open the manifest.yml file, and change the `name` from `GetStartedPHP` to your PHP app name.

  ```
 applications:
 - name: GetStartedPHP
   random-route: true
   memory: 128M
  ```

In this manifest.yml file, **random-route: true** generates a random route for your app to prevent your route from colliding with others.  If you choose to, you can replace **random-route: true** with **host: myChosenHostName**, supplying a host name of your choice. [Learn more...](/docs/manageapps/depapps.html#appmanifest)

## Step 4: Deploy the app

You can use the Cloud Foundry CLI to deploy apps.

First, choose your API endpoint
   ```
bx api <API-endpoint>
   ```

Replace the *API-endpoint* in the command with an API endpoint from the following list.

| **Region name** | **Geographic location** | **API endpoint** |
|-----------------|-------------------------|-------------------|
| US South region | Dallas, US | api.ng.bluemix.net |
| US East region | Washington, DC, US | api.us-east.bluemix.net |
| United Kingdom region | London, England | api.eu-gb.bluemix.net |
| Sydney region | Sydney, Australia | api.au-syd.bluemix.net |
| Germany region | Frankfurt, Germany | api.eu-de.bluemix.net |


Then, log in to your IBM Cloud account

   ```
bx login
   ```


 From within the *get-started-php* directory push your app to IBM Cloud
   ```
bx app push
   ```

 This can take a minute. If there is an error in the deployment process you can use the command `cf logs <Your-App-Name> --recent` to troubleshoot.

 When deployment completes you should a message indicating that your app is running.  View your app at the URL listed in the output of the push command.  You can also issue the
  ```
bx app list
  ```
  
 command to view your apps status and see the URL.

## Step 5: Create a Chatbot service

Next, we'll add a Conversation service (Chatbot) to this application and set up the application so that it can run locally and on IBM Cloud.

1. Log in to IBM Cloud in your Browser. Click on `Catalog` on the right.
2. Click on `Watson` and then on `Conversation`.
3. Click on `Create` to deply the `Conversation` services.
4. From the top left menu, browse to `Dashboard`. Select your PHP applcication by clicking on its name in the `Name` column.
5. Click on `Connections` then `Create connection`.
6. Select the `Converstation` service.
4. Select `Restage` when prompted. IBM Cloud will restart your application and provide the `Converstation` credentials to your PHP application using the `VCAP_SERVICES` environment variable. This environment variable is only available to the application when it is running on IBM Cloud.

Environment variables enable you to separate deployment settings from your source code. For example, instead of hardcoding a database password, you can store this in an environment variable which you reference in your source code. [Learn more...](/docs/manageapps/depapps.html#app_env)


# Resources

* [Tutorials](link)
* [Documentation](limnk)
* [API Reference]link()
