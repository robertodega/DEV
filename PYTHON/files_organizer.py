import os
import platform
import datetime

clear_command = 'clear'
if platform.system() == "Windows":
    clear_command = 'cls'
os.system(clear_command)

print(f"\n\n\tOperating System: {os.name} ( {platform.system()} )")

def path_definition():
    images_dir = "images"
    path_content = {"images": images_dir}
    return path_content

def check_double_digit(string):
    if len(str(string)) == 1:
        prefix = "0" + str(string)
    else:
        prefix = str(string)
    return prefix

def daily_name_definition():
    return str(datetime.date.today().year) + "_" + str(check_double_digit(datetime.date.today().month)) + "_" + str(check_double_digit(datetime.date.today().day))

def arrange_files(files, ext):
    path_content = path_definition()
    files_with_ext = [file for file in files if file.endswith(ext)]
    daily_name = daily_name_definition()

    if ext == 'jpg':
        if not(os.path.exists(f"{str(path_content["images"])}")):
            os.mkdir(str(path_content["images"]))
        for i, file in enumerate(files_with_ext):
            
            prefix = check_double_digit(i+1)

            if not(os.path.exists(f"{str(path_content["images"])}/{daily_name}_{prefix}.{ext}")):
                new_file_name = f"{str(path_content["images"])}/{daily_name}_{prefix}.{ext}"
            else:
                current_prefix_value = len(os.listdir(f"{path_content["images"]}"))
                prefix = int(current_prefix_value) + 1
                prefix = check_double_digit(prefix)
                new_file_name = f"{str(path_content["images"])}/{daily_name}_{prefix}.{ext}"

            os.rename(file, f"{new_file_name}")

        print(f"\n\nCurrent content of {str(path_content["images"])} folder:")
        for file in os.listdir(f"{str(path_content["images"])}"):
            print(f"\t{file}")

if __name__ == "__main__":
    files = os.listdir()
    arrange_files(files, 'jpg')


#   TEST
#   rm -rf images
#   touch 12.jpg 34.jpg 56.jpg 78.png
#   python3 files_organizer.py
#   mv 78.png 78.jpg
#   python3 files_organizer.py
