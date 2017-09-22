#!/usr/bin/env python

import os, sys, json

if __name__ == "__main__":
    vm_status = []
    try:
        with open("azurePackages.json") as json_data:
            data = json.load(json_data)
        print json.dumps(data)
    except Exception as e:
        print json.dumps(str(e))
    sys.exit(0)