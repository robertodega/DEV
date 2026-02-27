#   filesystem construction
mkdir flask_serving_static \
&& cd flask_serving_static \
&& mkdir static templates static/css static/js static/img static/example_files_folder \
&& touch main.py const.py static/css/bootstrap.css static/css/custom.css static/js/bootstrap.js static/js/jquery.js static/js/custom.js templates/index.html static/example_files_folder/01.txt static/example_files_folder/02.txt static/example_files_folder/03.txt

- nano stastatic/example_files_folder/01.txt static/example_files_folder/02.txt static/example_files_folder/03.txt
- zippare la cartella ( zip -r static/example.zip static/example_files_folder/ )
- rm -rf static/example_files_folder

- nano static/css/bootstrap.css

        content from CSS bootstrap cdn link ( https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css )

- nano static/js/bootstrap.js

        content from JS ootstrap cdn link ( https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js )

- nano static/js/jquery.js

        content from JS jquery cdn link ( https://code.jquery.com/jquery-4.0.0.min.js )
        
- nano const.py

        website_title = "Flask Serving Static files"
        rootpath = "./"

        welcome_message = "Static Files in Flask"
        welcome_message_2 = "This is a simple Flask application serving static files."

- nano main.py

        from flask import Flask, render_template
        import const

        app = Flask(__name__)

        @app.route("/")
        def index():
            return render_template("index.html", const=const)

        if __name__ == "__main__":
            app.run(port=8000,debug=True)

- nano templates/index.html

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            
            <link rel="stylesheet" href="{{ url_for('static', filename='css/bootstrap.css') }}">
            <script src="{{ url_for('static', filename='js/jquery.js') }}"></script>
            <script src="{{ url_for('static', filename='js/bootstrap.js') }}"></script>
            <script src="{{ url_for('static', filename='js/custom.js') }}"></script>

            <link rel="stylesheet" href="{{ url_for('static', filename='css/custom.css') }}">
            <title>{{ const.website_title }}</title>
        </head>

        <body>
            <div class="container">
                <div class="header-div">
                    <h1>{{ const.welcome_message }}</h1>
                    <p class="lead">{{ const.welcome_message_2 }}</p>
                    <hr>
                </div>
                <div class="content-div">
                    <p>Download zip folder <a href="static/example_files_folder.zip">here</a></p>
                </div>
            </div>
        </body>

        </html>




- nano static/css/custom.css

        .container {
          .header-div {
            color: darkcyan;
            .lead {
              font-size: 1.5rem;
              font-family: cursive;
            }
          }

          .content-div {
            color: black;
          }
        }

#   app run
- python3 -m venv venv
- Windows:
    -   source venv/Scripts/activate
- Linux:
    -   venv/bin/activate

- pip3 install flask

- python3 main.py
- http://127.0.0.1:5000

- cd .. && rm -rf flask_jinja_template && clear && ls -la
