import os
import string
import random
import getpass

os.system('clear')

def check_password_strength(password):
    issues = []
    if len(password) < 8:
        issues.append("Password must be at least 8 characters long.")
    if not any(c.islower() for c in password):
        issues.append("Password must include at least one lowercase letter.")
    if not any(c.isupper() for c in password):
        issues.append("Password must include at least one uppercase letter.")
    if not any(c.isdigit() for c in password):
        issues.append("Password must include at least one digit.")
    if not any(c in string.punctuation for c in password):
        issues.append("Password must include at least one special character.")
    return issues

def generate_strong_password(length=12):
    if length < 8:
        raise ValueError("Password length should be at least 8 characters.")

    characters = string.ascii_letters + string.digits + string.punctuation
    password = ''.join(random.choice(characters) for _ in range(length))
    return password

password = getpass.getpass("Enter your password: ")
issues = check_password_strength(password)
if issues:
    print("Your password is weak for the following reasons:")
    for issue in issues:
        print(f"- {issue}")
    print("\nHere is a strong password suggestion:")
    print(generate_strong_password())
else:
    print("Your password is strong!")