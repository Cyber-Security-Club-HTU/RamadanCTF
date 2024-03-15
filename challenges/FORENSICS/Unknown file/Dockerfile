FROM alpine:3.19

WORKDIR /chall
COPY ./challenge_files/chall_maker.py .
COPY ./challenge_files/car.jpg .
COPY ./challenge_files/build.sh .

ENV FLAG 'CSC{n0_l0ng3r_scr1p7_k1dd0}'

RUN apk add --update --no-cache python3 py3-pip
RUN rm /usr/lib/python3.11/EXTERNALLY-MANAGED
RUN python3 -m ensurepip
RUN pip3 install --upgrade --no-cache PILLOW
RUN mkdir -p /chall_files

CMD ["sh", "/chall/build.sh"]