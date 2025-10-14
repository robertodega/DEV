#!/bin/bash

containers=(Multimedia Home)
folders=(/home/roby/Documenti /home/roby/Immagini /home/roby/Musica)

start_time=$(date +"%H:%M:%S")
start_time_sec=$(date +%s)

while true; do
    clear
    echo "**************************************** HD backup Utility ****************************************"

    echo ""
    echo "Select your backup disk support:"
    echo "1) Toshiba"
    echo "2) Hamlet"
    echo "0) Exit"
    read -p "Digit the corresponding number (1-2): " hdsupport

    if [[ "$hdsupport" == "1" || "$hdsupport" == "2" || "$hdsupport" == "0" ]]; then
        break
    else
        echo "Invalid value. Please try again."
    fi
done

if [[ "$hdsupport" == "0" ]]; then
    echo ""
    echo "Thank you!"
    echo ""
    exit 0
else 
    if [[ "$hdsupport" == "1" ]]; then
        hdsupportName="Toshiba"
    else
        hdsupportName="Hamlet"
    fi
fi

hdsupportDir="/media/roby/$hdsupportName/HDBACKUP"

echo ""
echo ""
echo "   --- [ $hdsupportDir ] ---   "
echo ""
echo ""
echo "----- Start time: $start_time -----"
echo ""

<< 'COMMENT' 
comment
multiple
lines
COMMENT

#   DELETE ALL PRESENT FOLDERS FOR Hamlet ( low capacity )
if [[ "$hdsupport" == "2" ]]; then
    if [ -d "$hdsupportDir" ]; then
        shopt -s nullglob
        for dir in "$hdsupportDir"/*/; do
            echo " ... Removing folder: $(basename "$dir") ... "
            rm -rf "$dir"
            echo " ... Deleted folder: $(basename "$dir")"
        done
        shopt -u nullglob
    else
        echo "Directory $hdsupportDir does not exist."
    fi
fi
#   DELETE ALL PRESENT FOLDERS FOR Hamlet ( low capacity ) END

cd "$hdsupportDir" || { echo "Impossibile accedere a $hdsupportDir"; exit 1; }
echo "...Navigated to $hdsupportDir..."
backup_dir_name=$(date +"%Y_%m_%d")
if [ ! -d "$backup_dir_name" ]; then
    echo "...Creating a new directory named '$backup_dir_name'..."
    echo ""
    mkdir "$backup_dir_name"

    cd "$backup_dir_name" || exit
    echo "...Navigated to $backup_dir_name..."
    echo "...Starting backup process..."
    echo ""

    for container in "${containers[@]}"; do
        mkdir "$container"
    done

    for folder in "${folders[@]}"; do

        #   start_folder_time=$(date +"%H:%M:%S")
        start_folder_time=$(date +%s)

        echo "--------------------------------------------------------------------------------------------------------"
        echo -n "          >   Backup of '$folder' in progres ... "
        if cp -r "$folder" .; then

            end_folder_time=$(date +%s)
            elapsed_seconds=$((end_folder_time - start_folder_time))
            elapsed_minutes=$((elapsed_seconds / 60))
            
            echo "          DONE! ($elapsed_minutes minutes)"
        else
            echo "          >   Error during the backup of '$folder'." >&2
        fi

    done

    #   --------------------------------------------------------------------------------------
    #   Backup of Multimedia directory
    start_mv_time=$(date +%s)

    mv Immagini Musica Multimedia/

    end_mv_time=$(date +%s)
    elapsed_seconds=$((end_mv_time - start_mv_time))
    elapsed_minutes=$((elapsed_seconds / 60))
    
    echo "          DONE! ($elapsed_minutes minutes)"

    echo "--------------------------------------------------------------------------------------------------------"
    echo ""
    echo "          >   Moved 'Immagini', 'Musica' into 'Multimedia' ( $elapsed_time )"
    echo ""
    #   --------------------------------------------------------------------------------------

    #   --------------------------------------------------------------------------------------
    #   Backup of Home directory
    echo "--------------------------------------------------------------------------------------------------------"

    start_thunderbird_time=$(date +%s)

    echo -n "          >   Backup of '/home/roby/.thunderbird/' in progres ... "
    if cp -r "/home/roby/.thunderbird/" ./Home; then
        end_thunderbird_time=$(date +%s)
        elapsed_seconds=$((end_thunderbird_time - start_thunderbird_time))
        elapsed_minutes=$((elapsed_seconds / 60))
        echo "          DONE! ( $elapsed_minutes minutes )"
    else
        echo "          >   Error during the backup of '/home/roby/.thunderbird/'." >&2
    fi

    start_bash_aliases_time=$(date +%s)

    echo -n "          >   Backup of '/home/roby/.bash_aliases' in progres ... "
    if cp  "/home/roby/.bash_aliases" ./Home; then
        end_bash_aliases_time=$(date +%s)
        elapsed_seconds=$((end_bash_aliases_time - start_bash_aliases_time))
        elapsed_minutes=$((elapsed_seconds / 60))
        echo "          DONE! ( $elapsed_minutes minutes )"
    else
        echo "          >   Error during the backup of '/home/roby/.bash_aliases'." >&2
    fi
    echo ""
    #   --------------------------------------------------------------------------------------

    #   --------------------------------------------------------------------------------------
    #   Backup of WWW directory
    echo "--------------------------------------------------------------------------------------------------------"

    start_www_time=$(date +%s)

    echo -n "        >   Backup of '/opt/lampp/htdocs/WWW/' in progres ... "
    if cp -r "/opt/lampp/htdocs/WWW/" ./WWW; then
        end_www_time=$(date +%s)
        elapsed_seconds=$((end_www_time - start_www_time))
        elapsed_minutes=$((elapsed_seconds / 60))
        echo "          DONE! ( $elapsed_minutes minutes )"
    else
        echo "          >   Error during the backup of '/opt/lampp/htdocs/WWW/'." >&2
    fi
    echo ""
    #   --------------------------------------------------------------------------------------
else
    echo "...Directory '$backup_dir_name' already exists."
    echo ""
fi

end_time=$(date +"%H:%M:%S")
end_time_sec=$(date +%s)
final_elapsed_seconds=$((end_time_sec - start_time_sec))
final_elapsed_minutes=$((final_elapsed_seconds / 60))

echo ""
echo "----- End time: $end_time -----"
echo ""
echo "----- Elapsed time: $final_elapsed_minutes minutes -----"
echo ""
ls -la $hdsupportDir
echo ""
echo "**************************************** Backup process is completed ****************************************"
echo ""