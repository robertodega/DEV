- installation

python3 -m venv pytorch_env \
&& source pytorch_env/bin/activate\
&& pip3 install torch torchvision torchaudio \
--index-url https://download.pytorch.org/whl/cpu # WITHOUT NVIDIA GPU
&& source pytorch_env/bin/activate

- check installation

        python3

        import torch 
        x = torch.rand(5, 3)

        print(f'x:\n\t{x}', f'PyTorch Version:\n\t{torch.__version__}', f'CUDA disponibile: {torch.cuda.is_available()}', sep='\n\n')
        if torch.cuda.is_available():
            print(f"GPU rilevata: {torch.cuda.get_device_name(0)}")
        else:
            print(f"GPU NON rilevata")
