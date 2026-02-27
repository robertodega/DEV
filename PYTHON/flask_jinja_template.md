#   filesystem construction
mkdir flask_jinja_template \
&& cd flask_jinja_template \
&& mkdir static templates static/css static/js static/img \
&& touch main.py const.py static/css/bootstrap.css static/css/custom.css static/js/bootstrap.js static/js/jquery.js static/js/custom.js templates/base.html templates/index.html templates/about.html templates/contact.html

- nano static/css/bootstrap.css

        content from CSS bootstrap cdn link ( https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css )

- nano static/js/bootstrap.js

        content from JS ootstrap cdn link ( https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js )

- nano static/js/jquery.js

        content from JS jquery cdn link ( https://code.jquery.com/jquery-4.0.0.min.js )
        
- nano const.py

        website_title = "Flask Jinja Templates Generator"
        rootpath = "./"

        welcome_message = "Welcome to Flask Jinja Templates Generator"
        title_message = "Template Inheritance Example"
        menu_list_items = {
            "Home": "/",
            "About": "/about",
            "Contact": "/contact",
        }

- nano main.py

        from flask import Flask, request, render_template
        import const

        app = Flask(__name__)

        @app.route("/", methods=["GET", "POST"])
        def index():
            curpage = "home"
            page_header_title = 'I nostri rappresentanti'
            content_values = {
                "Roby": 49,
                "Giovanna": 44,
                "Giada": 18,
            }
            params = {
                "curpage": curpage,
                "menu_list_items": const.menu_list_items,
                "page_header_title": page_header_title,
                "content_values": content_values,
            }
            return render_template("index.html", const=const, params=params)

        @app.route("/about")
        def about():
            curpage = "about"
            page_header_title = 'Chi siamo'
            content_values = {
                "Roby",
                "Giovanna",
                "Giada",
            }
            params = {
                "curpage": curpage,
                "menu_list_items": const.menu_list_items,
                "page_header_title": page_header_title,
                "content_values": content_values,
            }
            return render_template("about.html", const=const, params=params)

        @app.route("/contact")
        def contact():
            curpage = "contact"
            page_header_title = 'I nostri contatti'
            content_values = {
                "Phone": "+39 123456789",
                "Email": "info@JinjaTemplateExample.com",
                "Address": "Via Roma 123, Milano",
            }
            params = {
                "curpage": curpage,
                "menu_list_items": const.menu_list_items,
                "page_header_title": page_header_title,
                "content_values": content_values,
            }
            return render_template("contact.html", const=const, params=params)

        if __name__ == "__main__":
            app.run(debug=True)

- nano templates/base.html

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
                    <p class="lead">{{ const.title_message }}</p>
                    <hr>
                </div>
                <div class="content-div">
                    {% block navbar %} {% endblock %}
                    {% block content %} {% endblock %}
                    {% block footer %} {% endblock %}
                </div>
            </div>
        </body>

        </html>

- nano templates/index.html

        {% extends 'base.html' %}

        {% block navbar %}
        <nav>
            {% for item in params.menu_list_items.keys() %}
            {% if item.lower() == params.curpage.lower() %}
            {% set active = 'active' %}
            {% endif %}
            <a class='menu_item {{ active }}' href='{{  params.menu_list_items.get(item) }}'>{{ item }}</a>
            {% endfor %}
            <hr>
        </nav>
        {% endblock %}

        {% block content %}
        <div class="content-div">
            {{ params.page_header_title }}:
            <ul>
                {% for key in params.content_values.keys() %}
                <li>
                    {{ key }}: {{ params.content_values.get(key) }}
                    {% if params.content_values.get(key) > 40 %}
                    <span class="badge badge-danger">Old</span>
                    {% elif not params.content_values.get(key) > 30 %}
                    <span class="badge badge-success">Young</span>
                    {% endif %}
                </li>
                {% endfor %}
            </ul>
        </div>
        {% endblock %}

        {% block footer %}

        {% endblock %}

- nano templates/about.html

        {% extends 'base.html' %}

        {% block navbar %}
        <nav>
            {% for item in params.menu_list_items.keys() %}
            {% if item.lower() == params.curpage.lower() %}
            {% set active = 'active' %}
            {% endif %}
            <a class='menu_item {{ active }}' href='{{  params.menu_list_items.get(item) }}'>{{ item }}</a>
            {% endfor %}
            <hr>
        </nav>
        {% endblock %}

        {% block content %}
        <div class="content-div">
            {{ params.page_header_title }}:
            <ul>
                {% for value in params.content_values %}
                <li>
                    {{ value }}
                </li>
                {% endfor %}
            </ul>
        </div>
        {% endblock %}

        {% block footer %}

        {% endblock %}


- nano templates/contact.html

        {% extends 'base.html' %}

        {% block navbar %}
        <nav>
            {% for item in params.menu_list_items.keys() %}
            {% if item.lower() == params.curpage.lower() %}
            {% set active = 'active' %}
            {% endif %}
            <a class='menu_item {{ active }}' href='{{  params.menu_list_items.get(item) }}'>{{ item }}</a>
            {% endfor %}
            <hr>
        </nav>
        {% endblock %}

        {% block content %}
        <div class="content-div">
            {{ params.page_header_title }}:
            <ul>
                {% for key in params.content_values.keys() %}
                <li>
                    {{ key }}: {{ params.content_values.get(key) }}
                </li>
                {% endfor %}
            </ul>
        </div>
        {% endblock %}

        {% block footer %}

        {% endblock %}

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
        
            a {
              text-decoration: none;
              color: orangered;
            }
            a:hover {
              color: orange;
            }
        
            .active {
              font-weight: bold;
              color: orangered;
              text-decoration: underline;
            }
        
            .badge {
              padding: 0.5em;
              font-size: 75%;
        
              &.badge-success {
                background-color: green;
                color: white;
              }
        
              &.badge-danger {
                background-color: orange;
                color: white;
              }
            }
        
            .menu_item {
              font-size: 1.25rem;
              font-family: cursive;
              margin: 20px;
            }
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
