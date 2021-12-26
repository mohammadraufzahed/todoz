# Todoz Back-End

This is the API of the Todoz app, This part of the project will have full
responsibility for the functionality of the apps.

## Requirements

- Nodejs LTS
- Postgresql

## Data UML

For UML Design click on the link blow.
[UML Design](./uml/README.md)

## Setup

### Install the dependencies

In the first step, we must install our dependencies.

```shell
# if you have the yarn on your system
$ yarn
# else
$ npm i
```

### Edit the env file

In the second step, we must configure the env file.

we will rename the .env.example file to .env,
and then replace your information with the information in the file.

```shell
# Database config
DATABASE_HOST="localhost"
DATABASE_NAME="todoz"
DATABASE_USER="jhone"
DATABASE_PASSWORD="doe"
```

### Run the project

#### Development environment

In the development environment, we will run the app with these commands.

```shell
# In the first terminal you run this command to compile the app when files changed.
$ npm run dev:watch

# and in the second terminal you will run this command to execute the files when they compiled
$ npm run dev:serve
```

#### Production environment

In the production environment, we will follow the commands below:

```shell
# Compile the project
npm run build

# And run the project
node dist/index.js
```

---

> Note: This folder contains all codes
> and documentation related to the Back-End of this project.
