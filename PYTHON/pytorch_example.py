#   source pytorch_env/bin/activate
import torch
import os

os.system("cls" if os.name == "nt" else "clear")
msg = ""

if torch.cuda.is_available():
    device = torch.device("cuda")
else:
    device = torch.device("cpu")
    msg += "\n\tGPU NON rilevata"
msg += f"\n\t>> Device in uso: {str(device).upper()}\n\n"

data = [1.0, 2.0, 3.0]
data2 = [4.0, 5.0, 6.0]
t0 = torch.zeros((3, 3))
t1 = torch.tensor(data)
t2 = torch.tensor(data2)
t3 = torch.rand((3, 3))
somma_x_y = t1 + t3  # torch.add(x, y)
prod_x_y = t1 * t3  # Moltiplicazione elemento per elemento (Hadamard)
dot_x_y = torch.dot(t1, t2)  # Prodotto scalare (Dot product)

#   ----- Deep Learning -----

#   Utilizzo Gradiente ( apprendimento automatico )
x = torch.tensor([3.0], requires_grad=True)
y = x**2  # funzione da derivare, in questo caso y = x^2
y.backward()  # calcolo della derivata di y rispetto a x => risultato in x.grad

#   Creazione Neurone Artificiale
target = torch.tensor([2.0])
input_value = torch.tensor([1.5])
weight = torch.tensor([0.8], requires_grad=True)
previsione = input_value * weight  # Previsione (semplice moltiplicazione)
error = (target - previsione) ** 2
error.backward() # gradiente del peso w (derivata dell'errore rispetto al peso)

print(f"{msg}")

print(f"\tMatrice di zeri ( t0 ):\n\n{t0}\n\n")
print(f"\tTensore da lista numerica ( t1 ):\n\n{t1}\n\n")
print(f"\tTensore da lista casuale ( t2 ):\n\n{t2}\n\n")
print(f"\tMatrice di numeri casuali ( t3 ):\n\n{t3}\n\n")
print(f"\tSomma elementi ( t1 + t3 ) :\n\n{somma_x_y}\n\n")
print(f"\tMoltiplicazione elementi ( t1 * t3 ) :\n\n{prod_x_y}\n\n")
print(f"\tProdotto scalare ( torch.dot(t1, t2) ) :\n\n{dot_x_y}\n\n")

#   ----- Deep Learning -----

print(f"\tTensore con gradiente ( x ):\n\n{x}\n\n")
print(f"\tfunzione y ( y = x^2 ):\n\n{y}\n\n")
print(f"\tValore del gradiente ( derivata di x ):\n\n{x.grad}\n\n")
print(f"\tGradiente del peso ( neurone artificiale ):\n\n{weight.grad}\n\n")
