# Frontend Dockerfile
FROM node:16

# Set working directory
WORKDIR /app

# Copy package.json and install dependencies
COPY package.json package-lock.json ./
RUN npm install

# Copy application files
COPY . .

# Build the frontend
RUN npm run build

# Expose port
EXPOSE 5173

# Run the frontend
CMD ["npm", "run", "dev", "--", "--host", "0.0.0.0", "--port", "5173"]
