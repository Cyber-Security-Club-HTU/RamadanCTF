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
  Also, it's shown that a flag-pod was copied to `/etc` folder, lets keep that in mind.

## Identifying the Issue

Notice the pod that got copied to the directory `/etc/flag-pod.yaml`, we can `cat` it and see its contents which shows information about the pod such as commands, image, namespace etc...

![image](https://github.com/Cyber-Security-Club-HTU/RamadanCTF/assets/75253629/886d84b1-ab07-40e6-a69b-e1c407e0cc97)

We find a useful information that is the path of the flag file `/mnt/flag/flag.txt` within the `hidden-flag-pod` pod, but it has initContainer logic that generates the flag when the pod starts only, so we need to fix the kubelet to start the pod. 
If we try to create the pod using `kubectl` it will stay pending

![image](https://github.com/Cyber-Security-Club-HTU/RamadanCTF/assets/75253629/56802ca3-701a-49c6-b98a-170214ec9e84)

  Notice that some control plane pods are in a `Pending` state too, indicating an issue with the kubelet.

- **Investigate the Kubelet**

Let's check the kubelet status first using `systemctl status kubelet`

![image](https://github.com/Cyber-Security-Club-HTU/RamadanCTF/assets/75253629/f9d64530-aeaf-4e32-acd8-7992b6e24c55)

The kubelet is running but there is some logs that indicates a connection refused error, this better be investigated.

## Debugging Kubelet

- **Check Kubelet Logs**
  Use `journalctl -u kubelet` to view kubelet logs and inspect more of what is happening.

![image](https://github.com/Cyber-Security-Club-HTU/RamadanCTF/assets/75253629/11db76c2-92eb-4f9d-9efe-54151f6cd690)

We can find additional errors regarding kubelet config path that is not found/does not exist.

## Fixing the Kubelet

- **Edit Kubelet Configuration**
  The environment includes the micro text editor. Use it to edit the kubelet configuration file:

  ```
  micro /var/lib/kubelet/config.yaml
  ```
  
Kubelet configurations are stored in the `/var/lib/kubelet.config.yaml` and if we check the k8s docs we can see that the default static pod path that the kubelet reads from is `/etc/kubernetes/manifests`

![image](https://github.com/Cyber-Security-Club-HTU/RamadanCTF/assets/75253629/59cad2ee-3dfc-4ffa-8fce-26ada61083f9)


  In the micro editor, use `Ctrl + S` to save and `Ctrl + Q` to exit. Modify the file to correct the CA certificate path or any other misconfigurations you find.

- **Restart Kubelet**
  After fixing the configuration, restart kubelet to apply the changes:
  ```
  systemctl restart kubelet
  ```

Once kubelet is successfully restarted, let's check the new kubelet logs and check if we solved the issue.

![image](https://github.com/Cyber-Security-Club-HTU/RamadanCTF/assets/75253629/604d44e4-b661-4270-afd6-7696d799e80b)

The pods are still pending, there is still an issue, lets check the logs of kubelet using `journalctl` again.

![image](https://github.com/Cyber-Security-Club-HTU/RamadanCTF/assets/75253629/eac2fefb-a662-41be-8181-b5cd4833a213)

We can see that there is a problem in the API server, connection is getting refused, lets check the kubeapi-server manifest in `/etc/kubernetes/manifests/kubeapi-server.yaml`

![image](https://github.com/Cyber-Security-Club-HTU/RamadanCTF/assets/75253629/5cda34ae-c625-41ed-8aa7-6a2d051032c0)

The kubelet is trying to communicate with the kube-apiserver on port 7443 but the api server is running on port 6443, thats the issue let's fix it from the `/etc/kubernetes/kubelet.conf` file!

![image](https://github.com/Cyber-Security-Club-HTU/RamadanCTF/assets/75253629/a133901f-7eb8-417a-aaab-2009c84ba094)

After saving lets run and try listing the pods:
```
systemctl daemon-reload
systemctl restart kubelet
```

![image](https://github.com/Cyber-Security-Club-HTU/RamadanCTF/assets/75253629/5bbe28a8-49c3-4a7e-aba2-947caef9e1b8)

You should see the `hidden-flag-pod` in the list, indicating that kubelet has successfully started the pod.

## Retrieving the Flag

After fixing the kubelet configuration and restarting the kubelet service, the kubelet should now correctly create the pod defined in `flag-pod.yaml`.

- **Access the Flag**
  From the pod definition in `flag-pod.yaml`, you know the flag is stored at `/mnt/flag/flag.txt` within the `hidden-flag-pod`. Use `kubectl exec` to access the pod and read the flag:
  ```
  kubectl exec hidden-flag-pod-kind-control-plane -n kube-system -- cat /mnt/flag/flag.txt
  ```
  
![image](https://github.com/Cyber-Security-Club-HTU/RamadanCTF/assets/75253629/f10b2a5a-1364-4e72-9a45-16fd51dd393a)


This command will display the content of `flag.txt`, revealing the flag you need to complete the challenge.

Note: If you didn't use `kubectl create` for creating the pod, you could just:
```
mv /etc/flag-pod.yaml /etc/kubernetes/manifests
```
This will move the flag-pod to the static pod path where the kubelet is configured to automatically create these pods ensuring the're always up and restarts them if they're deleted, this is usually used for the control plane components of kubernetes such as kubeapi-server, scheduler, controller-manager etc...
