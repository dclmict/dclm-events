FROM opeoniye/nginx-php:7.4

# Create user based on provided user ID
ARG HOST_UID
RUN useradd -r -u $HOST_UID bams

# Switch to that user
USER bams