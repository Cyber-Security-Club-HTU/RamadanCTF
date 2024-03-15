provider "aws" {
  region = "us-west-2"
}

resource "aws_security_group" "cybercorp_operations_sg" {
  name        = "CyberCorp Operations Instance Security Group"
  description = "The Secret Operations Security Group"

  ingress {
    from_port   = 1337
    to_port     = 1337
    protocol    = "tcp"
    cidr_blocks = ["0.0.0.0/0"]
  }

  ingress {
    from_port   = 3321
    to_port     = 4233
    protocol    = "tcp"
    cidr_blocks = ["0.0.0.0/0"]
  }

  ingress {
    from_port   = 22
    to_port     = 22
    protocol    = "tcp"
    cidr_blocks = ["0.0.0.0/0"]
  }

  egress {
    from_port   = 0
    to_port     = 0
    protocol    = "-1"
    cidr_blocks = ["0.0.0.0/0"]
  }
}

resource "aws_instance" "cybercorp_operations_ec2" {
  ami                         = "ami-0c55b159cbfafe1f0"
  instance_type               = "t2.micro"
  key_name                    = "cybercorp_operations_key"
  security_groups             = [aws_security_group.cybercorp_operations_sg.name]
  associate_public_ip_address = true

  tags = {
    Name        = "CyberCorp Operations Instance"
    terraform   = "true"
    environment = "prod"
  }
}
