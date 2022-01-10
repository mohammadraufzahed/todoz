# Todoz

Todoz is a to-do list app, it has minimal functionality, and will allow you to access your to-do list via mobile or website.

The purpose behind this is learning and it's not ready for production env.

## Features

- User management []
  - Adding a new user [x]
  - Limiting the user []
  - Delete a user [x]
- User authentication [x]
  - User registration [x]
  - User login [x]
  - User logout [x]
- User profile [x]
- Settings [x]
  - Edit the account information [x]
  - Changing the account password [x]
  - Deleting the account [x]
- To-do list management []
  - Add a new to-do item [x]
  - Deleting a to-do item []
  - Editing a to-do item []

## Main architecture

This is the main architecture of the app and it may change over time.

![Main architecture design](diagrams/mainArchitecture.png)

## Install the requirements

First of all, we need to install docker and docker-compose in your system. for installation guidelines you can visit the official documentation of docker.

[Docker Installation Guidelines](https://docs.docker.com/engine/install/)

after you installed the docker and docker-compose successfully, you can safely go to the next levels

## Development environment
you can enter to the development environment with the commands below:

```bash
# Build the docker images
$ docker-compose build

# Enter in the backend development environment
$ docker-compose run --rm -p 3000:3000 -p 8080:8080 backend_development
```

---

> <span style="color:red;">Note: </span>This app is under development, and this readme will be completed in the process of development.
