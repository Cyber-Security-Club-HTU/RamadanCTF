# Use Docker-in-Docker as the base image
FROM docker:dind

# Install necessary tools
RUN apk add --no-cache curl bash

# Install kubectl
RUN K8S_VERSION=$(curl -s https://storage.googleapis.com/kubernetes-release/release/stable.txt) && \
    curl -LO "https://storage.googleapis.com/kubernetes-release/release/${K8S_VERSION}/bin/linux/amd64/kubectl" && \
    chmod +x ./kubectl && \
    mv ./kubectl /usr/local/bin/kubectl

# Install KinD
RUN curl -Lo ./kind "https://kind.sigs.k8s.io/dl/v0.11.1/kind-linux-amd64" && \
    chmod +x ./kind && \
    mv ./kind /usr/local/bin/kind

# Copy setup script and pod definition
COPY setup-kind.sh /setup-kind.sh

RUN chmod +x /setup-kind.sh

# Run the setup script when the container launches
ENTRYPOINT ["/setup-kind.sh"]
