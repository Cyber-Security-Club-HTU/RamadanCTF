from flask import Flask, request, render_template
import re
import time

app = Flask(__name__)


def check_ssh_access(file_content):
    pattern = re.compile(
        r'ingress\s*{\s*from_port\s*=\s*22\s*to_port\s*=\s*22\s*protocol\s*=\s*"tcp"\s*cidr_blocks\s*=\s*\["192\.0\.2\.0/24"\]\s*}',
        re.MULTILINE,
    )
    return bool(pattern.search(file_content))


def check_public_ip_setting(file_content):
    pattern = re.compile(r"associate_public_ip_address\s*=\s*false", re.MULTILINE)
    return bool(pattern.search(file_content))


@app.route("/", methods=["GET", "POST"])
def main():
    result = None
    if request.method == "POST":
        terraform_config = request.form["terraform_config"]
        ssh_check = check_ssh_access(terraform_config)
        public_ip_check = check_public_ip_setting(terraform_config)

        if ssh_check and public_ip_check:
            result = "Congratulations! Here's your flag for completing this challenge: csc{t3rr4f0rm_5ecur1ty}\n\nDeployment successful! Your secure infrastructure is now live in the cloud."
        else:
            result = (
                "[!] Our Intelligence team has detected an issue, please try again!"
            )
            if not ssh_check:
                result += "\n[*] SSH access is not correctly restricted."
            if not public_ip_check:
                result += "\n[*] The EC2 instance is still publicly accessible."

    return render_template("index.html", result=result)


if __name__ == "__main__":
    app.run(host="0.0.0.0")

# from flask import Flask, request, render_template
# import re
# import time

# app = Flask(__name__)


# def check_ssh_access(file_content):
#     pattern = re.compile(
#         r'ingress\s*{\s*from_port\s*=\s*22\s*to_port\s*=\s*22\s*protocol\s*=\s*"tcp"\s*cidr_blocks\s*=\s*\["192\.0\.2\.0/24"\]\s*}',
#         re.MULTILINE,
#     )
#     return bool(pattern.search(file_content))


# def check_public_ip_setting(file_content):
#     pattern = re.compile(r"associate_public_ip_address\s*=\s*false", re.MULTILINE)
#     return bool(pattern.search(file_content))


# @app.route("/", methods=["GET", "POST"])
# def main():
#     result = None
#     if request.method == "POST":
#         terraform_config = request.form["terraform_config"]
#         ssh_check = check_ssh_access(terraform_config)
#         public_ip_check = check_public_ip_setting(terraform_config)

#         if ssh_check and public_ip_check:
#             result = "Congratulations! Here's your flag for completing this challenge: csc{t3rr4f0rm_5ecur1ty}\n\nDeployment successful! Your secure infrastructure is now live in the cloud."
#         else:
#             result = (
#                 "[!] Our Intelligence team has detected an issue, please try again!"
#             )
#             if not ssh_check:
#                 result += "\n[*] SSH access is not correctly restricted."
#             if not public_ip_check:
#                 result += "\n[*] The EC2 instance is still publicly accessible."

#     return render_template("index.html", result=result)


# if __name__ == "__main__":
#     app.run(debug=False, host="0.0.0.0")
