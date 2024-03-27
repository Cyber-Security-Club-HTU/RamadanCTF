# Use a base image with CMake and necessary dependencies
FROM gcc:latest

ENV FLAG="CSC{FORMAT_STRING}"

# Install cmake
RUN apt-get update && \
    apt-get install -y cmake socat

# Set the working directory
WORKDIR /app

# Copy the source code into the container
COPY ./src /app/src

# Set up cmake build
RUN cmake -B build src  && \
    cd build && \
    make


CMD ["socat", "TCP-LISTEN:4444,reuseaddr,fork", "EXEC:\"./build/hexhunt\",pty,stderr,setsid,sane"]

