FROM alpine:3.19

WORKDIR /chall
COPY ./challenge_files/challenge.txt .

ENV FLAG 'CSC{Alaani}'

RUN mkdir -p /chall_files

CMD ["cp", "/chall/challenge.txt", "/chall_files/challenge.txt"]