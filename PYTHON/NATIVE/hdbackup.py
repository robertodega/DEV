import os
import datetime
import sys
import time

rootFolder = '/home/roby/'
containers = ['Multimedia', 'Home']
foldersDebian = ['Documenti', 'Immagini', 'Musica']
foldersUbuntu = ['Documents', 'Pictures', 'Music']
folders = foldersDebian

separator="*" * 40
dashSeparator="-" * 100
header=separator+" HD backup Utility "+separator
choiceRequest="\nSelect your backup disk support:\n\n\t1) Toshiba\n\t2) Hamlet\n\t0) Exit\n"
choiceRequestDigit="Digit the corresponding number (1-2-0): "
invalidChoiceLabel="\nInvalid value. Please try again.\n"
thanksLabel="\nThank you!\n"
removingLabel="\t> Removing folder: "
doneLabel="DONE"
doesNotExistLabel="doesn't exist!"
thunderbirdLabel="Backup of '/home/roby/.thunderbird/' in progress ... "
thunderbirdError="Error during the backup of '/home/roby/.thunderbird/'."
aliasesLabel="Backup of '/home/roby/.bash_aliases' in progress ... "
aliasesError="Error during the backup of '/home/roby/.bash_aliases'."
wwwLabel="Backup of '/opt/lampp/htdocs/WWW/' in progress ... "
wwwError="Error during the backup of '/opt/lampp/htdocs/WWW/'."
completedProcessLabel="Backup process is completed"
thunderbirdDebianPath="/home/roby/.thunderbird/"
thunderbirdUbuntuPath="/home/roby/.var/app/org.mozilla.Thunderbird/.thunderbird"

start_time = datetime.datetime.now().strftime("%H:%M:%S")
start_time_sec = time.time()

while True:
    os.system('clear')
    print(header.center(100, "*"))

    print(f"\n{dashSeparator}")
    print(" > There will be transferd contents from the following folders:\n")
    for folder in folders:
        print(f"\t> {os.path.join(rootFolder, folder)}")
    print("\n ---------- Please check correct paths ----------\n")
    print(f"{dashSeparator}")
        
    print(choiceRequest)
    hdsupport = input(choiceRequestDigit)
    if hdsupport in ["1", "2", "0"]:
        if hdsupport in ["0"]:
            print(thanksLabel)
            exit(0)
        elif hdsupport == "1":
            hdsupportName = "Toshiba"
        else:
            hdsupportName = "Hamlet"
        break
    else:
        print(invalidChoiceLabel)

hdsupportDir = f"/media/roby/{hdsupportName}/HDBACKUP"

print(f"\n\n\t>\t{hdsupportDir}\n\n")
if not os.path.exists(hdsupportDir):
    print(f"{hdsupportDir} {doesNotExistLabel}")
    exit(1)
    
print(f"Start time: {start_time}\n")

#   DELETE ALL PRESENT FOLDERS FOR Hamlet ( low capacity )
if hdsupport == "2":
    if os.path.isdir(hdsupportDir):
        for dir_name in os.listdir(hdsupportDir):
            dir_path = os.path.join(hdsupportDir, dir_name)
            if os.path.isdir(dir_path):
                print(f"{removingLabel}{dir_name} ... ", end="")
                os.system(f'rm -rf "{dir_path}"')
                print(doneLabel)
    else:
        print(f"{hdsupportDir} {doesNotExistLabel}")

os.chdir(hdsupportDir)
print(f" > Navigated to {hdsupportDir}")
backup_dir_name = datetime.datetime.now().strftime("%Y_%m_%d")
backup_dir_path = os.path.join(hdsupportDir, backup_dir_name)
if not os.path.exists(backup_dir_path):
    print(f" > Creating new directory '{backup_dir_name}'\n")
    os.makedirs(backup_dir_path)
    os.chdir(backup_dir_path)
    print(f" > Navigated to {backup_dir_name}")
    print(" > Starting backup process\n")

    for container in containers:
        os.makedirs(container)

    for folder in folders:
        start_folder_time = time.time()
        print(f"{dashSeparator}")
        print(f" > Backup of '{folder}' in progress ... ", end="")
        try:
            os.system(f'cp -r "{os.path.join(rootFolder, folder)}" .')
            end_folder_time = time.time()
            elapsed_minutes = int((end_folder_time - start_folder_time) / 60)
            print(f"{doneLabel} ({elapsed_minutes} minutes)")
        except Exception as e:
            print(f" > Error during the backup of '{folder}'.", file=sys.stderr)

    #   --------------------------------------------------------------------------------------
    #   Backup of Multimedia directory
    os.system('mv Immagini Musica Multimedia/')
    print(f"{dashSeparator}\n")

    #   --------------------------------------------------------------------------------------
    #   Backup of Home directory
    start_thunderbird_time = time.time()
    print(f" > {thunderbirdLabel}", end="")
    try:

        #   os.system('cp -r {thunderbirdDebianPath} ./Home')    #   Debian
        #   os.system('cp -r {thunderbirdUbuntuPath} ./Home')    #   Ubuntu

        if os.path.exists(thunderbirdDebianPath):
            os.system('cp -r '+thunderbirdDebianPath+' ./Home')
        # elif os.path.exists(thunderbirdUbuntuPath):
        #     os.system('cp -r {thunderbirdUbuntuPath} ./Home')
        
        end_thunderbird_time = time.time()
        elapsed_minutes = int((end_thunderbird_time - start_thunderbird_time) / 60)
        print(f"{doneLabel} ( {elapsed_minutes} minutes )")
    except Exception as e:
        print(f" > {thunderbirdError}", file=sys.stderr)

    start_bash_aliases_time = time.time()
    print(f" > {aliasesLabel}", end="")

    try:
        os.system('cp "/home/roby/.bash_aliases" ./Home')
        end_bash_aliases_time = time.time()
        elapsed_minutes = int((end_bash_aliases_time - start_bash_aliases_time) / 60)
        print(f"{doneLabel} ( {elapsed_minutes} minutes )")
    except Exception as e:
        print(f" > {aliasesError}", file=sys.stderr)

    print(f"{dashSeparator}\n")

#   --------------------------------------------------------------------------------------
#   Backup of WWW directory
    if not os.path.exists("./WWW"):
        start_www_time = time.time()
        print(f" > {wwwLabel}", end="")
        try:
            os.system('cp -r "/opt/lampp/htdocs/WWW/" ./WWW')
            end_www_time = time.time()
            elapsed_minutes = int((end_www_time - start_www_time) / 60)
            print(f"{doneLabel} ( {elapsed_minutes} minutes )")
        except Exception as e:
            print(f" > {wwwError}", file=sys.stderr)
        print("") 

#   --------------------------------------------------------------------------------------
end_time = datetime.datetime.now().strftime("%H:%M:%S")
end_time_sec = time.time()
final_elapsed_seconds = int(end_time_sec - start_time_sec)
final_elapsed_minutes = int(final_elapsed_seconds / 60)

print(f"\n----- End time: {end_time} -----\n")
print(f"----- Elapsed time: {final_elapsed_minutes} minutes -----\n")
os.system(f'ls -la "{hdsupportDir}"')
print(f"\n{separator} {completedProcessLabel} {separator}\n")
