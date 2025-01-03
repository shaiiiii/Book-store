# Frontend Dockerfile
FROM node:18

# Set working directory
WORKDIR /usr/src/app

# Copy package.json and package-lock.json
COPY package*.json ./

# Install dependencies
RUN npm install

# Copy the rest of the application
COPY . .

# Build the frontend
RUN npm run build

# Serve the frontend
RUN npm install -g serve
CMD ["serve", "-s", "dist"]

# Expose the port your app runs on
EXPOSE 3000
