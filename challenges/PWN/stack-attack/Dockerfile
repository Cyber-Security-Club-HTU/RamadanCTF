# Use a base image that includes necessary development tools and libraries
FROM debian:bullseye

ENV FLAG="CSC{BOF_STACK_ATTACK}"

# Install necessary packages (adjust for your specific Linux distribution)
RUN apt-get update && \
    apt-get install -y \
        build-essential \
        cmake \
        gcc \
        socat \
        gcc-multilib \
        g++-multilib \
    && rm -rf /var/lib/apt/lists/*

# Set up your working directory and copy your source code
WORKDIR /app
COPY ./src /app/src

# Compile your code
RUN cmake -B build src && \
    cd build && \
    make

CMD ["socat", "TCP-LISTEN:5555,reuseaddr,fork", "EXEC:\"./build/stack-attack\",pty,stderr,setsid,sane"]
