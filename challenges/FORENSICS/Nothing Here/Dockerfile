FROM alpine:3.19

WORKDIR /chall
COPY ./challenge_files/chall_maker.py .
COPY ./challenge_files/build.sh .

ENV FLAG 'CSC{sh4rken_ur_skills}'

RUN apk add --update --no-cache python3 py3-pip
RUN rm /usr/lib/python3.11/EXTERNALLY-MANAGED
RUN python3 -m ensurepip
RUN pip3 install --upgrade --no-cache scapy
RUN mkdir -p /chall_files

CMD ["sh", "/chall/build.sh"]
