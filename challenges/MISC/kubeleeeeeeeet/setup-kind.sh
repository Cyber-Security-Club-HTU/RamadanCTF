#!/bin/bash

# Start Docker in the background
dockerd-entrypoint.sh &

# Wait for Docker to start
sleep 10

# Create the KinD cluster
kind create cluster --wait 5m

# Misconfigure the kubelet by setting an incorrect clientCAFile path
docker exec kind-control-plane sh -c 'sed -i "s|/etc/kubernetes/pki/ca.crt|/wrong/path/to/ca.crt|g" /var/lib/kubelet/config.yaml && systemctl restart kubelet'

# Install micro editor in the KinD control-plane node
MICRO_VERSION="2.0.10"
docker exec kind-control-plane sh -c "curl -L https://github.com/zyedidia/micro/releases/download/v${MICRO_VERSION}/micro-${MICRO_VERSION}-linux64.tar.gz | tar -xz -C /usr/local/bin --strip-components=1 micro-${MICRO_VERSION}/micro"

# Copy the flag-pod.yaml to the control-plane node
docker cp flag-pod.yaml kind-control-plane:/etc/kubernetes/manifests/flag-pod.yaml

# Set permissions for the flag-pod.yaml to be readable only by root
docker exec kind-control-plane sh -c 'chmod 600 /etc/kubernetes/manifests/flag-pod.yaml'

# Provide an interactive shell to the user
exec docker exec -it $(docker ps -qf "name=kind-control-plane") bash
