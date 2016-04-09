#!/bin/bash
name='samundra'
echo $name

function test {
	echo $name
}

echo -e "what is ur name"
read name
echo  "welcome $name"