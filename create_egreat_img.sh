#!/bin/bash

sudo mksquashfs squashfs-root/ squashfs1.img
sudo tar -b 32 -H ustar -cvf /tmp/install.img *
