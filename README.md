{:shortdesc: .shortdesc}
{:new_window: target="_blank"}
{:codeblock: .codeblock}
{:pre: .pre}
{:screen: .screen}
{:tip: .tip}
{:download: .download}
{:app_name: data-hd-keyref="app_name"}

# Watson ChatBot Lab

In this lab, we will deploy a Hello World Chatbot application on IBM Cloud you deployed. The lab is in two parts.  First, Second. To get started, follow this step-by-step guide. Or, <a class="xref" href="http://bluemix.net" target="_blank" title="(Download sample code)"><img class="hidden" src="../../images/btn_starter-code.svg" alt="Download application code" />download the sample code</a> and explore on your own.

By following the Watson Chatbot tutorial, you'll set up a development environment, deploy an app locally and on {{site.data.keyword.Bluemix}}, and integrate a database service in your app.

## Before you begin

You'll need the following:
* [{{site.data.keyword.Bluemix_notm}} account](https://console.ng.bluemix.net/registration/)
* [Bluemix CLI ![External link icon](../../icons/launch-glyph.svg "External link icon")](https://github.com/cloudfoundry/cli#downloads){: new_window}
* [Git ![External link icon](../../icons/launch-glyph.svg "External link icon")](https://git-scm.com/downloads){: new_window}
* [PHP ![External link icon](../../icons/launch-glyph.svg "External link icon")](http://php.net/downloads.php){: new_window}
* [Composer ![External link icon](../../icons/launch-glyph.svg "External link icon")](https://getcomposer.org/download/){: new_window}


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
  {: pre}
  ```
cd get-started-php
  ```
  {: pre}

## Step 2: Run the app locally

Install dependencies
```
php composer.phar install
```
{: pre}

Run the app
  ```
php -S localhost:8000
  ```
  {: pre}

View your app at: http://localhost:8000

## Step 3: Prepare the app for deployment
{: #prepare}

To deploy to {{site.data.keyword.Bluemix_notm}}, it can be helpful to set up a manifest.yml file. The manifest.yml includes basic information about your app, such as the name, how much memory to allocate for each instance and the route. We've provided a sample manifest.yml file in the `get-started-php` directory.

Open the manifest.yml file, and change the `name` from `GetStartedPHP` to your app name, <var class="keyword varname" data-hd-keyref="app_name">app_name</var>.
{: download}

  ```
 applications:
 - name: GetStartedPHP
   random-route: true
   memory: 128M
  ```
  {: codeblock}

In this manifest.yml file, **random-route: true** generates a random route for your app to prevent your route from colliding with others.  If you choose to, you can replace **random-route: true** with **host: myChosenHostName**, supplying a host name of your choice. [Learn more...](/docs/manageapps/depapps.html#appmanifest)
{: tip}

## Step 4: Deploy the app
 {: #deploy}

You can use the Cloud Foundry CLI to deploy apps.

Choose your API endpoint
   ```
cf api <API-endpoint>
   ```
   {: pre}

Replace the *API-endpoint* in the command with an API endpoint from the following list.

| **Region name** | **Geographic location** | **API endpoint** |
|-----------------|-------------------------|-------------------|
| US South region | Dallas, US | api.ng.bluemix.net |
| US East region | Washington, DC, US | api.us-east.bluemix.net |
| United Kingdom region | London, England | api.eu-gb.bluemix.net |
| Sydney region | Sydney, Australia | api.au-syd.bluemix.net |
| Germany region | Frankfurt, Germany | api.eu-de.bluemix.net |
{: caption="Table 1. {{site.data.keyword.cloud_notm}} region list" caption-side="top"}

Log in to your {{site.data.keyword.Bluemix_notm}} account

   ```
cf login
   ```
   {: pre}

If you cannot log in using the `cf login` or `bx login` commands because you have a federated user ID, use either the `cf login --sso` or `bx login --sso` commands to log in with your single sign on ID. See [Logging in with a federated ID](https://console.bluemix.net/docs/cli/login_federated_id.html#federated_id) to learn more.

 From within the *get-started-php* directory push your app to {{site.data.keyword.Bluemix_notm}}
   ```
cf push
   ```
   {: pre}

 This can take a minute. If there is an error in the deployment process you can use the command `cf logs <Your-App-Name> --recent` to troubleshoot.

 When deployment completes you should a message indicating that your app is running.  View your app at the URL listed in the output of the push command.  You can also issue the
  ```
cf apps
  ```
  {: pre}
  command to view your apps status and see the URL.

## Step 5: Add a database
{: #add_database}

Next, we'll add a NoSQL database to this application and set up the application so that it can run locally and on {{site.data.keyword.Bluemix_notm}}.

1. Log in to {{site.data.keyword.Bluemix_notm}} in your Browser. Browse to the `Dashboard`. Select your application by clicking on its name in the `Name` column.
2. Click on `Connections` then `Create connection`.
3. In the `Data & Analytics` section, select `Cloudant NoSQL DB` and `Create` the service.
4. Select `Restage` when prompted. {{site.data.keyword.Bluemix_notm}} will restart your application and provide the database credentials to your application using the `VCAP_SERVICES` environment variable. This environment variable is only available to the application when it is running on {{site.data.keyword.Bluemix_notm}}.

Environment variables enable you to separate deployment settings from your source code. For example, instead of hardcoding a database password, you can store this in an environment variable which you reference in your source code. [Learn more...](/docs/manageapps/depapps.html#app_env)
{: tip}

## Step 6: Use the database
{: #use_database}
We're now going to update your local code to point to this database. We'll create a json file that will store the credentials for the services the application will use. This file will get used ONLY when the application is running locally. When running in {{site.data.keyword.Bluemix_notm}}, the credentials will be read from the VCAP_SERVICES environment variable.

1. Create a file called `.env` in the `get-started-php` directory with the following content:
  ```
  CLOUDANT_HOST=
  CLOUDANT_USERNAME=
  CLOUDANT_PASSWORD=
  ```

2. Back in the {{site.data.keyword.Bluemix_notm}} UI, select your App -> Connections -> Cloudant -> View Credentials

3. Copy and paste values of the `CLOUDANT_HOST`, `CLOUDANT_USERNAME` and `CLOUDANT_PASSWORD` fields into the `.env` file and save the changes.  The result will be something like:
  ```
  CLOUDANT_HOST=abc...yz.cloudant.com
  CLOUDANT_USERNAME=abc...yz
  CLOUDANT_PASSWORD=445d...d1a
  ```

4. Run your application locally.
  ```
php -S localhost:8000
  ```
  {: pre}

  View your app at: http://localhost:8000. Any names you enter into the app will now get added to the database.

  Your local app and  the {{site.data.keyword.Bluemix_notm}} app are sharing the database.  View your {{site.data.keyword.Bluemix_notm}} app at the URL listed in the output of the push command from above.  Names you add from either app should appear in both when you refresh the browsers.

Remember if you don't need your app live, stop it so you don't incur any unexpected charges.
{: tip}  

## Next Steps

* [Tutorials](/docs/tutorials/index.html)
* [Samples ![External link icon](../../icons/launch-glyph.svg "External link icon")](https://ibm-cloud.github.io){: new_window}
* [Architecture Center ![External link icon](../../icons/launch-glyph.svg "External link icon")](https://www.ibm.com/cloud/garage/category/architectures){: new_window}
