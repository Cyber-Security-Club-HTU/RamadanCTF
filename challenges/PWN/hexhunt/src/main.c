#include <time.h>
#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <unistd.h>

#define TRUE 1


int guess();

int main(void)
{
    #ifdef FLAG
        char x[] = "  "FLAG"  ";
    #else
        char flag = "h3r3_1$_y0ur_fl4g";
    #endif 

    int attempts = 3;
    srand(time(NULL));

    while (attempts > 0)
    {
        char buffer[1024] = {0};
        printf("Can you guess the secret number?\n");
        read(0, buffer, 1024);
        printf(buffer);
        if (guess(buffer) == TRUE)
        {
            printf("You won!\n");
            break;
        }
        else
        {
            attempts--;
            printf("Wrong answer %d attempt left\n", attempts);
        }
        sleep(1);
    }
    return 0;
}


int guess(char * ans)
{
    return (atoi(ans) == (rand() % 100000));
}