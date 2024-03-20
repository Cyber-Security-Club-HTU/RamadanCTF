#!/bin/bash

# docker login -u smadi0x86

# Build the Docker image and tag it directly with the Docker Hub repository name and tag
docker build -t smadi0x86/kubeleeeeeeeet-challenge:latest .

# Push the image to Docker Hub
docker push smadi0x86/kubeleeeeeeeet-challenge:latest

# priviledged mode is required to run docker in docker (DinD)
# docker run -it --rm -v /var/run/docker.sock:/var/run/docker.sock smadi0x86/kubeleeeeeeeet-challenge:latest

