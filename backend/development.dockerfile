# Define the base image
FROM node:lts-alpine
# Update the os
RUN apk update && \
    apk upgrade && \
    apk add bash tmux
# Define the working directory
WORKDIR /usr/src/app
# Start the service
CMD ["tmux"]
# Expose the port
EXPOSE 8080
EXPOSE 3000