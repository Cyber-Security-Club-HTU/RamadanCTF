FROM alpine:3.19

WORKDIR /chall
COPY ./challenge_files/challenge.txt .
COPY ./challenge_files/wordlist.txt .
COPY ./challenge_files/hashes.txt .


ENV FLAG 'CSC{MD4_IS_EASY}'

RUN mkdir -p /chall_files

RUN cp /chall/challenge.txt /chall_files/challenge.txt
RUN cp /chall/wordlist.txt /chall_files/wordlist.txt
RUN cp /chall/hashes.txt /chall_files/hashes.txt
