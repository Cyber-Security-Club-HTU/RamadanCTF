FROM alpine:3.19

WORKDIR /chall
COPY ./challenge_files/challenge.pdf .

ENV FLAG 'CSC{isb1d3r_T33r3r3r3r3r3r3r3}'

RUN mkdir -p /chall_files

CMD ["cp", "/chall/challenge.pdf", "/chall_files/challenge.pdf"]