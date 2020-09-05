#!/bin/bash

echo "PHP"
echo "---------------------------------------------"
php tests/test.php
if [ $? -ne 0 ]; then
    echo "FAIL."
    exit 1
fi
echo "---------------------------------------------"
