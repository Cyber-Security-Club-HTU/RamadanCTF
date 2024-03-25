# CSC RamadanCTF Crypto challenge 2

This is a very simple XOR challenge. Here's a python script that can solve the challenge:

```python
alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ{}'
binary_numbers = ['01110','10011','01101','00110','10111','11111','11111','11111']
key = ['01101','00000','01110','11101','01111','10000','01101','00011']

xor_results = [int(binary_numbers[i], 2) ^ int(key[i], 2) for i in range(len(binary_numbers))]

flag = ''.join([alphabet[result % len(alphabet) - 1] for result in xor_results])

print("Flag:", flag)
```
