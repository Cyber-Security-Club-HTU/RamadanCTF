FROM alpine:3.19

WORKDIR /chall
COPY ./challenge_files/chall_maker.py .
COPY ./challenge_files/kevin_hart.png .
COPY ./challenge_files/the_rock.png .
COPY ./challenge_files/build.sh .

RUN apk add --update --no-cache python3 py3-pip
RUN rm /usr/lib/python3.11/EXTERNALLY-MANAGED
RUN python3 -m ensurepip
RUN pip3 install --upgrade --no-cache pillow

ENV FLAG='CSC{345y_r1gh7?_l0l}' 

RUN mkdir /chall_files
CMD ["sh", "/chall/build.sh"]
