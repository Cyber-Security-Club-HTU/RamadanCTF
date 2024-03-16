# Kubeleeeeeeeet Challenge Writeup

## Overview

The Kubeleeeeeeeet challenge is a beginner-level challenge that requires you to debug and fix a misconfigured kubelet in a Kubernetes cluster. The challenge is designed to help you practice troubleshooting and debugging Kubernetes issues, such as misconfigurations and errors in the kubelet.

## Starting the Challenge

- **Run the Docker Container**

  ```
  docker run --privileged -it -v /var/run/docker.sock:/var/run/docker.sock smadi0x86/kubeleeeeeeeet-challenge:latest
  ```

  This command will start a Docker container with the necessary privileges and mount the Docker socket, allowing you to manage Docker from within the container.

- **Explore the Cluster**
  The environment automatically sets up a Kubernetes cluster using KinD (Kubernetes in Docker). Once the container is running, you're inside a shell where you can interact with the Kubernetes cluster.

## Identifying the Issue

- **Check the Pods**
  Use `kubectl` to list the pods in the `kube-system` namespace and across all namespaces:

  ```
  kubectl get pods -n kube-system
  kubectl get pods --all-namespaces
  ```

  Notice that some control plane pods are in a `Pending` state, indicating an issue with the kubelet.

- **Investigate the Kubelet**
  Navigate to `/etc/kubernetes/manifests` to check for static pod manifests. Here, you find a `flag-pod.yaml` that hasn't been created by the kubelet, though this directory is where kubelet automatically creates static pods from. Notice that this file was moved recently, confirming that something is wrong with kubelet.

  We can also inspect the flag-pod.yaml by running `cat /etc/kubernetes/manifests/flag-pod.yaml` to see the pod definition.

  We find a useful information that is the path of the flag file `/mnt/flag/flag.txt` within the `hidden-flag-pod` pod, but it has initContainer logic that generates the flag when the pod starts only, so we need to fix the kubelet to start the pod.

## Debugging Kubelet

- **Examine Kubelet Status**
  Run `systemctl status kubelet` to check the kubelet's status. It appear to be offline, you need to investigate further.

- **Check Kubelet Logs**
  Use `journalctl -u kubelet` to view kubelet logs and identify the issue, you find that there is a misconfigured CA certificate path.

## Fixing the Kubelet

- **Edit Kubelet Configuration**
  The environment includes the micro text editor. Use it to edit the kubelet configuration file:

  ```
  micro /var/lib/kubelet/config.yaml
  ```

  In the micro editor, use `Ctrl + S` to save and `Ctrl + Q` to exit. Modify the file to correct the CA certificate path or any other misconfigurations you find.

- **Restart Kubelet**
  After fixing the configuration, restart kubelet to apply the changes:
  ```
  systemctl restart kubelet
  ```

Once kubelet is successfully restarted and the configuration issues are resolved, it should automatically create the static pod from the `flag-pod.yaml` file, and you can retrieve the flag by accessing the pod.

## Retrieving the Flag

After fixing the kubelet configuration and restarting the kubelet service, the kubelet should now correctly create the static pod defined in `flag-pod.yaml`.

- **Verify Pod Creation**
  Check the pods in the `kube-system` namespace to ensure the `hidden-flag-pod` has been created and is running:

  ```
  kubectl get pods -n kube-system
  ```

  You should see the `hidden-flag-pod` in the list, indicating that kubelet has successfully started the pod.

- **Access the Flag**
  From the pod definition in `flag-pod.yaml`, you know the flag is stored at `/mnt/flag/flag.txt` within the `hidden-flag-pod`. Use `kubectl exec` to access the pod and read the flag:
  ```
  kubectl exec <hidden-flag-pod> -n kube-system -- cat /mnt/flag/flag.txt
  ```
  Replace `<hidden-flag-pod>` with the actual name of the pod as seen in the output from `kubectl get pods`.

This command will display the content of `flag.txt`, revealing the flag you need to complete the challenge.
