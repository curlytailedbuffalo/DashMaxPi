#!/usr/bin/env python
from subprocess import Popen, PIPE
service = "motion"
p = Popen(["sudo", "service", service, "start"], stdin=PIPE, stdout=PIPE, stderr=PIPE)
# Note: using sequence uses shell=0
stdout, stderr = p.communicate()
print "Stdout:", stdout
print "Stderr:", stderr
