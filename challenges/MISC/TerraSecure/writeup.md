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

#### Prevent Public Internet Access

Ensure the EC2 instance does not have a public IP address by setting associate_public_ip_address to false:

```hcl
resource "aws_instance" "cybercorp_operations_ec2" {
  associate_public_ip_address = false
}
```

### Submit the Modified Configuration

After modifying main.tf, copy and paste the entire configuration into the submission box on the challenge's web interface and submit it for validation.

### Getting The Flag

If your modifications meet the security requirements, the interface will display a success message and the challenge flag, signifying successful completion.

## Conclusion

This challenge tests your ability to apply practical security configurations to cloud resources using Terraform, reflecting common tasks in cloud infrastructure management and security.

Remember, the provided main.tf file is just a starting point. You can use Terraform to manage a wide range of cloud resources and configurations, so keep exploring and learning!
