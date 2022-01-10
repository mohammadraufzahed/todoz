# Define the base image
FROM node:lts-alpine
# Update the os
RUN apk update && \
    apk upgrade && \
    apk add fish tmux
# Define the working directory
ENV SHELL=/usr/bin/fish
WORKDIR /usr/src/app
# Start the service
CMD ["tmux"]
# Expose the port
EXPOSE 8080
EXPOSE 3000