# CSC RamadanCTF Crypto challenge 4

The format of the password is ccdCdC. The play could either make a script that generates permutations, or they could use a wordlist generation tool like crunch. Then, they would use a tool like hashcat or john the ripper.

Generate the wordlist with `crunch 6 6 -t @@%,%, -o wordlist.txt`.

Put the hash in a file (hash.txt).

Use `john hash.txt --wordlist=./six_words.txt  --format=Raw-MD5` to crack the password.