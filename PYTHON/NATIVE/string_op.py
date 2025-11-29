import os
os.system('clear')

s = '#!Hello  $ *'
s1 = 'a-b-c-d-e'
s2 = 'xyz'
s3 = 'abc'
s4 = "Prima riga.\nSeconda riga.\nTerza riga.\nQuarta riga.\nQuinta riga."

ljust_str = s.ljust(25,'*')
rjust_str = s.rjust(25,'*')
center_str = s.center(25,'-')
strip_str = center_str.strip('-#!*$ ')  #   from left and stop, then from right and stop
replace_str = s1.replace('-', '*')
replace_str_3 = s1.replace('-', '*', 3)
join_str_2_3 = s2.join(s3)
join_str_3_2 = s3.join(s2)
split_str = s1.split('-')
split_str_2 = s1.split('-', 2)
rplit_str = s1.rsplit('-')
rplit_str_2 = s1.rsplit('-', 2)
splitlines_str = s4.splitlines()        #   Gestisce più tipi di delimitatori: \n, \r, \r\n, \v, \f e altri
prefix_str = s.startswith('#')
suffix_str = s.endswith('#')

print("s:\t\t\t\t\t\t" + s)
print("ljust_str = s.ljust(25,'*'):\t\t\t" + ljust_str)
print("rjust_str = s.rjust(25,'*'):\t\t\t" + rjust_str)
print("center_str = s.center(25,'-'):\t\t\t" + center_str)
print("strip_str = center_str.strip('-#!*$ '):\t\t" + strip_str)
print("s1:\t\t\t\t\t\t" + s1)
print("replace_str = s1.replace('-', '*'):\t\t" + replace_str)
print("replace_str_3 = s1.replace('-', '*', 3):\t" + replace_str_3)
print("s2:\t\t\t\t\t\t" + s2)
print("s3:\t\t\t\t\t\t" + s3)
print("join_str_2_3 = s2.jon(s3):\t\t\t" + join_str_2_3)
print("join_str_3_2 = s3.jon(s2):\t\t\t" + join_str_3_2)
print("split_str = s1.split('-'):\t\t\t" + str(split_str))
print("split_str_2 = s1.split('-', 2):\t\t\t" + str(split_str_2))
print("rplit_str = s1.rsplit('-'):\t\t\t" + str(rplit_str))
print("rplit_str_2 = s1.rsplit('-'):\t\t\t" + str(rplit_str_2))
print("s4:\n" + s4)
print("splitlines_str = s4.splitlines():\t\t" + str(splitlines_str))
print("s:\t\t\t\t\t\t" + s)
print("prefix_str = s.startswith('#'):\t\t\t" + str(prefix_str))
print("suffix_str = s.endswith('#'):\t\t\t" + str(suffix_str))