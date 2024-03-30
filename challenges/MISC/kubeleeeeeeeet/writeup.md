# Kubeleeeeeeeet Challenge Writeup

Update: This challenge wasn't solved by any team at the time of event, for anyone reading this writeup don't worry this challenge was made for people that already have some experience in kubernetes and docker. If you wanna learn more about kubernetes please refer to  https://www.reddit.com/r/kubernetes/comments/11wl4rj/question_what_is_the_best_way_to_learn_kubernetes/

## Overview

The Kubeleeeeeeeet challenge is a beginner-level challenge that requires you to debug and fix a misconfigured kubelet in a Kubernetes cluster. The challenge is designed to help you practice troubleshooting and debugging Kubernetes issues, such as misconfigurations and errors in the kubelet.

## Starting the Challenge

- **Run the Docker Container**

  ```
  docker run -it --rm -v /var/run/docker.sock:/var/run/docker.sock smadi0x86/kubeleeeeeeeet-challenge:latest
  ```
  
![image](https://github.com/Cyber-Security-Club-HTU/RamadanCTF/assets/75253629/1f1eadb7-6104-49ea-b709-ea684e4b6f21)

  This command will start a Docker container with the necessary privileges and mount the Docker socket, allowing you to manage Docker from within the container.

- **Explore the Cluster**
  The environment automatically sets up a Kubernetes cluster using KinD (Kubernetes in Docker). Once the container is running, you're inside a shell where you can interact with the Kubernetes cluster.

## Identifying the Issue

  In kubernetes cluster, there are control plane components that must be running and listening for events from our `kubectl` utility commands.

  To check these controlplane components (pods) that is by default running in a `kube-system` namespace:

  ```bash
  kubectl get pods -n kube-system
  ```

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

You should see pending pods in kube-system namespace is now running indicating kubelet is working as expected.

## Retrieving the Flag

After fixing the kubelet configuration and restarting the kubelet service, the kubelet should now correctly run the pending pods in kube-system and send you a flag.txt file.

- **Access the Flag**

![image](https://github.com/Cyber-Security-Club-HTU/RamadanCTF/assets/75253629/a13ffb13-3119-445e-b5cd-afb1de5c3166)

```bash
cat /etc/flag.txt
```

This command will display the path of `flag.txt`, revealing the flag you need to complete the challenge.
