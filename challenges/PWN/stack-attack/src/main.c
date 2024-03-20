#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>
#include <string.h>

#ifdef FLAG
    char flag[] = "  "FLAG"  ";
#else
    char flag[] = "h3r3_1$_y0ur_fl4g";
#endif 

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
    if (check_password() == 0)
    {
        char buf[128] = {0};
        scanf("%s", buf);
        cmd(buf);
    }
    return 0;
}