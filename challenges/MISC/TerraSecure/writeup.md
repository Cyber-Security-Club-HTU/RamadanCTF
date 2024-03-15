# TerraSecure Challenge Write-Up

## Challenge Description

In the TerraSecure Challenge, participants are tasked with securing an AWS EC2 instance by modifying a provided Terraform configuration file (`main.tf`). The challenge simulates a real-world scenario where tightening the security of cloud resources is crucial.

## Objectives

1. **Restrict SSH Access**: Limit SSH access to the EC2 instance to the IP range `192.0.2.0/24`.
2. **Prevent Public Internet Access**: Ensure the EC2 instance is not accessible from the public internet.

## Instructions

### Download the Configuration File

- Navigate to the challenge's web interface.
- Download the provided `main.tf` file to start the challenge.
  
![image](https://github.com/Cyber-Security-Club-HTU/RamadanCTF/assets/75253629/76706208-d39d-4b53-ba19-1fa4e843e176)

### Analyze the Configuration

Review the `main.tf` file to understand the existing security group rules and EC2 instance settings that need modification.

### Modify the Configuration

#### Restrict SSH Access

Locate the ingress rule for SSH (port 22) and update the `cidr_blocks` to restrict access to `192.0.2.0/24`:

```hcl
resource "aws_security_group" "cybercorp_operations_sg" {
  ingress {
    from_port   = 22
    to_port     = 22
    protocol    = "tcp"
    cidr_blocks = ["192.0.2.0/24"]
  }
}
```

![image](https://github.com/Cyber-Security-Club-HTU/RamadanCTF/assets/75253629/b09d4698-2b7d-4db1-90f6-b173a4ef9717)

#### Prevent Public Internet Access

Ensure the EC2 instance does not have a public IP address by setting associate_public_ip_address to false:

```hcl
resource "aws_instance" "cybercorp_operations_ec2" {
  associate_public_ip_address = false
}
```

![image](https://github.com/Cyber-Security-Club-HTU/RamadanCTF/assets/75253629/4083fa2c-4387-45b0-8d56-25b632ce3e26)

### Submit the Modified Configuration

After modifying main.tf, copy and paste the entire configuration into the submission box on the challenge's web interface and submit it for validation.

![image](https://github.com/Cyber-Security-Club-HTU/RamadanCTF/assets/75253629/c69694f1-79db-4791-bfbe-ef2883182aef)

### Getting The Flag

If your modifications meet the security requirements, the interface will display a success message and the challenge flag, signifying successful completion.

![image](https://github.com/Cyber-Security-Club-HTU/RamadanCTF/assets/75253629/3365c5ab-c087-4ed0-bee2-0eea393b3987)

## Conclusion

This challenge tests your ability to apply practical security configurations to cloud resources using Terraform, reflecting common tasks in cloud infrastructure management and security.

Remember, the provided main.tf file is just a starting point. You can use Terraform to manage a wide range of cloud resources and configurations, so keep exploring and learning!
