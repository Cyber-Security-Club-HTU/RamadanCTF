

To create the docker image use the command 
`docker build  -t stacked .` 
To run the docker use the command 
`docker run  -d -p 5555:5555 stacked`

To remove the strings from the binary use
`perl -pi -e 's/CSC{BOF_STACK_ATTACK}/CSC{WHERE_THE_FLAG??}/g' stacked`

To move the binray from container to host use 
`docker cp <container-id>:/app/build/stack-attack stacked`

