#!/bin/bash

. scripts/clean_dir.sh
. scripts/cp_dir.sh
py scripts/fix_release.py || py3 scripts/fix_release.py
