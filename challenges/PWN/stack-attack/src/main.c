#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>
#include <string.h>

char flag[] = FLAG;

void win()
{
    printf("%s\n", flag);
}

int check_password()
{
    char input[64];
    gets(input);
    return strncmp(input, flag, 64); 
}

void cmd(char * command)
{
    system(command);
}

int main()
{
    printf("Enter your password\n");
    if (check_password() == 0)
    {
        char buf[128] = {0};
        scanf("%s", buf);
        cmd(buf);
    }
    return 0;
}