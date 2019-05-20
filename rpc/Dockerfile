#Version 0.1

FROM qzkc/python2.7:v2

MAINTAINER saulty4ish@gmail.com

RUN  yum install -y libvirt-python python-virtinst libvirt-client
RUN  pip install grpcio protobuf grpcio-tools numpy
RUN  pip install pyYAML
RUN  yum install -y  mysql-dev mysql-devel python-devel gcc
RUN  pip install MySQL-python flask


RUN mkdir /app

ADD src /app

WORKDIR /app

CMD python test.py

EXPOSE 50051
