
# Docker Intallation

    sudo apt update
    sudo apt install docker.io
    sudo systemctl start docker
    sudo systemctl enable docker

#   Docker Version verify

    docker --version

#   Download the latest DEB package

    https://desktop.docker.com/linux/main/amd64/docker-desktop-amd64.deb?utm_source=docker&utm_medium=webreferral&utm_campaign=docs-driven-download-linux-amd64

#   Docker Desktop Installation ( Optional - [ https://docs.docker.com/desktop/setup/install/linux/ ] )

    sudo apt-get update
    sudo apt-get install ./Scaricati/docker-desktop-amd64.deb 

    Ignore error and proceed. To start Docker Desktop for Linux:

    Open Docker Desktop app.

    Alternatively, open a terminal and run

        systemctl --user start docker-desktop
        docker compose version
        docker --version
        docker version

    Enable Docker Desktop to start on sign in

    from the Docker menu, select Settings > General > Start Docker Desktop when you sign in to your computer.
    Alternatively, open a terminal and run:
        systemctl --user stop docker-desktop

#   Update Docker Version

    sudo apt-get install ./docker-desktop-amd64.deb

#   Virtual Machine use in Windows

    #   QEMU

    sudo apt install qemu-kvm libvirt-daemon-system libvirt-clients bridge-utils
    sudo systemctl enable --now libvirtd

    #   Download Windows ISO image from Microsoft
        https://www.microsoft.com/it-it/software-download

#   QEMU Vrtual Machine creation

    sudo apt update
    sudo apt install virt-manager
    virt-manager

    ## Create a Virtual Machine with virt-manager

    1. Open virt-manager
    2. Click on "Create a new virtual machine".
    3. Select the installation method (e.g., ISO image or network install).
    4. Configure the VM settings such as RAM, CPU, and disk space.
    5. Complete the setup and start the virtual machine.

#   Docker configuration in VM

    Una volta avviata la macchina virtuale con Windows, scarica e installa Docker Desktop per Windows
    Configura Docker Desktop per abilitare Hyper-V o la modalità WSL 2, se richiesto

