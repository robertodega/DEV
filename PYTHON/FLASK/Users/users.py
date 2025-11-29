from flask import Flask, render_template, request
import html

from queries import search_db, add_db

from const import path_list

app = Flask(__name__)

page_title = "User List"
utility_root_path = path_list['root_path']
search_form_action = path_list['search_path']
add_form_action = path_list['addition_path']
search_name = ''

@app.route("/")
def index():
    users_list=search_db()
    return render_template("users.html"
                           , page_title=page_title
                           , users_list=users_list
                           , path_list=path_list
                           , utility_root_path=utility_root_path
                           , search_form_action=search_form_action
                           , add_form_action=add_form_action
                           , search_name=search_name)

@app.route('/', methods=['POST'])
def add_fields():
    username_value = request.form['name_field']
    pwd_value = request.form['pwd_field']
    section_value = request.form['section_field']
    note_value = request.form['note_field']
    add_result=add_db(username_value, pwd_value, section_value, note_value)
    users_list=search_db()

    return render_template("users.html"
                           , page_title=page_title
                           , users_list=users_list
                           , path_list=path_list
                           , utility_root_path=utility_root_path
                           , search_form_action=search_form_action
                           , add_form_action=add_form_action
                           , search_name=search_name
                           , username_value=username_value
                           , pwd_value=pwd_value
                           , section_value=section_value
                           , note_value=note_value
                           , add_result=add_result)


@app.route('/search', methods=['POST'])
def search():

    users_list=search_db()
    name = request.form['name_field']
    search_name = html.escape(name)                 # Escape the input to prevent XSS

    return render_template("users.html"
                           , users_list=users_list
                           , path_list=path_list
                           , utility_root_path=utility_root_path
                           , search_form_action=search_form_action
                           , add_form_action=add_form_action
                           , search_name=search_name)

@app.route('/add')
def add():
    return render_template("add.html"
                           , utility_root_path=utility_root_path)


if __name__ == "__main__":
    app.run(debug=True)
else:
    print("Imported module")
