#!/bin/bash

# Start Docker in the background
dockerd-entrypoint.sh &

# Wait for Docker to start
sleep 10

# Create the KinD cluster
kind create cluster --wait 5m

# Apply initial misconfigurations
docker exec kind-control-plane sh -c 'sed -i "s|/etc/kubernetes/manifests|/etc/kubernetes/invalid-manifests|g" /var/lib/kubelet/config.yaml && systemctl restart kubelet'
docker exec kind-control-plane sh -c 'sed -i "s|https://kind-control-plane:6443|https://kind-control-plane:7443|g" /etc/kubernetes/kubelet.conf'

# Install micro editor, suppress the progress bar and output
MICRO_VERSION="2.0.10"
docker exec kind-control-plane sh -c "curl -sSL https://github.com/zyedidia/micro/releases/download/v${MICRO_VERSION}/micro-${MICRO_VERSION}-linux64.tar.gz | tar -xz -C /usr/local/bin --strip-components=1 micro-${MICRO_VERSION}/micro"

# Function to check if all kube-system pods are running
check_pods_and_generate_flag() {
    local running_pods=$(docker exec kind-control-plane kubectl get pods -n kube-system -o jsonpath='{.items[?(@.status.phase=="Running")].metadata.name}')
    local total_pods=$(docker exec kind-control-plane kubectl get pods -n kube-system -o jsonpath='{.items[*].metadata.name}')

    if [[ ! -z "$running_pods" && "$running_pods" == "$total_pods" ]]; then
        # Generate the flag if not already generated and all pods are running
        local flag_path="/etc/flag.txt"
        if [ ! -f "$flag_path" ]; then
            local flag_content="Your flag is: csc{kubelet_m1sconf1gur4t10n_1s_4w3s0m3}"
            echo "$flag_content" > "$flag_path"
            docker cp "$flag_path" kind-control-plane:"$flag_path"
            return 0  # Signal that the flag has been generated
        fi
    fi
    return 1  # Signal that the flag has not been generated or conditions are not met
}

# Monitoring loop
(
    while true; do
        check_pods_and_generate_flag
        if [ $? -eq 0 ]; then
            echo "Flag generated and challenge completed."
            break  # Exit the loop once the flag is generated
        fi
        sleep 2  # Check every 2 seconds
    done
) &

# Keep the container running and interactive
docker exec -it $(docker ps -qf "name=kind-control-plane") bash

