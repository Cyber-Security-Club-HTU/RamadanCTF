# Kubeleeeeeeeet Challenge Writeup

## Overview

The Kubeleeeeeeeet challenge is a beginner-level challenge that requires you to debug and fix a misconfigured kubelet in a Kubernetes cluster. The challenge is designed to help you practice troubleshooting and debugging Kubernetes issues, such as misconfigurations and errors in the kubelet.

## Starting the Challenge

- **Run the Docker Container**

  ```
  docker run --privileged -it -v /var/run/docker.sock:/var/run/docker.sock smadi0x86/kubeleeeeeeeet-challenge:latest
  ```
  
![image](https://github.com/Cyber-Security-Club-HTU/RamadanCTF/assets/75253629/1f1eadb7-6104-49ea-b709-ea684e4b6f21)

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
  
![image](https://github.com/Cyber-Security-Club-HTU/RamadanCTF/assets/75253629/0553912b-54bb-48b7-9faa-4de23962a1c3)

  Notice that some control plane pods are in a `Pending` state, indicating an issue with the kubelet.

- **Investigate the Kubelet**
  Navigate to `/etc/kubernetes/manifests` to check for static pod manifests. Here, you find a `flag-pod.yaml` that hasn't been created by the kubelet, though this directory is where kubelet automatically creates static pods from. Notice that this file was moved recently, confirming that something is wrong with kubelet.

![image](https://github.com/Cyber-Security-Club-HTU/RamadanCTF/assets/75253629/dda86cc9-e17a-4f85-8902-227ac6cec7ed)


  We can also inspect the flag-pod.yaml by running `cat /etc/kubernetes/manifests/flag-pod.yaml` to see the pod definition.

  ![image](https://github.com/Cyber-Security-Club-HTU/RamadanCTF/assets/75253629/9197c2af-4632-45b4-9b42-ab53ff279aaf)

  We find a useful information that is the path of the flag file `/mnt/flag/flag.txt` within the `hidden-flag-pod` pod, but it has initContainer logic that generates the flag when the pod starts only, so we need to fix the kubelet to start the pod.

## Debugging Kubelet

- **Examine Kubelet Status**
  Run `systemctl status kubelet` to check the kubelet's status. It appear to be offline, you need to investigate further.

  ![image](https://github.com/Cyber-Security-Club-HTU/RamadanCTF/assets/75253629/8e1b0069-356f-4407-8367-eaaafa2c7117)

- **Check Kubelet Logs**
  Use `journalctl -u kubelet` to view kubelet logs and identify the issue, you find that there is a misconfigured CA certificate path.

  ![image](https://github.com/Cyber-Security-Club-HTU/RamadanCTF/assets/75253629/1f5b5973-9637-4ec8-b9a7-87c8b4644150)

## Fixing the Kubelet

- **Edit Kubelet Configuration**
  The environment includes the micro text editor. Use it to edit the kubelet configuration file:

  ```
  micro /var/lib/kubelet/config.yaml
  ```
  
  Now, we have to change the wrong path to the correct path of the kubelet ca.crt file which is in /etc/kubernetes/pki/ca.crt

![image](https://github.com/Cyber-Security-Club-HTU/RamadanCTF/assets/75253629/6dd22af7-ed3f-4a2e-a9f9-8eaeeeba0886)

  In the micro editor, use `Ctrl + S` to save and `Ctrl + Q` to exit. Modify the file to correct the CA certificate path or any other misconfigurations you find.

- **Restart Kubelet**
  After fixing the configuration, restart kubelet to apply the changes:
  ```
  systemctl restart kubelet
  ```

Once kubelet is successfully restarted and the configuration issues are resolved, it should automatically create the static pod from the `flag-pod.yaml` file, and you can retrieve the flag by accessing the pod.

![image](https://github.com/Cyber-Security-Club-HTU/RamadanCTF/assets/75253629/6b2ab6a3-f057-473e-a0ab-45d89ed35182)

## Retrieving the Flag

After fixing the kubelet configuration and restarting the kubelet service, the kubelet should now correctly create the static pod defined in `flag-pod.yaml`.

- **Verify Pod Creation**
  Check the pods in the `kube-system` namespace to ensure the `hidden-flag-pod-kind-control-plane` has been created and is running:

  ```
  kubectl get pods -n kube-system
  ```
  
![image](https://github.com/Cyber-Security-Club-HTU/RamadanCTF/assets/75253629/78fb221d-4394-49f6-9bb4-0f1768bb87c1)

  You should see the `hidden-flag-pod-kind-control-plane` in the list, indicating that kubelet has successfully started the pod.

- **Access the Flag**
  From the pod definition in `flag-pod.yaml`, you know the flag is stored at `/mnt/flag/flag.txt` within the `hidden-flag-pod-kind-control-plane`. Use `kubectl exec` to access the pod and read the flag:
  ```
  kubectl exec hidden-flag-pod-kind-control-plane -n kube-system -- cat /mnt/flag/flag.txt
  ```
  
![image](https://github.com/Cyber-Security-Club-HTU/RamadanCTF/assets/75253629/9b3b8542-011d-4597-8e96-78c5d8939266)

This command will display the content of `flag.txt`, revealing the flag you need to complete the challenge.
