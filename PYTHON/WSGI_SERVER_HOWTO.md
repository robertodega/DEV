
- come creare web app python usando wsgi
    - https://www.google.com/search?sca_esv=c8a3b072d1e1de02&rlz=1C1GCEA_enFR1095FR1095&q=come+creare+web+app+python+usando+wsgi&spell=1&sa=X&ved=2ahUKEwiVh-3n8peSAxWnhf0HHeyZHVEQBSgAegQIDxAB&biw=1215&bih=603&dpr=1.25&aic=0

-   Sviluppare l'Applicazione Python
    -   Creazione APP con Flask o Django
    -   lancio in ambiente virtuale

-   Scegliere e Configurare un Server WSGI
    -   Server WSGI: Gunicorn e uWSGI sono i più comuni. Installali con pip install gunicorn
    
            gunicorn app:app # nome file .py | istanza app Flask/Django

-   In Produzione (es. con Gunicorn e Nginx):

        Installa Gunicorn e Nginx sul server.
        Configura Nginx per agire come reverse proxy, inoltrando le richieste a Gunicorn.
        Configura Gunicorn per servire la tua app in modo più robusto, spesso tramite un servizio systemd

        -   Esempio di Configurazione (Apache/WSGI)

                -   Assicurati che il modulo mod_wsgi sia installato e abilitato su Apache.
                -   Crea un file .conf (es. miapapp.conf) nel directory sites-available di Apache, specificando il percorso del tuo codice e dell'interprete Python (in un ambiente virtuale)
                -   Abilita il sito e riavvia Apache

