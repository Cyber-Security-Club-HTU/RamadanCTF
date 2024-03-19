Scenario:
> I wrote the best piece of English poetry known to man kind, but dumb me forgot the secret mechanism to decrypt the file.

>[!danger] This challenge can be solved in two ways
#### Basics
Running the application creates a file named `encrypted.txt`.
![[LostNoteEncryptedFile.png]]
Trying to give it arguments doesn't reveal anything special, running strings on it doesn't give us something useful.
#### Disassembling the application
You can use any disassembler/debugger you'd like, I opted for Ghidra, once it finished analyzing the binary, it presented me with the symbols table and the main function.
```c
int __cdecl main(int _Argc,char **_Argv,char **_Env)
{
  if (1 < _Argc) {
    HandleUserInput(_Argv);
  }
  Write(OneName,ThatOne,'\0',0xde);
  return 0;
}
```
We can see that there's a comparison that takes place which checks for the number of arguments passed to the program, and if it's more than one it calls a function that handles user input.
Let's check that function.
```c
void __cdecl HandleUserInput(char **param_1)
{
  int iVar1;
  longlong lVar2;
  char *pcVar3;
  char *pcVar4;
  undefined auStack_58 [32];
  char local_38 [16];
  ulonglong local_28;
  
  local_28 = __security_cookie.value ^ (ulonglong)auStack_58;
  pcVar3 = &DAT_14000513c;
  pcVar4 = local_38;
  for (lVar2 = 3; lVar2 != 0; lVar2 = lVar2 + -1) {
    *pcVar4 = *pcVar3;
    pcVar3 = pcVar3 + 1;
    pcVar4 = pcVar4 + 1;
  }
  pcVar3 = local_38 + 3;
  for (lVar2 = 0xc; lVar2 != 0; lVar2 = lVar2 + -1) {
    *pcVar3 = '\0';
    pcVar3 = pcVar3 + 1;
  }
  strcat(local_38,OneName);
  iVar1 = strcmp(local_38,param_1[1]);
  if (iVar1 == 0) {
    Write(local_38,ThatOne,'\x02',0xde);
  }
  __security_check_cookie(local_28 ^ (ulonglong)auStack_58);
  return;
}
```
Looking at the function it allocated a 16-byte array of characters at first
```c
char local_38 [16];
```
Proceeding this it copies a value from the data segment in the application to a local variable
```c
pcVar3 = &DAT_14000513c;
```
checking this memory location we can see it looks like an array of ascii characters that got truncated or something
```c
DAT_14000513c                             XREF[2]:   HandleUserInput:14000101f(*),HandleUserInput:140001031(R)  
     14000513c 75            undefin   75h
     14000513d 6e            ??        6Eh    n
     14000513e 00            ??        00h
     14000513f 00            ??        00h
```
checking what `75` is in ascii we can see that it's `u`.
afterwards it assigns it's value to `local_38`
```c
pcVar4 = local_38;
for (lVar2 = 3; lVar2 != 0; lVar2 = lVar2 + -1) {
	*pcVar4 = *pcVar3;
     pcVar3 = pcVar3 + 1;
     pcVar4 = pcVar4 + 1;
}
pcVar3 = local_38 + 3;
```
following on with the function we can see that there's a `strcat` function call that concatenates our string with a variable called `OneName`
```c
strcat(local_38,OneName);
```
checking this variable we can see that it's `encrypted.txt`
```c
OneName                      XREF[2]:HandleUserInput:140001044(*),main:1400012ae(*)
     1400050e0 65 6e 63      char[14]  "encrypted.txt"
               72 79 70 
               74 65 64
        1400050e0 [0]           'e', 'n', 'c', 'r',
        1400050e4 [4]           'y', 'p', 't', 'e',
        1400050e8 [8]           'd', '.', 't', 'x',
        1400050ec [12]          't','\0'
     1400050ee 00            ??        00h
     1400050ef 00            ??        00h
```
afterwards it checks if our passed argument is equal to that string.
concatenating our string by hand gives us the following:
`unencrypted.txt`
supplying this argument to our program gives us the following.
___
