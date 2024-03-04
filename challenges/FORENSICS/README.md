# Forensics challenges

4 challenges (2 easy & 2 medium)

# Structure:

For each challenge, there's a directory. This directory includes dockerfile, `.env`, and the directory where the actual challenge files are. Here's the hierarchy:
-   challenge 1 (directory):
    -   challenge_files (directory):
        - chall_maker.py: The python script that will actually generate the challenge file. The flag will be the envar `FLAG`.
        - build.sh: bash script to be ran in the docker.
        - other files needed for challenge generation.
    -   .env
    -   Dockerfile
    -   writeup (directory):
        - writeup.md
        - files needed for the writeup (challenge files, scriptss, etc)

# Notes

- For each Dockerfile, I've set a default FLAG envar in case dynamic flags aren't used.
- To generate a specific flag for each container, we can do:
    `docker run -e FLAG='<falg>' --name <team_name> -d <container tag>` then we can copy the challenge files with `docker cp team_name:/chall_files <destination>`
