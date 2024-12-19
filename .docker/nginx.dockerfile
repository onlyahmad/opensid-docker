# Use the official Nginx image as a base
FROM nginx:latest

# Define build arguments for UID and GID
ARG UID
ARG GID

# Set environment variables for UID and GID
ENV UID=${UID}
ENV GID=${GID}

# Remove the dialout group, if it exists (for compatibility purposes, though not typically needed on non-MacOS systems)
RUN delgroup dialout || true

# Create a new group and user with the specified GID and UID
RUN addgroup --gid ${GID} --system laravel \
    && adduser --uid ${UID} --ingroup laravel --system --disabled-password --shell /bin/sh laravel

# Update the Nginx configuration to use the new user instead of the default nginx user
RUN sed -i 's/user  nginx/user laravel/g' /etc/nginx/nginx.conf

# Ensure the target directory exists for the application
RUN mkdir -p /var/www/html

# Set permissions for the directory so the laravel user has the appropriate access
RUN chown -R laravel:laravel /var/www/html

# Set the working directory (optional but recommended for consistency in containerized setups)
WORKDIR /var/www/html

# Expose the default port for Nginx
EXPOSE 80

# Start Nginx when the container is run
CMD ["nginx", "-g", "daemon off;"]