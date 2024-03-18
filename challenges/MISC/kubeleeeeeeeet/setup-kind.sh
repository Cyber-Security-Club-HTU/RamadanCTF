#!/bin/bash

# Start Docker in the background
dockerd-entrypoint.sh &

# Wait for Docker to start
sleep 10

# Create the KinD cluster
kind create cluster --wait 5m

docker exec kind-control-plane sh -c 'sed -i "s|/etc/kubernetes/manifests|/etc/kubernetes/invalid-manifests|g" /var/lib/kubelet/config.yaml && systemctl restart kubelet'
docker exec kind-control-plane sh -c 'sed -i "s|https://kind-control-plane:6443|https://kind-control-plane:7443|g" /etc/kubernetes/kubelet.conf'
MICRO_VERSION="2.0.10"
docker exec kind-control-plane sh -c "curl -L https://github.com/zyedidia/micro/releases/download/v${MICRO_VERSION}/micro-${MICRO_VERSION}-linux64.tar.gz | tar -xz -C /usr/local/bin --strip-components=1 micro-${MICRO_VERSION}/micro"

docker cp flag-pod.yaml kind-control-plane:/etc/flag-pod.yaml

docker exec kind-control-plane sh -c 'chmod 600 /etc/flag-pod.yaml'

exec docker exec -it $(docker ps -qf "name=kind-control-plane") bash
