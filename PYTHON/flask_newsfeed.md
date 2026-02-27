#   filesystem construction
mkdir newsfeed \
&& cd newsfeed \
&& mkdir flask_newsfeed \
&& cd flask_newsfeed \
&& mkdir static templates static/css static/js static/img \
&& touch main.py const.py static/css/bootstrap.css static/css/custom.css static/js/bootstrap.js static/js/jquery.js static/js/custom.js templates/index.html

- nano static/css/bootstrap.css

        content from CSS bootstrap cdn link ( https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css )

- nano static/js/bootstrap.js

        content from JS ootstrap cdn link ( https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js )

- nano static/js/jquery.js

        content from JS jquery cdn link ( https://code.jquery.com/jquery-4.0.0.min.js )
        
- nano const.py

        website_title = "Flask Newsfeed"
        rootpath = "./"

- nano main.py

        from flask import Flask, render_template, request
        import datetime, requests
        import zoneinfo
        import const

        app = Flask(__name__)

        @app.route("/")
        def index():
            return render_template("index.html", const=const)

        @app.route("/search", methods=["POST"])

        def search():
            response = api_search()
            return render_template("index.html", const=const, response=response)

        def api_search():
            res = []
            response = {}
            tot_records = 0

            apiKey = request.form.get("apiKeyField", "")        #   fbbea2bb3e3e4e44ad9b9b5f5256d618
            term = request.form.get("searchField", "")

            current_day = datetime.date.today()
            current_year_number = current_day.year
            current_month_number = current_day.month - 1
            last_day_available = current_day.day 
            start_date = str(str(current_year_number) + "-" + str(current_month_number) + "-" + str(last_day_available))
            
            if term and apiKey:
                url = f"https://newsapi.org/v2/everything?q={term}&from={start_date}&sortBy=publishedAt&apiKey={apiKey}"
                r = requests.get(url)
                jsondata = r.json()

                jsonMessage = jsondata.get("message", "")
                jsonArticles = jsondata.get("articles", "")

                if jsonMessage:
                    res.append(f"message: {jsonMessage}")

                if jsonArticles:
                    for index, article in enumerate(jsonArticles):
                        tot_records = int(index + 1)
                        published_date = f"{article['publishedAt']}"
                        published_date = published_date[0:4] + "/" + published_date[5:7] + "/" + published_date[8:10] + " " + published_date[11:19]
                        res.append({'publishedAt': published_date, 'title': article["title"], 'url': article["url"], 'description': article["description"]})

                response.update({'url': url})
                response.update({'term': term})
                response.update({'tot_records': tot_records})
                response.update({'result': res})

            return response


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
            <div class="headerDiv">
                <div class="headerBlockDiv">
                    <div class="headerTitleDiv" id="headerPathDiv">
                        {{ const.website_title }}
                    </div>
                </div>
            </div>
            <div class="contentDiv">
                <div class="contentBlockDiv">
                    <form action="/search" method="post">
                        <div class="form-div-container">
                            <input type="text" class="form-control" id="apiKeyField" name="apiKeyField" placeholder="API Key here" value="" required />
                            <label>Inserire qui l'<strong>API Key</strong> ottenuta eseguendo login da <a href="http://newsapi.org" target="_blank">newsapi.org</a></label>
                        </div>
                        <div class="form-div-container">
                            <input type="text" class="form-control" id="searchField" name="searchField" placeholder="Searched term here" value="" required />
                            <label>Inserire qui la <strong>parola chiave</strong> per la quale si vogliono estrarre le notizie</label>
                        </div>
                        <div class="form-div-container">
                            <input type="submit" class="btn btn-primary searchActBtn" id="searchButton" value="Search">
                            <input type="button" class="btn btn-primary searchActBtn" id="resetButton" value="Reset" onclick="window.location.href='/'">
                        </div>
                    </form>
                </div>
            </div>
            <div class="contentDivResults">
                {% if response %}
                <div class="contentBlockDivResult blockString">
                    <div class="response-string">URL: <strong><a href="{{ response.url }}" target="_blank">{{ response.url }}</a></strong></div>
                    <div class="response-string">Searched term: <strong>{{ response.term }}</strong></div>
                    <div class="response-string">Number o records: <strong>{{ response.tot_records }}</strong></div>
                </div>
                <div class="contentBlockDivResult">
                    <div class="resultItemDiv">
                        {% for result in response.result %}
                        <li class="res_item">
                            <div class="res_item_row"> Pubblicazione: <strong>{{ result.publishedAt }}</strong></div>
                            <div class="res_item_row">Titolo: <strong>{{ result.title }}</strong></div>
                            <div class="res_item_row">Descrizione: <strong>{{ result.description }}</strong></div>
                        </li>
                        {% endfor %}
                    </div>
                </div>
                {% endif %}
            </div>
        </body>

        </html>

- nano static/css/custom.css

        .headerDiv {
          .headerBlockDiv {
            .headerTitleDiv {
              font-size: 3rem;
              font-weight: bold;
              font-family: "Trebuchet MS", "Lucida Sans Unicode", "Lucida Grande",
                "Lucida Sans", Arial, sans-serif;
              text-decoration: underline;
            }
          }
        }

        .contentDiv {
          .contentBlockDiv {
            margin-top: 20px;
            margin-bottom: 20px;

            input {
              margin-bottom: 10px;
              width: 20%;
              cursor: pointer;

              &.searchActBtn {
                width: 10%;
              }
            }

            .form-div-container {
              display: flex;
              gap: 20px;
            }
          }
        }

        .contentDivResults {
          .contentBlockDivResult {
            margin-bottom: 20px;
            width: 80%;
            margin: 10px auto;
            height: 800px;
            overflow: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;

            &.blockString{
                height: 120px;
                overflow: hidden;
            }

            .response-string {
              font-size: 0.9rem;
              color: #555;
              margin-bottom: 10px;
            }

            .resultItemDiv{
                .res_item {
                    list-style-type: none;
                    margin-bottom: 10px;
                    padding: 10px;
                    border-bottom: 1px solid #eee;

                    .res_item_row{
                        font-size: 0.9rem;
                        color: #333;
                        padding: 5px;
                    }
            }
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
