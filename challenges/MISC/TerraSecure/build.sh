#!/bin/bash

echo "Building Terra Secure Challenge"
docker build -t terra-secure-challenge .

echo "Running Terra Secure Challenge"
docker run -p 5000:5000 terra-secure-challenge