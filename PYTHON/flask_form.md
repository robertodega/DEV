#   filesystem construction
mkdir flask_form \
&& cd flask_form \
&& mkdir static templates static/css static/js static/img \
&& touch main.py const.py static/css/bootstrap.css static/css/custom.css static/js/bootstrap.js static/js/jquery.js static/js/custom.js templates/index.html

- nano static/css/bootstrap.css

        content from CSS bootstrap cdn link ( https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css )

- nano static/js/bootstrap.js

        content from JS ootstrap cdn link ( https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js )

- nano static/js/jquery.js

        content from JS jquery cdn link ( https://code.jquery.com/jquery-4.0.0.min.js )
        
- nano const.py

        website_title = "Flask Form"
        rootpath = "./"

        welcome_message = "Welcome to Flask Form"
        website_title = "Flask Form"

- nano main.py

        from flask import Flask, request, render_template
        import const

        app = Flask(__name__)

        @app.route("/", methods=["GET", "POST"])
        def index():
            if(request.method =='POST'):
                with open("file.txt", "w") as f:
                    f.write(f"Name: {request.form["name"]}, Eail: {request.form["email"]}\n")
            return render_template("index.html", const=const)

        if __name__ == "__main__":
            app.run(debug=True)

- nano templates/index.html

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="{{ url_for('static', filename='css/bootstrap.css') }}">
            <link rel="stylesheet" href="{{ url_for('static', filename='css/custom.css') }}">
            <script src="{{ url_for('static', filename='js/jquery.js') }}"></script>
            <script src="{{ url_for('static', filename='js/bootstrap.js') }}"></script>
            <script src="{{ url_for('static', filename='js/custom.js') }}"></script>
            <title>{{ const.website_title }}</title>
        </head>

        <body>
            <div class="container">
                <div class="header-div">
                    <h1>{{ const.welcome_message }}</h1>
                    <hr>
                </div>
                <div class="content-div">
                    <form action='/' method="post">
                        <input type="text" name="name" placeholder="name here">
                        <input type="email" name="email" placeholder="email here">
                        <input type="submit" value="Submit">
                    </form>
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
