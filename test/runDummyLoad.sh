#!/bin/bash

sudo mysql climbuddy < drop.sql
sudo mysql climbuddy < create.sql

sudo mysql climbuddy < dummyLoad.sql