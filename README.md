# camunda-cake-example

A proof of concept to show how Camunda BPM and CakePHP can work together.  
This is a simple vacation request application built with Camunda Modeler, Camunda BPM, CakePHP 3 and Camunda BPM PHP SDK.

## Process Model

The `Yes Task` and `No Task` are little workarounds to show how many vacation requests were approved or denied,
since the history feature is only part of Camunda BPM Enterprise Edition.
![Process](https://github.com/steffenbrand/camunda-cake-example/blob/master/process.png?raw=true)

## CakePHP 3 UI

![UI](https://github.com/steffenbrand/camunda-cake-example/blob/master/vacation-requests.png?raw=true)

## Usage of Camunda BPM PHP SDK in CakePHP 3

See VacationController:  
[VacationController](https://github.com/steffenbrand/camunda-cake-example/blob/master/cake-camunda/src/Controller/VacationController.php)

## How to install?

### 1. Download Camunda BPM Tomcat Distribution

[Download Camunda BPM](https://camunda.org/download/)  
Camunda offers a ready to go distribution with all required components.  
Simply start the webserver with the provided .bat or .sh file.  
Your browser should open `http://localhost:8080/camunda/app/welcome/default/#/welcome` automatically.

### 2. Build the BPMN Model
The process model is an XML file created with the Camunda Modeler.  
It's ready at [/vacation-request/src/main/resources/vacation-request.bpmn](https://github.com/steffenbrand/camunda-cake-example/blob/master/vacation-request/src/main/resources/vacation-request.bpmn).  
You need to install a JDK > 7 and Apache Maven > 3.  
Create a .war file with maven.
```
mvn clean install
```

### 3. Deploy the process to Camunda BPM
Copy `vacation-request-1.0.0-SNAPSHOT.war` from the `target/` folder of your Maven project and paste it to `$CAMUNDA_HOME/server/apache-tomcat/webapps`.  
It will automatically be deployed within seconds and show up in Camunda BPMs Cockpit.  
![UI](https://github.com/steffenbrand/camunda-cake-example/blob/master/cockpit.png?raw=true)
You can now start some process instances via the `Task List` of Camunda BPM.

### 4. Install cake-camunda with composer and run it
You need composer to install the project.  
It will download CakePHP 3 and Camunda BPM PHP SDK.  
```
composer install
```
Now just run the application in a webserver of your choice.

