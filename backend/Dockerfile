# Define the base image
FROM node:lts-alpine
# Update the os
RUN apk update && \
    apk upgrade
# Define the working directory
WORKDIR /usr/src/app
# Copy and install dependencies
COPY package*.json ./
RUN npm install
# Copy the project files
COPY ./ ./
# Build the app
RUN npm run build
# Start the service
CMD ["node", "dist/index.js"]
# Expose the port
EXPOSE 8080