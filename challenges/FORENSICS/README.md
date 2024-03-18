# Forensics challenges

3 challenges (2 easy & 1 medium)

# Structure:

For each challenge, there's a directory. This directory includes dockerfile, `.env`, `info.json` file, and the directory where the actual challenge files are. Here's the hierarchy:
-   <challenge_name> (directory):
    -   challenge_files (directory):
        - chall_maker.py: The python script that will actually generate the challenge file. The flag will be the envar `FLAG`.
        - build.sh: bash script to be ran in the docker.
        - other files needed for challenge generation.
    -   .env
    -   Dockerfile
    -   writeup (directory):
        - writeup.md
        - files needed for the writeup (challenge files, scripts, etc)
    -   info.json: challenge name, description, tags, author, and hint.

# Notes

- For each Dockerfile, I've set a default FLAG envar in case dynamic flags aren't used.
- To generate a specific flag for each container, we can do:
    `docker run -e FLAG='<generated_flag>' --name <team_name> -d <container tag>` then we can copy the challenge files with `docker cp team_name:/chall_files <destination>`
- For each challenge, there's a `info.json` file that has some info about the challenge.
