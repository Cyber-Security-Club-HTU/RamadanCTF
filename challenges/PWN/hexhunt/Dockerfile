
FROM ubuntu:latest

# Set environment variable
ARG MY_VARIABLE
ENV MY_VARIABLE=$MY_VARIABLE

# Install necessary dependencies
RUN apt-get update && apt-get install -y cmake

# Copy your CMakeLists.txt and other necessary files
COPY . /app
WORKDIR /app

# Run CMake with the specified variable
RUN cmake -Bbuild -H. -DMY_VARIABLE=${MY_VARIABLE}

# Build your project
RUN cmake --build build

# Define the command to run your application
CMD ["./app_executable"]