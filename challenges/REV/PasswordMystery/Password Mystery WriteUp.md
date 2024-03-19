Scenario:
>This program contains a piece of information that I need, I can't figure out the password, can you help me?

Starting with the basics like running the application reveals that it expects some sort of a password:
```Powershell
PS C:\Users\Public > .\PassMystery.exe
[-] One Password Is Required!
```
We try giving it a password as an argument (Bad Practice):
```powershell
PS C:\Users\Public > .\PassMystery.exe Password123!
[-] Incorrect Password :)
```
and we get an error saying it's an incorrect password, trying to give it two passwords to check for other behaviours:
```powershell
PS C:\Users\Public > .\PassMystery.exe Password123! Password123!
[-] One Password Is Required!
```
It screams at us.
Trying Strings against it to see if the password was hardcoded by mistake:
```powershell
PS C:\Users\Public > strings .\PassMystery.exe

Strings v2.54 - Search for ANSI and Unicode strings in binary images.
Copyright (C) 1999-2021 Mark Russinovich
Sysinternals - www.sysinternals.com

!This program cannot be run in DOS mode.
..<SNIP>..
L$ SVWH
t$X
t$ L
0_^[
D$<
\$P3
DT
t$XH
tTH
|$@H
C70
..<SNIP>
```
We don't find a password but we find a bunch of random strings, might be an encrypted password?
We continue digging in, following with an inspection of the PE file to check if something is hidden in an unexpected section of the file.
Scrolling down in the text section we see something interesting:
![[PassMysterySS.png]]It looks like the program is allocating an array of values each 4 bytes in size, except the last element is 2 bytes and it's being left in the EAX register.
```c
MOV RAX, RSP
SUB RSP, 0X48
MOV DWORD PTR [RAX - 0X28], 0X12031201
MOV DWORD PTR [RAX - 0X24], 0X12041246
MOV DWORD PTR [RAX - 0X20], 0X1202125A
MOV DWORD PTR [RAX - 0X1C], 0X1244126B
MOV DWORD PTR [RAX - 0X18], 0X12011200
MOV DWORD PTR [RAX - 0X14], 0X12431201
MOV DWORD PTR [RAX - 0X10], 0X12461204
MOV EAX, 0X1250
```
We still don't know what these values are but it's worth noting them down in case we encounter them later on.
The following lines are correlated with the `one password is required` warning as it checks for the number of arguments passed into the main function of the program.
>[!info] We knew that this was the first argument to our main function from the windows x64 calling convention 
```c
CMP ECX, 2
JE SHORT 0X1400010CD
LEA RCX, [RIP + 0X1FF2]        '[-] One Password Is Required!'
```
Continuing on with our analysis, we take the JE (Jump-Equal) route to see how our password is being validated.
Once we jump we get this on our hands
```c
MOV R8, QWORD PTR [RDX + 8]
```
First we are moving something that's 8 bytes away from the address stored in the RDX register.
Referring back to our x64 calling convention we know that RDX holds the second argument of our function, and knowing that the default second argument for the main function is `char* argv[]`, it explains why we are offsetting it by 8 bytes (size of char* is 4 bytes) so this leads us to the start of the second element in the array of character arrays.
```c
MOV QWORD PTR [RSP + 0X50], RBX
```
this effectively stores the value of RBX, it's a standard thing to do when we need to use the RBX register.
```c
XOR EBX, EBX
MOV EDX, EBX
```
afterwards we clear the EBX register effectively and move it's value (0) into the EDX register, maybe we are setting it for a loop or something of sort
```c
NOP WORD PTR [RAX + RAX] // This is just for allignment purposes
MOVSX ECX, BYTE PTR [R8 + RDX]
MOVZX EAX, WORD PTR [RSP + RDX*2 + 0X20]
```
We then proceed to move a byte from the location indicated by 
`[R8 + RXD]`  into ECX and extend it's sign into the register.
Aftwards we move a word (2 bytes) from the location `[RSP + 0x20]` (the RDX\*2 is 0) into the EAX register and extend it with zeroes.
```c
XOR ECX, 0X1234
CMP EAX, ECX
```
now here's something interesting, we are xoring the value passed into ECX with `0x1234`, knowing that ECX holds the first byte of our passed argument, we are xoring our passed password with this value, then we are comparing it to EAX. Getting back to our array, we see that RSP hasn't changed since we first allocated more space on the stack, thus it still has the same properties, adding 0x20 to RSP leads us to the first element in our DWORD array.
```c
SUB RSP, 0X48
MOV DWORD PTR [RAX - 0X28], 0X12031201
```
since we got the xor key, and we know what the expected value should be, let's reverse it by taking the stored array and xoring it with the key.
writing a simple program to do that for us.
>[!info] Don't forget that we are comparing 1 byte from our password to 2 Bytes from the password and don't forget the WORD left in EAX ;)
```c
// We reversed the WORDS order since we are dealing with a little endian machine
#include <stdio.h>
int main(void)
{
    short EncKey[] = {
        0x1201, 0X1203, 0x1246,
        0X1204, 0X125A, 0x1202,
        0X126B, 0x1244, 0X1200,
        0x1201, 0X1201, 0x1243,
        0X1204, 0x1246, 0x1250
    };
    for(int i = 0; i < sizeof(EncKey)/sizeof(EncKey[0]); i++) printf("%c", EncKey[i]^0x1234);
    return 0;
}
```
running the code we get our password: `57r0n6_p455w0rd`
we get our flag
```powershell
PS C:\Users\Public > .\PassMystery.exe 57r0n6_p455w0rd
!!!!! CONGRATULATIONS !!!!!
Futoor{34zy_41n7_17}
```
____
