

from flask import Flask
from flask import request
app = Flask(__name__)

@app.route("/", methods=['GET', 'POST'])
def hello_world():
    print("request .method .path", request.method, request.path)
    print("request.args", request.args)
    print("request.form", request.form)
    return "flask hello"
